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

function get_article_filtered_width_date(string $slug_categorie) :WP_Query{

    $args = array(
        "category_name" => $slug_categorie 
    );
    $list = ["ASC", "DESC"];
    if(!empty($_GET["order"]) && in_array( $_GET["order"] , $list)){
        $args['orderby'] = "title";
        $args['order'] = $_GET["order"] ;
    }
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