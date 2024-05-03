<?php

function enqueue_parent_styles()
{
    wp_enqueue_style('parent-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'enqueue_parent_styles');

function cptui_register_my_cpts_cocktails()
{

    /**
     * Post Type: cocktails.
     */

    $labels = [
        "name" => esc_html__("Cocktails", "custom-post-type-ui"),
        "singular_name" => esc_html__("Cocktail", "custom-post-type-ui"),
        "add_new" => esc_html__("Add New Cocktail", "custom-post-type-ui"),
    ];

    $args = [
        "label" => esc_html__("Cocktails", "custom-post-type-ui"),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "rest_namespace" => "wp/v2",
        "has_archive" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "can_export" => false,
        "rewrite" => ["slug" => "cocktails", "with_front" => true],
        "query_var" => true,
        "supports" => ["title", "editor", "thumbnail", "excerpt", "post_tag"],
        "show_in_graphql" => false,
        "taxonomies" => array("category"),
    ];

    register_post_type("cocktails", $args);
}

add_action('init', 'cptui_register_my_cpts_cocktails');

// Get JSON data from the API
$json_data = file_get_contents('https://www.thecocktaildb.com/api/json/v1/1/search.php?s=');

// Decode JSON data
$drinks = json_decode($json_data, true);

// Check if decoding was successful
if ($drinks !== null) {
    foreach ($drinks['drinks'] as $drink) {
        // Check if post with the same title already exists
        $existing_post = get_page_by_title($drink['strDrink'], OBJECT, 'cocktails'); // Assuming your custom post type is named 'cocktails'

        if ($existing_post == null) { // Post doesn't exist, create a new one
            // Prepare post data
            $post_data = array(
                'post_title'   => $drink['strDrink'],
                //'post_content' => 'ID: ' . $drink['idDrink'], // You can customize this as needed
                'post_status'  => 'publish',
                'post_type'    => 'cocktails', // Your custom post type
            );

            // Insert the post into the database
            $post_id = wp_insert_post($post_data);

            // Optionally, you can add custom meta data to the post
            if ($post_id && !is_wp_error($post_id)) {
                // Set ACF field values
                update_field('iddrink', $drink['idDrink'], $post_id);
                update_field('strdrink', $drink['strDrink'], $post_id);
                update_field('strdrinkalternate', $drink['strDrinkAlternate'], $post_id);
                update_field('strtags', $drink['strTags'], $post_id);
                update_field('strvideo', $drink['strVideo'], $post_id);
                update_field('strcategory', $drink['strCategory'], $post_id);
                update_field('striba', $drink['strIBA'], $post_id);
                update_field('strimagesource', $drink['strImageSource'], $post_id);
                update_field('stralcoholic', $drink['strAlcoholic'], $post_id);
                update_field('strglass', $drink['strGlass'], $post_id);
                update_field('strinstructions', $drink['strInstructions'], $post_id);
                update_field('strdrinkthumb', $drink['strDrinkThumb'], $post_id);

                $ingredients = '';
                $measures = '';

                for ($i = 1; $drink["strIngredient$i"] !== null; $i++) {
                    // Check if the ingredient value is not empty
                    if ($drink["strIngredient$i"] !== "") {
                        $ingredient = $drink["strIngredient$i"];
                        $measure = $drink["strMeasure$i"] ?? ''; // Use nullish coalescing for optional measure

                        // Combine ingredient and measure (if available)
                        $combined = $ingredient . (!empty($measure) ? ' (' . $measure . ')' : '');

                        $ingredients .= $ingredient . ', ';
                        $measures .= $combined . ', ';
                    }
                }

                // Remove the trailing comma (if any)
                $ingredients = rtrim($ingredients, ', ');
                $measures = rtrim($measures, ', ');

                update_field('ingredients', $ingredients, $post_id);
                update_field('measures', $measures, $post_id);

                // Create and assign categories
                $category = $drink['strCategory'];
                $term = term_exists($category, 'category'); // Check if category already exists

                if (!$term) {
                    // Category doesn't exist, create it
                    $term = wp_insert_term($category, 'category');
                }

                // Assign the category to the post
                if (!is_wp_error($term)) {
                    wp_set_post_categories($post_id, array($term['term_id']));
                }
            }
        } else {
            // Post already exists, do something else if needed
            // For example, update existing post or skip it
            // Here, we're just logging that the post already exists
            error_log('Post with title "' . $drink['strDrink'] . '" already exists.');
        }
    }
} else {
    // Handle JSON decoding error
    echo 'Failed to decode JSON data';
}

function enqueue_scripts() {
    wp_enqueue_script('jquery'); // Enqueue jQuery
    wp_enqueue_script('ingredient-filter', get_stylesheet_directory_uri() . '/js/ingredient-filter.js', array('jquery'), '1.0.0', true);
  }
  add_action('wp_enqueue_scripts', 'enqueue_scripts');