<?php get_header() ?>

<main class="container mt-3">
    <div class="row">
        <aside class="col-3">
            <h2>filtrer les resultats</h2>
            <form>
                <select name="order" class="form-select">
                    <option value="">choisir</option>
                    <option value="ASC">titre croissant</option>
                    <option value="DESC">titre décroissant</option>
                </select>
                <input type="submit" class="btn btn-primary mt-3 btn-sm" value="trier">
            </form>
            <?php 
            
            $args = array(
                "category_name" => "html" ,
                'orderby' => 'title',
                'order'   => $_GET["order"] ?? "ASC"
            );
            ?>
            <?php $query =  new WP_Query($args) ?>
        </aside>
        <div class="col">
            <?php // var_dump($query) ?>
            <div class="row">
                <?php while($query->have_posts()) : ?>
                    <?php $query->the_post() ?>
                        <div class="col-6">
                            <h2><?php the_title() ?></h2>
                            <p><?php the_date() ?></p>
                            <p><?php the_author()?></p>
                            <?php the_post_thumbnail("large" , ["class" => "img-fluid"]) ?>
                            <div>
                                <?php the_excerpt() ?>
                            </div>
                            <?php the_category() ?>
                        </div>
                        <?php wp_reset_postdata(); ?>
                    <?php endwhile ?>
            </div>
        </div>  
    </div>  
</main>
<?php get_footer() ?>