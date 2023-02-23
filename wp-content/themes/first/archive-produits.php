<?php get_header() ?>

<main class="container">
    <h1>Catalogue</h1>
    <div class="row">
        <?php while(have_posts()) : ?>
            <?php the_post() ?>
            <div class="col-3">
                <h2><?php the_title() ?></h2>
                <?php the_post_thumbnail("medium" , ["class" => "img-fluid"]) ?>
                <div>
                    <?php the_excerpt() ?>
                </div>
                <p>
                    prix : <?=  get_post_meta(get_the_ID() , "prix" , true) ?> € HT
                </p>
                <?php edit_post_link("modifier") ?>
            </div>
        <?php endwhile ?>
    </div>
</main>

<?php get_footer() ?>