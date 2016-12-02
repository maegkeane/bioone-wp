<?php get_header('homepage'); ?>

<article>
  <section>
    
    <?php the_field('opening_paragraphs'); ?>
    
    <a class="btn-main" href="publications.html">More About Our Products</a>
  </section>
  <hr>
  <section>
    <h1>Stay Current</h1>
    <h2>Top Stories</h2>
    <!--<h2><?php the_field('news_title'); ?></h2>-->
    <!--<div class="card-container">-->

    <?php 
      $the_query = new WP_Query(array(
        'post_type' => 'news',
        'posts_per_page' => 3,
      ));

    if ($the_query->have_posts() ) {
      echo '<div class="card-container">';
    
    while ( $the_query->have_posts() ) {
      $the_query->the_post();
      echo '<h1><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h1>';
    }
      
      echo '</div>';
    
      wp_reset_postdata(); // Restore original post data to prevent unintended functionality
    
    } else {
    // no posts found
      }
  //
  //  END WP QUERY
  //
  ?>



    <!--THIS IS THE OLD CODE FOR THE NEWS-->
    <!--<?php if (have_rows('news_grid') ) : while (have_rows ('news_grid') ) : the_row(); 
    
      $news_type = get_sub_field('news_type');
      $news_type_code = strtolower(str_replace(' ', '_', $news_type)); 
      $news_item_name = get_sub_field('news_item_name');
      $link = get_sub_field('link');
      $report_bg = get_sub_field('report_bg');
      $issue_icon = get_sub_field('issue_icon');
      $pdf_note = get_sub_field('pdf_note');
    
    ?>
    
    <a class="card <?php echo $news_type_code; ?>"
      
      <?php   
        if (get_sub_field('report_bg') && $news_type_code === 'annual_report') {
        ?> 
        style="background-image: url(<?php echo $report_bg['url']; ?>);"
      <?php  
        }       
      ?>
      
      href="<?php echo $link; ?>" target="_blank">  
      
      <?php if ($news_type_code === 'annual_report') { ?>
      
        <div class="outline">
      
      <?php } ?>
      
      <h3><?php echo $news_type; ?></h3>
      <h2><?php echo strip_tags($news_item_name); ?></h2>
      
      <?php if (get_sub_field('issue_icon')) : ?>
      
      <img src="<?php echo $issue_icon['url']; ?>" alt="<?php echo $issue_icon['alt']; ?>" />
      
      <?php endif; ?> 
      
      <p class="card_PDF"><?php echo $pdf_note; ?></p>
      
      <?php if ($news_type_code === 'annual_report') { ?>
      
        </div>
      
      <?php } ?>
    
    </a>
    
    <?php endwhile; endif; wp_reset_postdata(); ?>
    
    </div>
  -->

  </section>
  <section>
    <h2>Upcoming Conferences</h2>

    <?php 
      $the_query = new WP_Query(array( // Define query
        'post_type' => 'conferences',
        'posts_per_page' => 200, // for conferences, you don't want them to only get 3, you are looking at all of them (say, 200)
        'orderby' => 'date'
      ));
      
      $conferenceCalendarArray = array(); //overall grid of conferences

      if ( $the_query->have_posts() ) {
        while ( $the_query->have_posts() ) {
          $the_query->the_post();

          // For this example we have a lot of information we want to group together
          // for each post, so into the array we pass another array.
          // So each value in the array is another array with more values.
          $conferenceArray = array(       
            'conference_name' => get_the_title(),
            'display_date' => get_sub_field('display_date'),
            'location' => get_sub_field('location'),
            'attendees' => get_sub_field('attendees'),
            'booth' => get_sub_field('booth'),
            'order_date' => get_sub_field('order_date'),
          );
      // array_push adds an item to the end of an existing array
            array_push($conferenceCalendarArray, $conferenceArray);
          }
          wp_reset_postdata(); // Restore original post data to prevent unintended functionality
        } else {
          // no posts found
      }

      function date_compare($a, $b)
      {
        $t1 = strtotime($a['order_date']);
        $t2 = strtotime($b['order_date']);
        return $t1 - $t2;
      }    

      usort($conferenceCalendarArray, 'date_compare');
    
      echo '<div class="card_container">';
      //this is where we are actually putting things on the page, do $i<count(2); so only three appear
      for ($i=0; $i<3; $i++) { // Do another loop to get stuff out of the array
        echo 
          '<a class="card_calendar">' .
            $conferenceCalendarArray[$i]['conference_name'] .
            '<h3>' $date; '</h3>' .
            '<h2>' $event_name; '</h2>' .
            '<p>'  $location; '</p>' .
            '<div class="card_calendar_expand">' . 
              '<p class="who">Who youll see there: </br>' .
               $attendees; '</p>' .
              if (get_sub_field('booth')) :   
              '<p class="where">' $booth; '</br>' .
            '</div>' .
          '</a>';
        }
      echo '</div>';
    ?>

    <!--THIS IS THE OLD CODE FOR THE CONFERENCES  
    <?php if( have_rows( 'calendar_grid' ) ) : while ( have_rows( 'calendar_grid' ) ) : the_row(); 

      $date= get_sub_field('date');
      $event_name = get_sub_field('event_name');
      $location = get_sub_field('location');
      $link = get_sub_field('link');
      $booth = get_sub_field('booth');
      $attendees = get_sub_field('attendees')

    ?>

    <a class="card_calendar">  
      <h3><?php echo $date; ?></h3>
      <h2><?php echo $event_name; ?></h2>
      <p><?php echo $location; ?></p>
      <div class="card_calendar_expand">
        <p class="who">Who you'll see there: </br>
        <?php echo $attendees; ?></p>
        <?php if (get_sub_field('booth')) : ?>  
          <p class="where"><?php echo $booth; ?></br>
        <?php endif; ?>
      </div>
    </a>

    <?php endwhile; endif; wp_reset_postdata(); ?>-->

    </div>
    <a class="btn-main" href="news-events.html#calendar">Full Calendar</a>  
  </section>
  <section>
  <hr>
    <div class="light-purple-bg">
      <h2>Stay Up to Date</h2>
        <p>Everyone has a full inbox. That's why we only send you essential updates and a seasonal newsletter to keep you up to speed.</p>
  <!-- Begin MailChimp Signup Form -->
        <div id="mc_embed_signup">
          <form action="//bioone.us3.list-manage.com/subscribe/post?u=c96bf0ec63cc75c323952cced&amp;id=13cf7c0c45" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
            <div id="mc_embed_signup_scroll">
            <div class="sign-up-list">
              <div class="sign-up-col1">
              I am a
              </div>
              <div class="sign-up-col2">
                <ul>
                  <li><input type="radio" value="16384" name="group[11821]" id="mce-group[11821]-11821-0"><label for="mce-group[11821]-11821-0">Researcher</label></li>
                  <li><input type="radio" value="32768" name="group[11821]" id="mce-group[11821]-11821-1"><label for="mce-group[11821]-11821-1">Librarian</label></li>
                </ul>
              </div>
              <div class="sign-up-col3">
                <ul>  
                  <li><input type="radio" value="65536" name="group[11821]" id="mce-group[11821]-11821-2"><label for="mce-group[11821]-11821-2">Publisher</label></li>
                  <li><input type="radio" value="131072" name="group[11821]" id="mce-group[11821]-11821-4"><label for="mce-group[11821]-11821-4">Other</label></li>
                </ul>
              </div>
            </div>
            <div class="mc-field-group" style="display: inline">
              <label for="mce-EMAIL">and my email address is</label><br />
              <input type="email" placeholder="Enter your email" name="EMAIL" class="required email" id="mce-EMAIL">
            </div>
  <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
              <div style="position: absolute; left: -5000px;" aria-hidden="true">
                <input type="text" name="b_c96bf0ec63cc75c323952cced_13cf7c0c45" tabindex="-1" value="">
              </div>
                <input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="btn-main">
              </div>
          </form>
        </div>
  <!--End mc_embed_signup-->
    </div>  
  </section>
  <section> 
    <h1>From the Community</h1>

    <div class="cycle-slideshow" 
      data-cycle-fx=scrollHorz
      data-cycle-timeout=0
      data-cycle-slides="> blockquote"
      > 
      <div class="cycle-pager"></div>
      
      <?php if( have_rows( 'testimonials' ) ) : while ( have_rows( 'testimonials' ) ) : the_row(); 
      
        $blockquote = get_sub_field('blockquote');
        $name = get_sub_field('name');
        $title = get_sub_field('title');
        $institution = get_sub_field('institution');
      
      ?>
      
        <blockquote>       
          <?php echo strip_tags($blockquote); ?>
          <p class="blockquote-source">– <?php echo $name; ?> <br /><?php echo $title; ?>, <?php echo $institution; ?></p>
        </blockquote>
      
      <?php endwhile; endif; wp_reset_postdata(); ?>

    </div>
  </section>
</article>

<?php get_footer(); ?>