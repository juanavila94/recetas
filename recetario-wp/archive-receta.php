<?php get_header();
$category = isset($_GET['categoria']) ? sanitize_key(wp_unslash($_GET['categoria'])) : '';
$difficulty = isset($_GET['dificultad']) ? sanitize_key(wp_unslash($_GET['dificultad'])) : '';
$tax_query = ['relation' => 'AND'];
if ($category) { $tax_query[] = ['taxonomy' => 'categoria_receta', 'field' => 'slug', 'terms' => $category]; }
if ($difficulty) { $tax_query[] = ['taxonomy' => 'dificultad_receta', 'field' => 'slug', 'terms' => $difficulty]; }
$recipes = new WP_Query(['post_type' => 'receta', 'posts_per_page' => 12, 'paged' => max(1, get_query_var('paged')), 'tax_query' => count($tax_query) > 1 ? $tax_query : []]);
?>
<main class="content"><div class="container">
    <p class="eyebrow">El recetario</p><h1>Elegí tu próxima receta</h1>
    <form class="filters" method="get" action="<?php echo esc_url(get_post_type_archive_link('receta')); ?>">
        <input type="hidden" name="post_type" value="receta">
        <label>Categoría<select name="categoria"><option value="">Todas</option><?php foreach (get_terms(['taxonomy' => 'categoria_receta', 'hide_empty' => false]) as $term) : ?><option value="<?php echo esc_attr($term->slug); ?>" <?php selected($category, $term->slug); ?>><?php echo esc_html($term->name); ?></option><?php endforeach; ?></select></label>
        <label>Dificultad<select name="dificultad"><option value="">Todas</option><?php foreach (get_terms(['taxonomy' => 'dificultad_receta', 'hide_empty' => false]) as $term) : ?><option value="<?php echo esc_attr($term->slug); ?>" <?php selected($difficulty, $term->slug); ?>><?php echo esc_html($term->name); ?></option><?php endforeach; ?></select></label>
        <button type="submit">Filtrar</button>
    </form>
    <?php if ($recipes->have_posts()) : ?><div class="recipe-grid"><?php while ($recipes->have_posts()) : $recipes->the_post(); get_template_part('template-parts/recipe-card'); endwhile; ?></div><?php wp_reset_postdata(); ?>
    <?php else : ?><p class="empty-state">No encontramos recetas con esos filtros.</p><?php endif; ?>
</div></main>
<?php get_footer(); ?>
