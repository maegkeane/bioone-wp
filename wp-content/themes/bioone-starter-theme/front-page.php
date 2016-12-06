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
    <?php   
    $the_query = new WP_Query(array( // Define query
      'post_type' => 'news',
      'posts_per_page' => 3,
      'orderby' => 'date'
    ));
    
    if ( $the_query->have_posts() ) {
      echo '<div class="card-container">';
        while ( $the_query->have_posts() ) {
          $the_query->the_post();

          // IAN'S NOTE:
          //    Here's how my thought process works. "Okay, I know I can get a post's
          //    categories using wp_get_post_categories. But what's inside that array?
          //    Let me print_r() it onto the page so I can see."
          // Uncomment the three lines below to see what wp_get_post_categories returns
          // echo '<pre>';
          // print_r(wp_get_post_categories($post->ID));
          // echo '</pre>';

          // IAN'S NOTE:
          //    "Oh, It contains an array with a single item in it that's a number. That's
          //    probably the post category's ID. Let's use get_category() to see what information
          //    I can get about the category – maybe I can retrieve the name and a code-friendly
          //    string to use as a CSS class."
          // Here I get the post category by passing wp_get_post_categories the current post's ID.
          // The $post->ID bit is a little WordPress trick. If you're within a post loop, you can
          // always use it to get the post's ID.
          $postCategoryID = wp_get_post_categories($post->ID)[0];
          $theCategoryObject = get_category($postCategoryID);
          // Uncomment the three lines below to see what get_category() returns
          // echo '<pre style="text-align: left;">';
          // print_r($theCategoryObject);
          // echo '</pre>';

          // IAN'S NOTE:
          //    "Cool, I can get a readable category name and a code-friendly category name from
          //    get_category(). I'll pass those to variables so I can echo them into code later."
          //    
          //    "BUT WAIT. get_category() looked like an array, but it was wrapped in parentheses
          //    instead of square brackets. That means it's an Object."
          //    
          //    An object is like an array in that it contains a lot of data, but it's strict about what 
          //    form it takes. Usually objects are used in code when they will ALWAYS return a set number 
          //    of pre-defined items. For example, categories in WordPress ALWAYS have the exact 
          //    attributes listed in the object printed, only their value will change.
          //
          //    "Okay, so since it's an Object, I can't use bracket['notaton'] to get data out of it.
          //    Instead I have to use arrow->notation."
          // Uncomment the echos below to see what these return. Note it'll all be on one, big
          // ugly line. You can use $categoryName and $categorySlug in your code.
          $categoryName = $theCategoryObject->name;
          // echo $categoryName;
          $categorySlug = $theCategoryObject->slug;
          // echo $categorySlug;

          // echo 
          //   '<a class="card ' . wp_get_post_categories() . ' " ' . if (wp_get_post_categories() == ['annual_report']) { . 'style="background-image: url(' . get_field('annual_report_bg_image')['url'] . ' )"; ' . } . ' href=" ' . get_the_permalink() . ' " target="_blank">             
          //     <div class="outline">
          //       <h3>' . get_field('bioone_news') . '</h3>
          //       <h2>' . get_the_title() . '</h2>' . if (wp_get_post_categories() == ['bioone_news']) { . '<img src="' . get_field('issue_icon')['url'] . '" alt="' . get_field('issue_icon')['alt'] . ' "/> ' . }) . '
          //       <p>' . get_field('pdf_note') . '</p>
          //    </div>
          //   </a>';
        }
      echo '</div>';

      wp_reset_postdata(); // Restore original post data to prevent unintended functionality
    } else {
      // no posts found
    }
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
    <br />
    <?php 
      $the_query = new WP_Query(array( // Define query
        'post_type' => 'conferences',
        'posts_per_page' => 200, // For conferences, you don't want them to only get 3, you are looking at all of them (say, 200)
        'orderby' => 'date'
      ));
      
      $conferenceCalendarArray = array(); // Overall grid of conferences

      if ( $the_query->have_posts() ) {
        while ( $the_query->have_posts() ) {
          $the_query->the_post();

          // For this example we have a lot of information we want to group together
          // for each post, so into the array we pass another array.
          // So each value in the array is another array with more values.
          $conferenceArray = array(       
            'event_name' => get_the_title(),
            'display_date' => get_field('display_date'), 
            'location' => get_field('location'),
            'attendees' => get_field('attendees'),
            'booth' => get_field('booth'),
            'order_date' => get_field('order_date')
          );
          
            // array_push adds an item to the end of an existing array
            array_push($conferenceCalendarArray, $conferenceArray);
          }

        wp_reset_postdata(); // Restore original post data to prevent unintended functionality
          
        } else {
            // No posts found
        }

      function date_compare($a, $b)
      {
        $t1 = strtotime($a['order_date']);
        $t2 = strtotime($b['order_date']);
        return $t1 - $t2;
      }    

      usort($conferenceCalendarArray, 'date_compare');

      echo '<div class="card-container">';
      //This is where we are actually putting things on the page; type $i<count(2), so only 3 appear
      for ($i=0; $i<3; $i++) { // Do another loop to get stuff out of the array
        echo 
          '<a class="card_calendar">
            <h3>' . $conferenceCalendarArray[$i]['display_date'] . '</h3>
            <h2>' . $conferenceCalendarArray[$i]['event_name'] . '</h2>
            <p>' . $conferenceCalendarArray[$i]['location'] . '</p>
            <div class="card_calendar_expand">
              <p class="who">' .
                $conferenceCalendarArray[$i]['attendees'] .
              '</p>' .
              //if (get_sub_field('booth')) : . '<p class="where">' $conferenceCalendarArray[$i]['booth'] . '</br>   
            '</div>
          </a>';
      }
      echo '</div>';
    ?>
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