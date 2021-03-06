<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
	
	<head>
		<meta charset="<?php bloginfo('charset'); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title><?php wp_title(' | ', true, 'right'); ?></title>
		
	
		<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />

    <link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo('template_url'); ?>/favicon.ico" />    
    
    <script src="https://use.typekit.net/rrt7llx.js"></script>
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
  
  <?php 
  
    $homepage_bgArray = get_field('homepage_random');

    shuffle($homepage_bgArray);
  ?>

  <header class="page-header_homepage" style="background-image: url('<?php echo $homepage_bgArray[0]['homepage_bg']['url']; ?>');"></div>
    <div class="page-header-container">
      <a href="<?php bloginfo('url'); ?>">
	      <picture class="header-logo">
	        <source 
	          media="(min-width: 741px)"
	          srcset="<?php bloginfo('template_url'); ?>/img/logos/rgb_B1_Logo_white_text.svg">
	        <source  
	          media="(max-width: 740px)"
	          srcset="<?php bloginfo('template_url'); ?>/img/logos/rgb_B1_Logo_white_text.svg">
	        <img 
            class="header-logo"
	          src="<?php bloginfo('template_url');?>/img/logos/rgb_B1_Logo_white_text.svg"
	          alt="BioOne Logo">
	      </picture>
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
    <div class="hero-text-container">
      <div class="hero-header">BioOne is a nonprofit publisher committed to making scientific research more accessible
      </div>
      <div class="hero-subheader">We curate research content and support discourse while exploring new models in scientific publishing 
      </div>
    </div>
		
	</header> <!-- header#page-header -->