<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <?php wp_head() ?>
</head>
<body>
    <header class="bg-primary">
        <nav class="navbar navbar-expand container navbar-dark">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="" class="nav-link">Accueil</a></li>
            </ul>
        </nav>
    </header>
    <main class="container">
        <div class="row">
            <!-- loop wordpress -->
            <?php while (have_posts()) : ?>
                <?php the_post() ; ?>
                <article class="col-3">
                    <div class="card">
                        <h2 class="card-header">
                            <?php echo $post->post_title ?>
                        </h2>
                    </div>
                </article>
            <?php endwhile ?>
        </div>
    </main>
    <?php wp_footer() ?>
</body>
</html>
