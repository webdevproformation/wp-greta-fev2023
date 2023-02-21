<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link 
        rel="stylesheet" 
        href="<?php echo get_template_directory_uri() ?>/style.css">
        <!-- get_template_directory_uri() 
            http://localhost/demo/wp-content/themes/first
        -->
    <?php wp_head() ?>
</head>
<body <?php body_class() ?>><!-- gérer automatique une class en fonction de la page actuellement affichée -->
    <header class="bg-primary">
        <nav class="navbar navbar-expand container navbar-dark">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="" class="nav-link">Accueil</a></li>
            </ul>
        </nav>
    </header>