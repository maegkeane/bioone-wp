<?php 
/*
  Template Name: Elementa Documents Page 
*/
?> 


<?php get_header(); ?>

<div class="content">

  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  	
    <header>		
  	    <h1><?php the_title(); ?></h1>
    </header>

    <?php the_content(); ?>

  <?php endwhile; endif; ?>
 
</div>

<?php get_footer(); ?>