<?php get_header() ?>

<main class="container mt-3">
    <div class="row">
        <aside class="col-3">
            <h2 class="fs-4">filtrer les resultats :</h2>
            <form>
                <input type="date" name="date" class="form-control mb-3">
                <select name="order" class="form-select">
                    <option value="">choisir</option>
                    <option value="ASC">titre croissant</option>
                    <option value="DESC">titre décroissant</option>
                </select>
                <input type="submit" class="btn btn-primary mt-3 btn-sm" value="trier">
            </form>
            
        </aside>
        <div class="col">
        <?php $query =  get_article_filtered_with_date("react") ?>
            <div class="row">
                <?php while($query->have_posts()) : ?>
                    <?php $query->the_post() ?>
                        <div class="col-6 mb-4">
                            <h2><?php the_title() ?></h2>
                            <div class="d-flex justify-content-between">
                                <p>⌚ : <?php the_date() ?></p>
                                <p>🚒 : <?php the_author()?></p>
                            </div>
                            <?php edit_post_link("modifier", "<div>" , "</div>") ?>
                            <?php the_post_thumbnail("large" , ["class" => "img-fluid"]) ?>
                            <div>
                                <?php the_excerpt() ?>
                            </div>
                            <?= categorie_badge(get_the_ID())  ?>

                            <hr>

                            <?php // the_category() ?>
                            <?php // var_dump(get_the_category()) ?>
                        </div>
                        <?php wp_reset_postdata(); ?><!--  libérer la mémoire si j'ai besoin de faire une requête WP_Query() supplémentaire après -->
                    <?php endwhile ?>
            </div>
        </div>  
    </div>  
</main>
<?php get_footer() ?>