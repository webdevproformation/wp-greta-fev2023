<?php get_header() ?>
    <main class="container">
        <div class="row mt-4">
            <!-- loop wordpress -->
            <?php $i = 0 ; ?>
            <?php while (have_posts()) : ?>
                <?php the_post() ; ?>
                <article class="col-4">
                    <div class="card card-<?= $i ?>">
                        <h2 class="card-header" data-ajaxurl="<?= admin_url( 'admin-ajax.php' ) ?>" data-id="<?= $i ?>">
                            <?php echo $post->post_title ?>
                        </h2>
                        <!-- thumbnail : miniature -->
                        <?php echo the_post_thumbnail( "large", ["class" => "img-fluid"] ) ?>
                        <div class="card-body">
                            <?php the_excerpt() ?>
                        </div>
                        <div>
                            <?php the_date() ?>
                        </div>
                        <?php edit_post_link("modifier") ?>
                    </div>
                </article>
            <?php $i++ ?>
            <?php endwhile ?>
        </div>
    </main>
<?php get_footer() ?>
<!-- require include de php --> 
