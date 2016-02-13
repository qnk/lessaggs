<?php

get_header();

?>

<?php get_template_part( 'main' , 'slider' ); ?>

<?php wp_nav_menu(
   array(
        'theme-location' => 'main-products-home',
        'fallback_cb'    => false
)); ?>

<?php echo get_terms( 'product_cat', $args ); ?>

<?php
// Change number or products per row to 3

add_filter( 'loop_shop_columns', 'wc_loop_shop_columns', 1, 10 );
/*
 * Return a new number of maximum columns for shop archives
 * @param int Original value
 * @return int New number of columns
 */
function wc_loop_shop_columns( $number_columns ) {
	return 2;
}

?>

<ul class="products featuredProducts active">
    <?php
        $args = array( 'post_type' => 'product', 'posts_per_page' => 8, 'product_cat' => 'destacados', 'orderby' => 'rand', 'columns' => '4' );
        include(locate_template('wc-loop-mainpage.php'));
    ?>
</ul>

<ul class="products menProducts">
    <?php
        $args = array( 'post_type' => 'product', 'posts_per_page' => 8, 'product_cat' => 'hombre', 'orderby' => 'rand', 'columns' => '4'  );
        include(locate_template('wc-loop-mainpage.php'));
    ?>
</ul>

<ul class="products childProducts">
    <?php
        $args = array( 'post_type' => 'product', 'posts_per_page' => 8, 'product_cat' => 'nino', 'orderby' => 'rand', 'columns' => '4'  );       
        include(locate_template('wc-loop-mainpage.php'));
    ?>
 
</ul>

<ul class="products selfmadeProducts">
    <?php
        $args = array( 'post_type' => 'product', 'posts_per_page' => 8, 'product_cat' => 'personalizacion', 'orderby' => 'rand', 'columns' => '4'  );
        include(locate_template('wc-loop-mainpage.php'));
    ?>
</ul>

<?php

get_footer();

?>