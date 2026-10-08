<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="site-header">
    <div class="header-inner">
        <a class="brand" href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
        <nav class="main-nav" aria-label="<?php esc_attr_e('Navegación principal', 'recetario'); ?>">
            <?php wp_nav_menu(['theme_location' => 'primary', 'container' => false, 'fallback_cb' => 'recetario_default_menu']); ?>
        </nav>
    </div>
</header>
<?php
function recetario_default_menu(): void { ?>
    <ul><li><a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a></li><li><a href="<?php echo esc_url(get_post_type_archive_link('receta')); ?>">Recetas</a></li></ul>
<?php }
