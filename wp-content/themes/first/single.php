<?php get_header() ?>
<main class="container mt-3">
    <?php while(have_posts()) : ?>
        <?php the_post() ?>
        <header class="d-flex justify-content-between align-items-baseline">        
            <h1><?php the_title() ?></h1>
            <p>publié le : <?php the_date() ?></p>
        </header>        
        <div>
            <?php the_content() ?>
        </div>
        <hr>
        <p>auteur : <?php the_author() ?></p>
        <p><?= categorie_badge(get_the_ID()) ?></p>
        <hr>
        <div class="d-flex justify-content-between">
            <span>
                <?php previous_post_link( ) ?><!-- ajouter une balise <a href=""></a> pour l'article qui a été publié juste avant -->
            </span>
            <span>
                <?php next_post_link( ) ?>
            </span>

        </div>
        <hr>
        <?php comment_form() ?>
        <hr>
        <?php $commentaires = get_comments(); ?>
        
        <ul class="list-group">
            <?php foreach($commentaires as $c) : ?>
                <li class="list-group-item">
                    👤 : <?=  $c->comment_author_email ; ?> <br>
                    📨 : <?=  $c->comment_content ; ?> <br>
                    📆 : <?=  ( new DateTime($c->comment_date))->format("d/m/Y H:i:s") ; ?>
                </li>
            <?php endforeach ?>
        </ul>
    <?php endwhile ?>
</main>
<?php get_footer() ?>