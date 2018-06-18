<?php
    require_once ('header.php');
?>

<body>
    <main>

        <section class="container">
    <!--        <form class = "post-form" method = "GET" action = "">-->
    <!--            <input type = "submit" name = "input-order" value = "Sort">-->
    <!--        </form>-->
            <?php

            $articles = selectArticles();

            if(isset($_GET["input-order"])){
                $articles = orderByTime();
            }

            foreach($articles as $article): ?>

                <div class="article-body">
                    <span class = "article-id"><?=$article['id']?></span>
                    <h2 class = "article-title"><a href = "<?=$article['url']?>" class = "url-link"><?=$article['title']?></a></h2>
                    <div class = "article-description"><?=$article['description']?></div>
                    <span class = "article-time"><?=$article['timeCreated']?></span>
                    <span class = "article-views"><?=$article['viewsAmount']?></span>
                </div>

            <?php endforeach; ?>
        </section>

    </main>
</body>
