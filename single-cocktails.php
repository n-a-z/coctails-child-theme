<?php get_header(); ?>

<?php

while (have_posts()) :
    the_post();
?>

<?php
$drinkId = get_field('iddrink');
$drinkName = get_field('strdrink');
$drinkAlternate = get_field('strdrinkalternate');
$drinkTags = get_field('strtags');
$drinkVideo = get_field('strvideo');
$drinkCategory = get_field('strcategory');
$drinkIba = get_field('striba');
$drinkImage = get_field('strimagesource');
$drinkAlcoholic = get_field('stralcoholic');
$drinkGlass = get_field('strglass');
$drinkInstruction = get_field('strinstructions');
$trinkThumbnail = get_field('strdrinkthumb');
$drinkIngredients = get_field('ingredients');
$drinkMeasures = get_field('measures');
?>
    <main id="content" <?php post_class('site-main'); ?>>

        <?php if (apply_filters('hello_elementor_page_title', true)) : ?>
            <header class="page-header">
                <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
            </header>
        <?php endif; ?>

        <div class="page-content">
            <?php the_content(); ?>
            <div class="post-acf">
                <table>
                    <thead>
                        <tr>
                            <?php if ($drinkId) : ?>
                                <th>ID</th>
                            <?php endif; ?>
                            <?php if ($drinkName) : ?>
                                <th>Name</th>
                            <?php endif; ?>
                            <?php if ($drinkAlternate) : ?>
                                <th>Alternate</th>
                            <?php endif; ?>
                            <?php if ($drinkTags) : ?>
                                <th>Tags</th>
                            <?php endif; ?>
                            <?php if ($drinkVideo) : ?>
                                <th>Video</th>
                            <?php endif; ?>
                            <?php if ($drinkCategory) : ?>
                                <th>Category</th>
                            <?php endif; ?>
                            <?php if ($drinkIba) : ?>
                                <th>IBA</th>
                            <?php endif; ?>
                            <?php if ($drinkImage) : ?>
                                <th>Image</th>
                            <?php endif; ?>
                            <?php if ($drinkAlcoholic) : ?>
                                <th>Type</th>
                            <?php endif; ?>
                            <?php if ($drinkGlass) : ?>
                                <th>Glass</th>
                            <?php endif; ?>
                            <?php if ($drinkInstruction) : ?>
                                <th>Instruction</th>
                            <?php endif; ?>
                            <?php if ($trinkThumbnail) : ?>
                                <th>Thumbnail</th>
                            <?php endif; ?>
                            <?php if ($drinkIngredients) : ?>
                                <th>Ingredients</th>
                            <?php endif; ?>
                            <?php if ($drinkMeasures) : ?>
                                <th>Measures</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php if ($drinkId) : ?>
                                <td><?php echo $drinkId ?></td>
                            <?php endif; ?>
                            <?php if ($drinkName) : ?>
                                <td><?php echo $drinkName ?></td>
                            <?php endif; ?>
                            <?php if ($drinkAlternate) : ?>
                                <td><?php echo $drinkAlternate ?></td>
                            <?php endif; ?>
                            <?php if ($drinkTags) : ?>
                                <td><?php echo $drinkTags ?></td>
                            <?php endif; ?>
                            <?php if ($drinkVideo) : ?>
                                <td><a href="<?php echo $drinkVideo ?>" target="_blank">Watch video</a></td>
                            <?php endif; ?>
                            <?php if ($drinkCategory) : ?>
                                <td><?php echo $drinkCategory ?></td>
                            <?php endif; ?>
                            <?php if ($drinkIba) : ?>
                                <td><?php echo $drinkIba ?></td>
                            <?php endif; ?>
                            <?php if ($drinkImage) : ?>
                                <td><img src="<?php echo $drinkImage ?>" alt="<?php echo $drinkName ?>"></td>
                            <?php endif; ?>
                            <?php if ($drinkAlcoholic) : ?>
                                <td><?php echo $drinkAlcoholic ?></td>
                            <?php endif; ?>
                            <?php if ($drinkGlass) : ?>
                                <td><?php echo $drinkGlass ?></td>
                            <?php endif; ?>
                            <?php if ($drinkInstruction) : ?>
                                <td><?php echo $drinkInstruction ?></td>
                            <?php endif; ?>
                            <?php if ($trinkThumbnail) : ?>
                                <td><img src="<?php echo $trinkThumbnail ?>" alt="<?php echo $drinkName ?>"></td>
                            <?php endif; ?>
                            <?php if ($drinkIngredients) : ?>
                                <td><?php echo $drinkIngredients ?></td>
                            <?php endif; ?>
                            <?php if ($drinkMeasures) : ?>
                                <td><?php echo $drinkMeasures ?></td>
                            <?php endif; ?>
                        </tr>
                    </tbody>
                </table>
            </div>
            <?php wp_link_pages(); ?>
        </div>

        <?php comments_template(); ?>

    </main>

<?php
endwhile;
?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
