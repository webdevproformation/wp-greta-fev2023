<?php get_header() ?> 
<main class="container mt-3">
    <?php while(have_posts()) :?>
        <?php the_post() ?>
        <h1><?php the_title() ?></h1>
        <hr>
        <div>
            <?php the_content() ?>
        </div>
    <?php endwhile ?>
</main>

<?php get_footer() ?>