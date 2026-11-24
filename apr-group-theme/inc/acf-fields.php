<?php
/**
 * APR Group - ACF Custom Field Definitions & Dynamic Meta
 * 
 * Defines editable project rates, location addresses, plot sizes, and photo galleries
 * manageable through the WordPress dashboard.
 */

if (!defined('ABSPATH')) {
    exit;
}

// Register ACF Field Group in PHP
add_action('acf/init', 'apr_register_acf_fields');
function apr_register_acf_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key' => 'group_apr_project_meta',
            'title' => 'Project Details & Rate Settings',
            'fields' => array(
                array(
                    'key' => 'field_apr_rate_sqft',
                    'label' => 'Rate Per Square Foot (₹)',
                    'name' => 'rate_per_sqft',
                    'type' => 'number',
                    'instructions' => 'Enter listed rate in INR per Sq. Ft. (e.g. 2500, 1300, 2300, 1000)',
                    'required' => 1,
                    'min' => 100,
                    'max' => 100000,
                    'step' => 1,
                ),
                array(
                    'key' => 'field_apr_location_address',
                    'label' => 'Exact Project Location',
                    'name' => 'location_address',
                    'type' => 'text',
                    'instructions' => 'e.g. Siddhi Vinayak Colony, Rajpura Phase 1, Bhadohi',
                    'required' => 1,
                ),
                array(
                    'key' => 'field_apr_badge_text',
                    'label' => 'Project Badge / Highlight Text',
                    'name' => 'badge_text',
                    'type' => 'text',
                    'instructions' => 'e.g. Prime Head Office Location, Best Budget Value, High Demand',
                    'default_value' => 'Verified Location',
                ),
                array(
                    'key' => 'field_apr_short_desc',
                    'label' => 'Short Card Summary',
                    'name' => 'short_description',
                    'type' => 'textarea',
                    'rows' => 3,
                    'instructions' => '1-2 sentence description displayed on project archive cards',
                ),
                array(
                    'key' => 'field_apr_whatsapp_phone',
                    'label' => 'WhatsApp Number for Enquiries',
                    'name' => 'whatsapp_phone',
                    'type' => 'text',
                    'default_value' => '916392199296',
                )
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'apr_project',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
        ));
    }
}

// Fallback Helper Functions for Theme & Elementor Dynamic Tags
function apr_get_project_rate($post_id = null) {
    if (!$post_id) $post_id = get_the_ID();
    $rate = get_post_meta($post_id, 'rate_per_sqft', true);
    if (!$rate && function_exists('get_field')) {
        $rate = get_field('rate_per_sqft', $post_id);
    }
    return $rate ? intval($rate) : 1500;
}

function apr_get_project_location($post_id = null) {
    if (!$post_id) $post_id = get_the_ID();
    $loc = get_post_meta($post_id, 'location_address', true);
    if (!$loc && function_exists('get_field')) {
        $loc = get_field('location_address', $post_id);
    }
    return $loc ? esc_html($loc) : 'Bhadohi, Uttar Pradesh';
}
