<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
	
	<head>
		<meta charset="<?php bloginfo('charset'); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title><?php wp_title(' | ', true, 'right'); ?></title>
		
	
		<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />

    <script src="https://use.typekit.net/gmo5uyg.js"></script>
    <script>try{Typekit.load({ async: true });}catch(e){}</script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/vendor/modernizr-2.6.2.min.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/vendor/conditionizr.min.js"></script>
		<?php wp_head(); ?>
	</head>
	
	<body <?php
	global $post;
	$slug = get_post( $post )->post_name;
	body_class($slug);
	?>>
		
  <header class="page-header">
    <div class="page-header-container">
      <a href="<?php bloginfo('url'); ?>">
      	<img src="<?php bloginfo('template_url'); ?>/img/logos/b1-logo.svg" alt="BioOne Logo" />
      </a>
      
      <nav>
        <a class="handle">
          <span>Menu</span>
        </a>
        
        <?php 

          $defaults = array (
            'container' => false,
            'theme_location' => 'main-menu'
          );

          wp_nav_menu ($defaults); 

        ?>
      </nav>
    </div>
  </header>
		
			</header> <!-- header#page-header -->