<?php 
	
	/**
	 *
	 * Template header
	 *
	 **/
	
	// create an access to the template main object
	global $gk_tpl, $woocommerce;

?>
<?php do_action('gavernwp_doctype'); ?>
<html <?php do_action('gavernwp_html_attributes'); ?>>
<head>
	<title><?php do_action('gavernwp_title'); ?></title>
	<?php do_action('gavernwp_metatags'); ?>
	
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="shortcut icon" href="<?php get_stylesheet_directory_uri(); ?>/favicon.ico" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php
	wp_enqueue_style('gavern-normalize', gavern_file_uri('css/normalize.css'), false);
	wp_enqueue_style('gavern-font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.css', array('gavern-normalize'), '4.4.0' );
	wp_enqueue_style('gavern-template', gavern_file_uri('css/template.css'), array('gavern-font-awesome'));
	wp_enqueue_style('gavern-wp', gavern_file_uri('css/wp.css'), array('gavern-template'));
	wp_enqueue_style('gavern-stuff', gavern_file_uri('css/stuff.css'), array('gavern-wp'));
	wp_enqueue_style('gavern-wpextensions', gavern_file_uri('css/wp.extensions.css'), array('gavern-stuff'));
	wp_enqueue_style('gavern-extensions', gavern_file_uri('css/extensions.css'), array('gavern-wpextensions'));
	?>
	<?php if(get_option($gk_tpl->name . '_woocommerce_css', 'Y') == 'Y') : 
		wp_enqueue_style('gavern-woocommerce', gavern_file_uri('css/woocommerce.css'), array('gavern-extensions'));
	endif; ?>
	<!--[if IE 9]>
	<link rel="stylesheet" href="<?php echo gavern_file_uri('css/ie9.css'); ?>" />
	<![endif]-->
	<!--[if lt IE 9]>
	<link rel="stylesheet" href="<?php echo gavern_file_uri('css/ie8.css'); ?>" />
	<![endif]-->
	
	<?php if(is_singular() && get_option('thread_comments' )) wp_enqueue_script( 'comment-reply' ); ?>
	
	<?php do_action('gavernwp_ie_scripts'); ?>
	
	<?php gk_head_shortcodes(); ?>
		  
	<?php 
	 gk_load('responsive_css'); 
	 
	 if(get_option($gk_tpl->name . "_overridecss_state", 'Y') == 'Y') {
	   wp_enqueue_style('gavern-override', gavern_file_uri('css/override.css'), array('gavern-style'));
	 }
	?>
	
	<?php
	if(get_option($gk_tpl->name . '_prefixfree_state', 'N') == 'Y') {
	  wp_enqueue_script('gavern-prefixfree', gavern_file_uri('js/prefixfree.js'));
	} 
	?>
	
	<?php gk_head_style_css(); ?>
	<?php gk_head_style_pages(); ?>
	
	<?php gk_thickbox_load(); ?>
	<?php wp_head(); ?>
	
	<?php do_action('gavernwp_fonts'); ?>
	<?php gk_head_config(); ?>
	<?php wp_enqueue_script("jquery"); ?>
	
	<?php
	    wp_enqueue_script('gavern-scripts', gavern_file_uri('js/gk.scripts.js'), array('jquery'), false, true);
	    wp_enqueue_script('gavern-menu', gavern_file_uri('js/gk.menu.js'), array('jquery', 'gavern-scripts'), false, true);
	    wp_enqueue_script('gavern-modernizr', gavern_file_uri('js/modernizr.js'), false, false, true);
	    wp_enqueue_script('gavern-scrollreveal', gavern_file_uri('js/scrollreveal.js'), false, false, true);
	?>
	
	<?php do_action('gavernwp_head'); ?>

	<?php
		if (is_page_template( 'template.contact.php' ) && 
			get_option($gk_tpl->name . '_recaptcha_state', 'N') == 'Y' && 
			get_option($gk_tpl->name . '_recaptcha_public_key', '') != '' &&
			get_option($gk_tpl->name . '_recaptcha_private_key', '') != ''
		) {
			wp_enqueue_script( 'gk-captcha-script', 'https://www.google.com/recaptcha/api.js', array( 'jquery' ), false, false);
		}
	?>
	
	<?php 
		echo stripslashes(
			htmlspecialchars_decode(
				str_replace( '&#039;', "'", get_option($gk_tpl->name . '_head_code', ''))
			)
		); 
	?>
