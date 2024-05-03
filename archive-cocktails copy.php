<?php get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php
        // Get all categories of the custom post type 'cocktails'
        $categories = get_categories(array(
            'taxonomy' => 'category', // Assuming 'category' is the taxonomy for your cocktails
            'hide_empty' => false // Show empty categories as well
        ));

        // Loop through each category
        foreach ($categories as $category) :
        ?>
            <section class="category-section">
                <h2 class="category-title"><?php echo $category->name; ?></h2>
                <ul class="cocktail-list">
                    <?php
                    // Custom query to fetch cocktails in the current category
                    $cocktails_query = new WP_Query(array(
                        'post_type' => 'cocktails',
                        'posts_per_page' => -1, // Display all posts
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'category',
                                'field' => 'slug',
                                'terms' => $category->slug // Current category slug
                            )
                        )
                    ));

                    // Check if there are cocktails in the current category
                    if ($cocktails_query->have_posts()) :
                        while ($cocktails_query->have_posts()) : $cocktails_query->the_post();
                            // $post_link = get_permalink($post->slug);
                            $post_link = $post->post_name;
                    ?>
                            <li class="cocktail-item">
                                <a href="<?php echo $post_link; ?>"><?php the_title(); ?></a>
                            </li>
                    <?php
                        endwhile;
                        wp_reset_postdata(); // Reset post data
                    else :
                        // If no cocktails found in the current category
                        echo '<li>No cocktails found in this category.</li>';
                    endif;
                    ?>
                </ul>
            </section>
        <?php endforeach; ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>