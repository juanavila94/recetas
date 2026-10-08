<?php get_header(); ?>
<section class="hero"><div class="container">
    <p class="eyebrow">Recetas para todos los días</p>
    <h1>Encontrá algo rico para cocinar hoy.</h1>
    <p class="intro">Explorá recetas por categoría y dificultad. Guardá tus favoritas y compartí la mesa.</p>
    <a class="button" href="<?php echo esc_url(get_post_type_archive_link('receta')); ?>">Ver todas las recetas</a>
</div></section>
<main class="content"><div class="container">
    <div class="section-heading"><h2>Últimas recetas</h2><a href="<?php echo esc_url(get_post_type_archive_link('receta')); ?>">Ver recetario completo</a></div>
    <?php $recipes = new WP_Query(['post_type' => 'receta', 'posts_per_page' => 6]); ?>
    <?php if ($recipes->have_posts()) : ?><div class="recipe-grid">
        <?php while ($recipes->have_posts()) : $recipes->the_post(); get_template_part('template-parts/recipe-card'); endwhile; wp_reset_postdata(); ?>
    </div><?php else : ?><p class="empty-state">Todavía no hay recetas. Creá la primera desde el panel de WordPress: Recetas → Agregar receta.</p><?php endif; ?>
</div></main>
<section class="recipe-exchange"><div class="container">
    <div class="section-heading"><div><p class="eyebrow">Compartir la mesa</p><h2>¿Tenés una receta para compartir?</h2></div></div>
    <div class="exchange-grid">
        <article class="exchange-card">
            <h3>Compartir una receta</h3>
            <p>Mandale a alguien el recetario para que encuentre algo rico.</p>
            <a class="button" href="mailto:?subject=<?php echo rawurlencode('Mirá este recetario'); ?>&body=<?php echo rawurlencode('Te comparto este recetario: ' . home_url('/')); ?>">Abrir mail</a>
        </article>
        <article class="exchange-card">
            <h3>Recibir una receta</h3>
            <p>Elegí una foto y probala en una receta. Por ahora queda sólo en memoria.</p>
            <form class="recipe-upload" action="#" method="post" enctype="multipart/form-data">
                <?php $memory_recipes = get_posts(['post_type' => 'receta', 'posts_per_page' => 20]); ?>
                <?php if ($memory_recipes) : ?>
                    <label for="recipe-target">Receta</label>
                    <select id="recipe-target" name="recipe_target">
                        <?php foreach ($memory_recipes as $memory_recipe) : ?>
                            <option value="<?php echo esc_attr($memory_recipe->ID); ?>"><?php echo esc_html($memory_recipe->post_title); ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php endif; ?>
                <label for="recipe-file">Archivo de receta</label>
                <input id="recipe-file" name="recipe_file" type="file" accept="image/*">
                <p class="file-status" aria-live="polite">Todavía no elegiste ningún archivo.</p>
            </form>
            <div class="memory-preview" hidden>
                <p>Vista previa en memoria</p>
                <img id="memory-preview-image" alt="Vista previa de la foto elegida">
            </div>
        </article>
    </div>
</div></section>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('recipe-file');
    const status = document.querySelector('.file-status');
    const preview = document.querySelector('.memory-preview');
    const previewImage = document.getElementById('memory-preview-image');
    let selectedRecipeFile = null;
    if (!input || !status || !preview || !previewImage) return;

    input.addEventListener('change', function () {
        selectedRecipeFile = input.files[0] || null;
        if (!selectedRecipeFile) {
            status.textContent = 'Todavía no elegiste ningún archivo.';
            preview.hidden = true;
            previewImage.removeAttribute('src');
            return;
        }

        status.textContent = 'Foto lista: ' + selectedRecipeFile.name;
        previewImage.src = URL.createObjectURL(selectedRecipeFile);
        preview.hidden = false;
    });
});
</script>
<?php get_footer(); ?>
