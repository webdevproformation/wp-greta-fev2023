<?php get_header() ?>
<main class="container mt-3">
    <div class="row">
        <div class="row">
            <?php while(have_posts()) : ?>
            <?php the_post() ?>
                <div class="col-6">
                    <?php the_post_thumbnail("large" , ["class" => "img-fluid"]) ?>
                    <h2><?php the_title() ?></h2>
                    <div>
                        <?php the_excerpt() ?>
                    </div>
                </div>
            <?php endwhile ?>
        </div>
    </div>  
</main>
<?php get_footer() ?>