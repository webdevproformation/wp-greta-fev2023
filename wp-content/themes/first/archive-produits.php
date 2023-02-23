<?php get_header() ?>

<main class="container">
    <h1>Catalogue</h1>
    <div class="row">
        <?php while(have_posts()) : ?>
            <?php the_post() ?>
            <h2><?php the_title() ?></h2>
        <?php endwhile ?>
    </div>
</main>

<?php get_footer() ?>