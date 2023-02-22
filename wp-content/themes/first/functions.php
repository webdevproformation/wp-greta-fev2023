<?php 

// activer la possibilité d'ajouter des miniatures dans nos articles 

// hook => point d'accroche 
// modifier le comportement natif de wordpress 
// ajouter un traitement en + par rapport aux actions réalisées par défaut par wordpress 
// "after_setup_theme" => après que le thème soit mis en place 
// ajouter en + =>  add_theme_support("post-thumbnails");
// permet d'ajouter un champ supplémentaire les formulaires de gestion des articles => un champ pour ajouter une image de miniature 
// add_action("nom_event" , function(){})
add_action("after_setup_theme" ,  function(){
    add_theme_support("post-thumbnails");
    // codex.wordpress.org
});

/**
 * fonction qui permet de récupérer le permalien d'une page via son titre
 *
 * @param string $titre_page
 * @return string
 */
function get_page_url(string $titre_page):string {
    return get_the_permalink(get_page_by_title($titre_page));
}

/**
 * récupérer l'url d'une catégorie via son slug
 *
 * @param string $slug
 * @return string
 */
function get_category_url(string $slug):string {
    return get_tag_link(get_category_by_slug($slug)->term_id);
}

/**
 * retourne un objet WP_Query pour une catégorie trier par titre croissant ou décroissant 
 *
 * @param string $slug_categorie
 * @return WP_Query
 */
function get_article_filtered(string $slug_categorie) :WP_Query {
    // https://developer.wordpress.org/reference/classes/wp_query/
    $args = array(
        "category_name" => $slug_categorie ,
        'orderby' => 'title',
        'order'   => $_GET["order"] ?? "ASC"
    );
    return new WP_Query($args);

    // SELECT * FROM articles WHERE date = "2023-01-01" ORDER BY prix ASC
}

function get_article_filtered_with_date(string $slug_categorie) :WP_Query{

    $args = array(
        "category_name" => $slug_categorie 
    );
    $list = ["ASC", "DESC"];
    if(!empty($_GET["order"]) && in_array( $_GET["order"] , $list)){
        $args['orderby'] = "title";
        $args['order'] = $_GET["order"] ;
    }
    // si il y a dans l'url ?date=   et que cette valeur est une date valide 2023-01-01
    if(!empty($_GET["date"]) && DateTime::createFromFormat("Y-m-d", $_GET["date"]) !== false ){
        $date = DateTime::createFromFormat("Y-m-d", $_GET["date"]);
        $args['date_query'] = [
            [
                'year'  => $date->format("Y"),
			    'month' => $date->format("m"),
			    'day'   => $date->format("d")
            ]
        ];
    }
    return new WP_Query($args);
}

function categorie_badge(int $post_id) : string{
    $resultat = "";
    foreach(get_the_category($post_id) as $category){
        $resultat .= "<span class='badge bg-warning me-2'>
            <a href='". get_tag_link($category->term_id) ."' class='text-decoration-none text-white'>{$category->name}</a>
        </span>";
    }
    return $resultat ;
}
// http://localhost/demo/wp-admin
// http://localhost/demo/wp-login.php

function add_formulaire_contact() : string{
    return "
        <form method='POST'>
            <div class='mb-3'>
                <label for='email'>saisir votre email</label>
                <input type='email' name='email' class='form-control' id='email'>
            </div>
            <div class='mb-3'>
                <label for='message'>saisir votre message</label>
                <textarea name='message' class='form-control' id='message' rows='6'></textarea>
            </div>
            <input type='submit' class='btn btn-dark' value='envoyer un message'>
        </form>
    ";
}

add_shortcode("form_contact" , "add_formulaire_contact");
// "form_contact" => mot que l'on va écrire dans le bloc "code court" dans le back office
// "add_formulaire_contact" => le nom la fonction qui retourne le formulaire 

// ajouter un bloc "code court" => [form_contact]


// traitement du formulaire de contact 
if(!empty($_POST["email"]) && !empty($_POST["message"])){
    global $wpdb ; // il faut respecter le nom de cette variable 
    // $connexion = new PDO("")
    $create = $wpdb->prepare("
        CREATE TABLE IF NOT EXISTS wp_contact (
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            email VARCHAR(255) ,
            message TEXT
        )
    ");
    $wpdb->get_row($create); // execute()
    $query = $wpdb->prepare("INSERT INTO wp_contact 
        (email, message)
        VALUES
        (%s, %s)
    " , [ $_POST["email"] , $_POST["message"] ]);
     $wpdb->get_row($query);
}


function add_form_newsletter() : string{
    $input_hidden = wp_nonce_field("formulaire" , "contact") ;
    return "
        <form method='POST' class='d-flex' style='width:400px'>
            <input type='email' class='form-control' placeholder='votre@email.fr' name='email'>
            $input_hidden
            <input type='submit' class='btn btn-warning ms-3'>
        </form>
    ";
}
// wp_nonce_field("formulaire" , "contact") 
// génère dans le formulaire <input type="hidden" name="contact" value="5146876726">

add_shortcode("form_newsletter" , "add_form_newsletter");

if(!empty($_POST["email"])){

    // est ce que l'email saisit est un email conforme ?? 
    if( !filter_var( $_POST["email"] , FILTER_VALIDATE_EMAIL ) ) return ;

    /* var_dump(wp_verify_nonce( $_POST["contact"] , "formulaire" ));
    wp_die(); */ 
    if( wp_verify_nonce( $_POST["contact"] , "formulaire" ) !== 1) return ; 

    global $wpdb ;

    $wpdb->query("
        CREATE TABLE IF NOT EXISTS wp_newsletter (
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT ,
            email VARCHAR(255) NOT NULL
        )
    ");

    $insert = $wpdb->prepare("
            INSERT INTO wp_newsletter
            (email)
            VALUES 
            (%s)
    " , [$_POST["email"]]);
    $wpdb->get_row($insert);
}