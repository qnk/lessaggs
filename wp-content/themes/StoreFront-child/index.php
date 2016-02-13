<?php

get_header();

?>

<?php query_posts('post_type=post') ?>

<div class="col-md-2 col-lg-2">
<?php get_sidebar( 'left-blog' ); ?>
</div>

<div class="col-md-10 col-lg-10">

<?php
// WP_Query arguments
$args = array (
	'pagename'               => 'blog',
);

// The Query
$query = new WP_Query( $args );

?>

<?php
// The Loop
 if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>

<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>


 	<!-- Display the date (November 16th, 2009 format) and a link to other posts by this posts author. -->

 	<small><?php the_time('F jS, Y'); ?> by <?php the_author_posts_link(); ?></small>


 	<!-- Display the Post's content in a div box. -->

 	<div class="entry">
 		<?php the_content(); ?>
 	</div>


 	<!-- Display a comma separated list of the Post's Categories. -->

 	<p class="postmetadata"><?php _e( 'Posted in' ); ?> <?php the_category( ', ' ); ?></p>
 	</div> <!-- closes the first div box -->

 <?php endwhile; else : ?>

	<p>NO POSTS</p>
 <?php endif; ?>

<?php
// Restore original Post Data
wp_reset_postdata();
?>
</div>


<?php

get_footer();

?>		