<?php 

/**
 * Plugin Name: formulaire newsletter
 * Author: Malik H
 * Description: création d'un shortcode pour ajouter facilement un formulaire de newsletter
 */


 function add_form_newsletter() : string{
    $input_hidden = wp_nonce_field("formulaire" , "contact") ;
    return "
        <form method='POST' class='d-flex' style='width:400px'>
            <input type='email' class='form-control' placeholder='votre@email.fr' name='newsletter_email'>
            $input_hidden
            <input type='submit' class='btn btn-warning ms-3'>
        </form>
    ";
}
// wp_nonce_field("formulaire" , "contact") 
// génère dans le formulaire <input type="hidden" name="contact" value="5146876726">

add_shortcode("form_newsletter" , "add_form_newsletter");

// fonction Hook 
// permet d'ajouter des traitements en + dans le comportement natif de wordpress 
// attend que wordpress soit à 100% initilisé (fonctions soient chargées)
// pour exécuter en + des traitements sur des $_POST 
add_action("init" , function(){

    if(!empty($_POST["newsletter_email"])){

        // est ce que l'email saisit est un email conforme ?? 
        if( !filter_var( $_POST["newsletter_email"] , FILTER_VALIDATE_EMAIL ) ) return ;
    
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
        " , [$_POST["newsletter_email"]]);
        $wpdb->get_row($insert);
    }

});


// ajouter une nouvelle page dans le back office de notre site 
// permettre de voir tous ceux qui se sont inscrits dans la table wp_newsletter
// admin_init => créer cette page lorsque le back office est chargé
add_action("admin_menu" , function(){
    add_menu_page( "newsletter", "newsletter", 'manage_options' , "newsletter" , "contenu_page_newsletter") ;
    // newsletter => nom de la page
    // newsletter => texte affiché dans la barre latérale du back office
    // manage_options => le gestionnaire doit être administrateur pour pouvoir voir cette page dans le back office => 
    // newsletter slug de l'url de la page 
});

function contenu_page_newsletter(){
    global $wpdb ;
    $emails = $wpdb->prepare("SELECT * FROM wp_newsletter");
    $resultat = $wpdb->get_results($emails);
    $html = "<h1>Liste des utilisateurs inscrits à la newsletter</h1>";
    $html .= "<table class='striped' style='width:100%'>";
    $html .= "<tr>";
    $html .= "<th>id</th>";
    $html .= "<th>email</th>";
    $html .= "</tr>";
    foreach($resultat as $r){
        $html .= "<tr>";
        $html .= "<td>{$r->id}</td>";
        $html .= "<td>{$r->email}</td>";
        $html .= "</tr>";
    }
    $html .= "</table>";
    echo $html;
}

$a = "bonjour";
$phrase = "$a les amis";
$phrase = "{$a} les amis";
$phrase = $a . ' les amis';
$etudiant = ["nom" => "alain"];
$phrase2 = $etudiant["nom"] . " dit bonjour";
$phrase2 = "{$etudiant["nom"]} dit bonjour";
$phrase2 = "{$etudiant['nom']} dit bonjour";
$phrase2 = "{$etudiant['nom']} dit bonjour";