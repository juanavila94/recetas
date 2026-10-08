<?php
/** Theme setup and recipe content model. */

if (!defined('ABSPATH')) {
    exit;
}

function recetario_setup(): void
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
    register_nav_menus(['primary' => __('Menú principal', 'recetario')]);
}
add_action('after_setup_theme', 'recetario_setup');

function recetario_assets(): void
{
    wp_enqueue_style('recetario-style', get_stylesheet_uri(), [], '1.0.0');
}
add_action('wp_enqueue_scripts', 'recetario_assets');

function recetario_register_content(): void
{
    register_post_type('receta', [
        'labels' => [
            'name' => __('Recetas', 'recetario'),
            'singular_name' => __('Receta', 'recetario'),
            'add_new_item' => __('Agregar receta', 'recetario'),
            'edit_item' => __('Editar receta', 'recetario'),
            'all_items' => __('Todas las recetas', 'recetario'),
        ],
        'public' => true,
        'has_archive' => 'recetas',
        'rewrite' => ['slug' => 'receta'],
        'menu_icon' => 'dashicons-carrot',
        'show_in_rest' => true,
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
    ]);

    foreach ([
        'categoria_receta' => ['Categorías', 'Categoría', 'categoria'],
        'dificultad_receta' => ['Dificultades', 'Dificultad', 'dificultad'],
    ] as $taxonomy => [$plural, $singular, $slug]) {
        register_taxonomy($taxonomy, 'receta', [
            'labels' => ['name' => __($plural, 'recetario'), 'singular_name' => __($singular, 'recetario')],
            'public' => true,
            'hierarchical' => true,
            'show_in_rest' => true,
            'rewrite' => ['slug' => $slug],
        ]);
    }
}
add_action('init', 'recetario_register_content');

function recetario_activate(): void
{
    recetario_register_content();
    foreach (['carne' => 'Carne', 'pasta' => 'Pasta', 'pescado' => 'Pescado'] as $slug => $name) {
        if (!term_exists($slug, 'categoria_receta')) {
            wp_insert_term($name, 'categoria_receta', ['slug' => $slug]);
        }
    }
    foreach (['basica' => 'Básica', 'intermedia' => 'Intermedia'] as $slug => $name) {
        if (!term_exists($slug, 'dificultad_receta')) {
            wp_insert_term($name, 'dificultad_receta', ['slug' => $slug]);
        }
    }
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'recetario_activate');

function recetario_recipe_terms(int $post_id, string $taxonomy): void
{
    $terms = get_the_terms($post_id, $taxonomy);
    if (!is_wp_error($terms) && !empty($terms)) {
        foreach ($terms as $term) {
            printf('<span class="tag">%s</span>', esc_html($term->name));
        }
    }
}