</head>
<body <?php do_action('gavernwp_body_attributes'); ?>>
	<div id="gk-bg">
		<header id="gk-head" <?php if(!gk_show_breadcrumbs()) : ?>class="no-breadcrumb"<?php endif; ?>>
			<div id="gk-header-top">
				<div class="gk-page">
					<div id="gk-top-menu">
						<?php gavern_menu('topmenu', 'gk-top-menu'); ?>
					</div>
					<?php if ( isset( $woocommerce )) : ?> 
						<?php if(get_option($gk_tpl->name . '_woocommerce_cart', 'Y') == 'Y') : ?>
						<div id="btn-cart">
							<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', GKTPLNAME); ?>">
								<?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, GKTPLNAME), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?>
							</a>
							<i class="gk-icon-cart-add"></i>
						</div>
						<?php get_template_part( 'layouts/cart' ); ?>
						<?php endif; ?>
					<?php endif; ?>	
					<?php if(get_option($gk_tpl->name . '_search_form', 'Y') == 'Y') : ?>
					<i class="gk-icon-search" id="gk-search-btn"></i>	
					<?php endif; ?>		
				</div>
			</div>
			<div id="gk-header-nav">
				<div class="gk-page">
					<?php if(get_option($gk_tpl->name . "_branding_logo_type", 'css') != 'none') : ?>
						<a href="<?php echo home_url(); ?>" class="<?php echo get_option($gk_tpl->name . "_branding_logo_type", 'css'); ?>Logo"><?php gk_blog_logo(); ?></a>
					<?php endif; ?>
					
					<?php if(gk_show_menu('mainmenu')) : ?>
						<?php gavern_menu('mainmenu', 'main-menu-mobile', array('walker' => new GKMenuWalkerMobile(), 'items_wrap' => '<i class="fa fa-bars"></i><select onchange="window.location.href=this.value;"><option value="#">'.__('Select a page', GKTPLNAME).'</option>%3$s</select>', 'container' => 'div')); ?>
					<?php endif; ?>
					
					<div id ="gk-main-menu" <?php if(get_option($gk_tpl->name . '_menu_type', 'overlay') == 'overlay') : ?> class="gk-menu-overlay" <?php endif; ?>>
						<nav class="gk-menu-wrap">
						<?php if(gk_show_menu('mainmenu')) : ?>
							<?php gavern_menu('mainmenu', 'gk-main-menu', array('walker' => new GKMenuWalker())); ?>
						<?php endif; ?>
						</nav>
					</div>
					<?php if(get_option($gk_tpl->name . '_search_form', 'Y') == 'Y') : ?>
					<div id="gk-search">
						<?php get_template_part( 'searchform' ); ?>
					</div>
					<?php endif; ?>
				</div>
			</div>
			
			<?php if(gk_show_breadcrumbs()) : ?>
			<div id="gk-breadcrumb-area">
				<div class="gk-page">
				<?php include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); ?>
				<?php if( is_plugin_active('woocommerce/woocommerce.php') && is_woocommerce()) : ?>
					<?php gavern_woocommerce_breadcrumb(); ?>
				<?php else : ?>
					<?php gk_breadcrumbs_output(); ?>
				<?php endif; ?>
				</div>
			</div>
			<?php endif; ?>
			
			<?php if(gk_is_active_sidebar('header')) : ?>
			<div id="gk-header-mod">
				<?php gk_dynamic_sidebar('header'); ?>
			</div>
			<?php endif; ?>
		</header>