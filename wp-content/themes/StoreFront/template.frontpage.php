<?php
/*
Template Name: Frontpage
*/

global $gk_tpl, $post;

//remove automatic paragraph in wordpress editor for the frontpage based on posts
remove_filter('the_content', 'wpautop');

gk_load('header');

// get the frontpage template
$front = get_page_by_path('frontpage-source');

//create arguments for custom main loop
$args_global = array( 
	'post_type' => 'page',
	'post_parent' => $front->ID,
	'order' => 'ASC',
	'posts_per_page' => -1
);
$loop_global = new WP_Query( $args_global );

// set counters
$counter = 0;
$counter_slides = 0;

// settings connected with the slider
$autoanim = 'off';
if (get_option($gk_tpl->name . '_slider_autoanimation', 'Y') == 'Y') {
	$autoanim = 'on';
}
$speed = get_option($gk_tpl->name . '_slider_speed', '200');
$interval = get_option($gk_tpl->name . '_slider_interval', '5000');

// settings connected with the tabs
$tab_autoanim = 'disabled';
if ($tab_autoanim = get_option($gk_tpl->name . '_tab_autoanimation', 'N') == 'Y') {
	$tab_autoanim = 'enabled';
}
$tab_interval = $interval = get_option($gk_tpl->name . '_tab_interval', '5000');
?>


<?php if ( have_posts() ) : ?>
		<?php while ( $loop_global->have_posts() ) : $loop_global->the_post(); ?>
		
		<?php 
			$args = array(
		      'post_parent' => $post->ID,
		      'post_type'   => 'page', 
		      'posts_per_page' => 1,
		      'post_status' => 'publish' 
		    ); 
		    
		    $children = get_children($args); ?>
		
		<?php if(!empty($children) && $counter == 0) : ?>
			
		<div id="gk-header-mod">
			<div id="gk-is-storefront" class="gk-is-wrapper-gk-storefront" data-speed="<?php echo $speed; ?>" data-interval="<?php echo $interval; ?>" data-autoanim="<?php echo $autoanim; ?>">
			<div class="gk-is-preloader"><span></span></div>
				<div class="gk-is-image-wrapper">
				
				<?php 
				$query = new WP_Query( array ( 'post_type' => 'page', 'post_parent' => $post->ID) );
				while ( $query->have_posts() ) : $query->the_post();
				 ?>					
					<figure data-zindex="<?php echo $counter; ?>" data-url="<?php echo wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ); ?>" data-link="<?php echo get_post_meta( $post->ID, 'slide_url', true ); ?>" data-title="<?php the_title(); ?>">
						<figcaption>
							<?php the_content(); ?>
						</figcaption>
					</figure>
					<?php $counter_slides++; ?>
				<?php endwhile; ?>	
	
					<?php if (get_option($gk_tpl->name . '_slider_navigation', 'Y') == 'Y') : ?>
					<ul class="gk-is-pagination">				
					<?php 
						for($j = 0; $j < $counter_slides; $j++) {
							echo '<li'.($j == 0 ? ' class="active"' : '').'>'.($j+1).'</li>';
						}
					?>			
					</ul>
					<?php endif; ?>
					
				</div>
			</div>
		</div>
		
	  	<?php elseif(!empty($children) && $counter > 0) : ?>
	  	<?php
	  	
	  		$args_tabs = array(
	  		  'post_parent' => $post->ID, // the ID from your loop
	  		  'post_type'   => 'page', 
	  		  'posts_per_page' => -1,
	  		  'post_status' => 'publish',
	  		  'order' => 'ASC'
	  		); 
	  	?>
	  		<div class="gk-page">
	  			<div class="gk-bottom">
		  		<h3 class="box-title bigtitle"><small><?php echo get_the_title(); ?></small></h3>
		  		<div id="gk-tabs">
		  			<div class="gk-tabs" data-event="click" data-autoanim="<?php echo $tab_autoanim; ?>" data-speed="50" data-interval="<?php echo $tab_interval; ?>">
		  				<div class="gk-tabs-wrap">
		  					
		  					<?php
		  						$tabs = array();
		  						$tabs_content = array();
		  						$posts = get_posts($args_tabs);
		  						foreach ($posts as $post) {
		  							array_push($tabs, get_the_title());
		  							array_push($tabs_content, $post->post_content);
		  						}
		  						
		  					?>
		  					
		  					<ol class="gk-tabs-nav">
		  						<?php 
		  							for($i = 0; $i < count($tabs); $i++) {
		  								echo '<li'.(($i == 0) ? ' class="active"' : '').'>' .$tabs[$i]. '</li>';
		  							} 
		  						?>
		  					</ol>
		  					
		  					<div class="gk-tabs-container">
		  					<?php 
		  						for($j = 0; $j < count($tabs_content); $j++) {		  							 
		  							 echo '<div class="gk-tabs-item'.(($j == 0) ? ' active' : '').'">' . do_shortcode($tabs_content[$j]). '</div>';
		  						}
		  					
		  					
		  					?>	
		  					</div>
		  				</div>
		  			</div>
		  		</div>
		  		</div>
	  		</div>
	  	
	  	<?php else : ?>	
		<div class="gk-bottom">
		
			<?php if(has_post_thumbnail()) : ?>
			<div class="box parallax" style="background-image: url('<?php echo wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ); ?>');">
				<h3 class="box-title gk-page"><?php the_title(); ?></h3>
				<div class="gk-page">
					<?php the_content(); ?>
				</div>
			</div> 			
			<?php else : ?>
			<div class="box">
				<div class="gk-page">
					<?php the_content(); ?>
				</div>
			</div>
			<?php endif; ?>
		</div>
  			
  		
  		<?php endif; ?>
  		<?php $counter++; ?>
  		<?php endwhile; ?>	
  		<?php wp_reset_query(); ?>
  		
  		<?php if(gk_is_active_sidebar('bottom')) : ?>
  		<div id="gk-bottom">
  			<div class="widget-area gk-page">
  				<?php gk_dynamic_sidebar('bottom'); ?>
  			</div>
  		</div>
  		<?php endif; ?>
<?php else : ?>
	<section id="gk-mainbody">
		<article id="post-0" class="post no-results not-found">
			<header class="entry-header">
				<h1 class="entry-title"><?php _e( 'Nothing Found', GKTPLNAME ); ?></h1>
			</header>

			<div class="entry-content">
				<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', GKTPLNAME ); ?></p>
				<?php get_search_form(); ?>
			</div>
		</article>
	</section>
<?php endif; ?>

<?php
gk_load('footer');

// EOF