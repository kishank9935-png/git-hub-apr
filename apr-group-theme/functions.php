<?php
/**
 * APR Group Theme Functions and Definitions
 * Full WordPress & Elementor Compatibility Engine
 */

if (!defined('ABSPATH')) {
    exit;
}

require_once get_template_directory() . '/inc/acf-fields.php';
require_once get_template_directory() . '/inc/google-reviews.php';

// Theme Setup
function apr_group_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array(
        'height'      => 60,
        'width'       => 220,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script'));
    add_theme_support('responsive-embeds');
    add_theme_support('align-wide');

    // Register Nav Menus
    register_nav_menus(array(
        'primary' => __('Primary Navigation Menu', 'apr-group'),
        'footer'  => __('Footer Quick Links', 'apr-group'),
    ));
}
add_action('after_setup_theme', 'apr_group_setup');

// Register Custom Post Type: Projects (apr_project)
function apr_register_project_post_type() {
    $labels = array(
        'name'               => __('Projects', 'apr-group'),
        'singular_name'      => __('Project', 'apr-group'),
        'menu_name'          => __('Plot Projects', 'apr-group'),
        'add_new'            => __('Add New Project', 'apr-group'),
        'add_new_item'       => __('Add New Plot Project', 'apr-group'),
        'edit_item'          => __('Edit Project', 'apr-group'),
        'new_item'           => __('New Project', 'apr-group'),
        'view_item'          => __('View Project', 'apr-group'),
        'search_items'       => __('Search Projects', 'apr-group'),
        'not_found'          => __('No projects found', 'apr-group'),
        'not_found_in_trash' => __('No projects found in Trash', 'apr-group'),
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'has_archive'         => 'projects',
        'rewrite'             => array('slug' => 'projects'),
        'menu_icon'           => 'dashicons-location-alt',
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'show_in_rest'        => true, // Enables Gutenberg & Elementor
    );

    register_post_type('apr_project', $args);
}
add_action('init', 'apr_register_project_post_type');

// Elementor Theme Locations Support
function apr_register_elementor_locations($elementor_theme_manager) {
    $elementor_theme_manager->register_location('header');
    $elementor_theme_manager->register_location('footer');
    $elementor_theme_manager->register_location('single');
    $elementor_theme_manager->register_location('archive');
}
add_action('elementor/theme/register_locations', 'apr_register_elementor_locations');

// Enqueue Styles and Scripts
function apr_group_scripts() {
    $uri = get_template_directory_uri();
    
    // Core Brand Stylesheet
    wp_enqueue_style('apr-brand-system', $uri . '/assets/css/brand-system.css', array(), '2.0.0');
    wp_enqueue_style('apr-components', $uri . '/assets/css/components.css', array('apr-brand-system'), '2.0.0');
    wp_enqueue_style('apr-main-theme-style', get_stylesheet_uri(), array('apr-components'), '2.0.0');

    // JS Scripts
    wp_enqueue_script('apr-calculator', $uri . '/assets/js/calculator.js', array(), '2.0.0', true);
    wp_enqueue_script('apr-gallery', $uri . '/assets/js/gallery.js', array(), '2.0.0', true);
    wp_enqueue_script('apr-contact', $uri . '/assets/js/contact.js', array(), '2.0.0', true);
    wp_enqueue_script('apr-main', $uri . '/assets/js/main.js', array(), '2.0.0', true);
}
add_action('wp_enqueue_scripts', 'apr_group_scripts');

// Shortcode: [apr_plot_calculator] for Drag & Drop in Elementor
function apr_shortcode_calculator() {
    ob_start();
    get_template_part('template-parts/calculator/smart-calculator');
    return ob_get_clean();
}
add_shortcode('apr_plot_calculator', 'apr_shortcode_calculator');

