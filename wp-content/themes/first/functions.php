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