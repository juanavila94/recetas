<article class="recipe-card">
    <a href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr(sprintf(__('Ver receta: %s', 'recetario'), get_the_title())); ?>">
        <?php if (has_post_thumbnail()) { the_post_thumbnail('medium_large'); } ?>
    </a>
    <div class="recipe-card__body">
        <div><?php recetario_recipe_terms(get_the_ID(), 'categoria_receta'); recetario_recipe_terms(get_the_ID(), 'dificultad_receta'); ?></div>
        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <?php the_excerpt(); ?>
    </div>
</article>
