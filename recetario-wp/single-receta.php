<?php get_header(); ?>
<main class="content"><article class="container single-recipe">
<?php while (have_posts()) : the_post(); ?>
    <p class="eyebrow">Receta</p><h1><?php the_title(); ?></h1>
    <p><?php recetario_recipe_terms(get_the_ID(), 'categoria_receta'); recetario_recipe_terms(get_the_ID(), 'dificultad_receta'); ?></p>
    <?php if (has_post_thumbnail()) : ?><div class="featured-image"><?php the_post_thumbnail('large'); ?></div><?php endif; ?>
    <div class="entry-content"><?php the_content(); ?></div>
<?php endwhile; ?>
</article></main>
<?php get_footer(); ?>
