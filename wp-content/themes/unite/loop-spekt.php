


<article>
    <div class="post">
        <div class="content">
           <a href="<?php the_permalink(); ?>"><h1><?php the_title(); ?></h1></a>
            <div>от <?php the_author_posts_link(); ?></div>
        </div>
        <div>
            <?php the_excerpt('...'); ?>
        </div>
        <div><a href="<?php the_permalink(); ?>">Читать весь пост</a></div>
    </div>
</article>
