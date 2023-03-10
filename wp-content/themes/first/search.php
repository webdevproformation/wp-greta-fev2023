<?php get_header() ?>
<main class="container mt-3">
    <h1>Résultat de votre recherche : </h1>
    <p>
        pour le mot : <strong><?= get_search_query() ?></strong>, 
        il y a  <strong><?= $wp_query->found_posts ?></strong> résultat(s)
    </p>
    
        <?php if(have_posts()) : ?>
            <ol>
                <?php while(have_posts()) :?>
                    <?php the_post() ?>
                    <li class="mb-4">
                        <h2 class="fs-4"><?php the_title() ?></h2>
                        <?php the_excerpt() ?><!-- extrait -->
                        <a href="<?php the_permalink() ?>"> lire la suite </a> 
                    </li>
                <?php endwhile ?>
            </ol>
        <?php else : ?>
            <p>Mais voici des articles qui peuvent vous intéresser :</p>
            <div style="list-style:none">
                <?php dynamic_sidebar( "search" ) ?>
            </div>
        <?php endif ?>
    
</main>
<?php get_footer() ?>