// Shortcode: [apr_project_grid] for Displaying Project Cards in Elementor
function apr_shortcode_project_grid($atts) {
    $atts = shortcode_atts(array(
        'count' => 6,
        'columns' => 3
    ), $atts);

    ob_start();
    $projects_query = new WP_Query(array(
        'post_type'      => 'apr_project',
        'posts_per_page' => intval($atts['count']),
        'orderby'        => 'menu_order',
        'order'          => 'ASC'
    ));

    echo '<div class="grid-' . esc_attr($atts['columns']) . ' text-left">';
    if ($projects_query->have_posts()) {
        while ($projects_query->have_posts()) {
            $projects_query->the_post();
            get_template_part('template-parts/projects/card');
        }
        wp_reset_postdata();
    } else {
        // Fallback default 6 projects if no custom posts added yet
        include get_template_directory() . '/template-parts/projects/default-cards.php';
    }
    echo '</div>';

    return ob_get_clean();
}
add_shortcode('apr_project_grid', 'apr_shortcode_project_grid');

// Seed Default Projects on Theme Activation (if empty)
function apr_seed_default_projects() {
    if (get_option('apr_projects_seeded')) return;

    $defaults = array(
        array(
            'title'   => 'Rajpura Phase 1',
            'rate'    => 2500,
            'loc'     => 'Siddhi Vinayak Colony, Rajpura, Bhadohi',
            'desc'    => 'Our flagship residential plotting development at Siddhi Vinayak Colony, Rajpura Phase 1.',
            'badge'   => 'Prime Head Office Location',
            'slug'    => 'rajpura-phase-1'
        ),
        array(
            'title'   => 'Ugapur, Bhadohi',
            'rate'    => 1300,
            'loc'     => 'Ugapur, Bhadohi, Uttar Pradesh',
            'desc'    => 'Affordable residential land choices for buyers seeking accessible location with solid future development prospects.',
            'badge'   => 'Affordable Growth',
            'slug'    => 'ugapur'
        ),
        array(
            'title'   => 'Kanshraipur',
            'rate'    => 2300,
            'loc'     => 'Kanshraipur, Bhadohi, Uttar Pradesh',
            'desc'    => 'Popular plotting location with prominent residential growth, wide planned access and close proximity to key town facilities.',
            'badge'   => 'High Demand',
            'slug'    => 'kanshraipur'
        ),
        array(
            'title'   => 'Chauri Bazar',
            'rate'    => 1300,
            'loc'     => 'Chauri Bazar, Bhadohi, Uttar Pradesh',
            'desc'    => 'Strategic residential land located near Chauri Bazar, ideal for residents looking for community living with convenient market access.',
            'badge'   => 'Market Connectivity',
            'slug'    => 'chauri-bazar'
        ),
        array(
            'title'   => 'Gosai Bazar, Gyanpur',
            'rate'    => 1000,
            'loc'     => 'Gosai Bazar, Gyanpur, Uttar Pradesh',
            'desc'    => 'Most budget-friendly residential land opportunity across the Gyanpur corridor, delivering generous plot sizes.',
            'badge'   => 'Best Budget Value',
            'slug'    => 'gosai-bazar'
        ),
        array(
            'title'   => 'Parjapatpur, Bhadohi',
            'rate'    => 1200,
            'loc'     => 'Parjapatpur, Bhadohi, Uttar Pradesh',
            'desc'    => 'Peaceful residential plotting zone providing spacious land options at attractive rates for buyers seeking quiet neighborhood surroundings.',
            'badge'   => 'Serene Surroundings',
            'slug'    => 'parjapatpur'
        )
    );

    foreach ($defaults as $item) {
        $existing = get_page_by_path($item['slug'], OBJECT, 'apr_project');
        if (!$existing) {
            $post_id = wp_insert_post(array(
                'post_title'   => $item['title'],
                'post_name'    => $item['slug'],
                'post_content' => $item['desc'],
                'post_status'  => 'publish',
                'post_type'    => 'apr_project'
            ));
            if ($post_id) {
                update_post_meta($post_id, 'rate_per_sqft', $item['rate']);
                update_post_meta($post_id, 'location_address', $item['loc']);
                update_post_meta($post_id, 'badge_text', $item['badge']);
                update_post_meta($post_id, 'short_description', $item['desc']);
                update_post_meta($post_id, 'whatsapp_phone', '916392199296');
            }
        }
    }
    update_option('apr_projects_seeded', true);
}
add_action('after_switch_theme', 'apr_seed_default_projects');
