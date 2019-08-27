<?php
/* Template Name: Homepage */
?>

<?php get_header(); ?>

<div class="container">
  <div class="row">
    <div class="col-12 col-lg-9 left-side">
      <?php 
        global $post,$firstPosts;
        $loop = new WP_Query( 
          array( 
            'post_type' => 'post', 
            'cat' => '-1',
            'posts_per_page' => 3, 
            'order' => 'desc', 
            'orderby' => 'date',
            'meta_key' => 'obrzekslideru_26971',
            'meta_query' => array(
              'relation' => 'AND',
              array(
                'key' => 'obrzekslideru_26971',
                'compare' => 'EXISTS',
              ),
              array(
                'key' => 'obrzekslideru_26971',
                'value' => array(''),
                'compare' => 'NOT IN',
              ),
            ),
          ) 
        ); 
        $tab = 1;
      ?>

      <div id="news_slider" class="row mb-4">

          <ul class="nav nav-tabs col" role="navigation">
            
            <?php while ( $loop->have_posts() ) : $loop->the_post();
                  $firstPosts[] = $post->ID; ?>
              <li class="nav-item<?php if ($tab != 3) { echo " mb-1"; } ?>">
                <div href="#<?php echo $tab; ?>" class="text-white bg-secondary nav-link<?php if ($tab == 1) { echo " active"; } ?>" data-toggle="tab" role="tab" aria-controls="<?php echo $tab; ?>">
                  <h3><?php the_title(); ?></h3>
                  <span><?php slider_excerpt(); ?></span>
                  <a href="<?php echo get_permalink(); ?>" class="d-block text-white link-more nodecoration transition" onclick="window.location.replace('<?php echo get_permalink(); ?>')"><?php _e('Číst dále'); ?></a>
                </div>
              </li>
            <?php 
              $tab++;
              endwhile; 
            ?>

          </ul>

        <div class="tab-content col">
          <?php $tab = 1; ?>
          <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
            <?php $cover = get_post_meta($post->ID, "obrzekslideru_26971", true); ?>
            <div class="tab-pane h-100 fade show<?php if ($tab == 1) { echo " active"; } ?>" id="<?php echo $tab; ?>" onclick="location.href='<?php echo get_permalink(); ?>';" role="tabpanel" style="background-image:url('<?php echo $cover; ?>');">
            </div>
          <?php 
            $tab++;
            endwhile; 
          ?>
        </div>
      </div>
      <script>
        jQuery(document).ready(function () {
          var timeInterval, tabCount = 0, currnetIndex = 1;
          tabCount = jQuery('.nav-tabs').find('li div').length;
          var tabContentObj = jQuery('.tab-content .tab-pane');
          changeTabIndex();
          timeInterval = setInterval(function () { changeTabIndex(); }, 4 * 1000);

          function changeTabIndex() {
            if (currnetIndex > tabCount) {
              currnetIndex = 1;
            }
            tabContentObj.hide();
            jQuery('.nav-tabs').find('div.active').removeClass('active');
            var currentAncorObj = jQuery('.nav-tabs').find('li div').eq(currnetIndex - 1);
            currentAncorObj.addClass('active');
            jQuery(currentAncorObj.attr('href')).show();
            currnetIndex++;
          };

          jQuery('.nav-tabs li div').mouseenter(function () {
            clearInterval(timeInterval);
          }).mouseleave(function () {
            timeInterval = setInterval(function () { changeTabIndex(); }, 4 * 1000);
          });
          jQuery('.nav-tabs li div').click(function () {
            tabContentObj.hide();
            jQuery('.nav-tabs').find('div.active').removeClass('active');
            var currentAncorObj = jQuery(this);
            currnetIndex = jQuery('.nav-tabs').find('li div').index(jQuery(this)) + 1;
            currentAncorObj.addClass('active');
            jQuery(currentAncorObj.attr('href')).show();
            currnetIndex++;
          });
            
        });
      </script>

      <div class="row mb-4" id="banner-inside">
        <div class="col-12 text-center">
          <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("banner-leaderboard") ) : ?>
            <?php dynamic_sidebar("banner-leaderboard"); ?>
          <?php endif;?>
        </div>
      </div>

      <div class="row d-lg-none mb-5">
        
      <?php 
      $popularpost = new WP_Query( 
        array( 
          'post_type' => 'post',
          'posts_per_page' => 3, 
          'order' => 'desc', 
          'cat' => '-1',
          'tax_query' => array( array(
            'taxonomy' => 'post_format',
            'field' => 'slug',
            'terms' => 'post-format-video',
            'operator' => 'IN'
           ) ),
          'orderby' => 'meta_value_num',
          'meta_key' => 'wpb_post_views_count',
        )     
      ); 
    ?>

    <div class="col-12 mt-5 d-none d-md-block mt-lg-0">
      <h2 class="line"><?php _e('Nejsledovanější videa', 'oneindustry'); ?></h2>
    </div>

    <?php while ( $popularpost->have_posts() ) : $popularpost->the_post(); ?>
          
      <div id="post-<?php the_ID(); ?>" <?php post_class( 'col-12 col-md-4 d-none d-md-block col-lg-12 mt-3' ); ?>>
        <a href="<?php echo get_permalink(); ?>" title="<?php the_title(); ?>">
          <?php 
						if ( has_post_thumbnail() ) {
              the_post_thumbnail( 'thumbnail' );
            } 
            else { 
              echo '<img src="' . get_bloginfo('stylesheet_directory') . '/images/noimage.jpg" />';
            }
					?>
        </a>
      </div>

    <?php endwhile; ?>

      </div>


      <?php
        wp_nav_menu( array(
          'menu' => 'Homepage',
          'theme_location'  => 'inside',
          'container'       => 'div',
          'menu_id'         => false,
          'menu_class'      => 'row mb-5 pt-3 pl-0',
          'depth'           => 1
        ));
      ?>

      <div class="row post-grid grid-icon">

        <?php 
          $loop = new WP_Query( 
            array( 
              'post_type' => 'post',
              'posts_per_page' => 9, 
              'order' => 'desc', 
              'orderby' => 'date',
              'post__not_in' => $firstPosts,
              'cat' => '-1'
            ) 
          ); 
        ?>

        <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
        
          <div id="post-<?php the_ID(); ?>" <?php post_class( 'col-12 col-sm-6 col-md-4 mb-3 mt-0' ); ?>>
            <div class="item bg-light">
              <div class="post-thumbnail p-relative">
                <a href="<?php echo get_permalink(); ?>" title="<?php the_title(); ?>" class="no-decoration">
                  <?php 
                    if (has_post_format('video')) {
                      if ( has_post_thumbnail() ) {
                        the_post_thumbnail( 'thumbnail' );
                      } 
                      else { 
                        echo '<img src="' . get_bloginfo('stylesheet_directory') . '/images/noimage.jpg" />';
                      }
                    }
                    else {
                      global $post;
                      $compare_date = strtotime( "2018-08-23" );
                      $post_date    = strtotime( $post->post_date );
                    
                      if ( $compare_date < $post_date ) {
                        if (get_post_meta($post->ID, 'nahledovyobrazek', true) != "") { 
                          echo '<img src="' . get_post_meta($post->ID, 'nahledovyobrazek', true) . '">';
                        }
                        else {
                          echo '<img src="' . get_bloginfo('stylesheet_directory') . '/images/noimage.jpg" />';
                        }
                      } 
                      else {
                        if ( has_post_thumbnail() ) {
                          the_post_thumbnail( 'thumbnail' );
                        } 
                        else { 
                          echo '<img src="' . get_bloginfo('stylesheet_directory') . '/images/noimage.jpg" />';
                        }
                      } 
                    }
									?>
                </a>
              </div>
              <div class="post-meta p-3">
                <a href="<?php echo get_permalink(); ?>" title="<?php the_title(); ?>" class="no-decoration">
                  <h3 class="mb-0 font-weight-normal c-dark ch-dark"><?php the_title(); ?></h3>
                </a>
                <div class="post-tags">
                  <?php the_terms( $post->ID, 'tag', '', '' ); ?>
                </div>
              </div>
            </div>
          </div>

        <?php endwhile; ?>
    
      </div>
    </div>
    
    <div class="col-12 col-lg-3 rightside">
      <?php get_sidebar(); ?>
    </div>

  </div>

  <div class="row mt-5 mb-5">
    <div class="col-12">
      <h2 class="line"><?php _e('Kalendář', 'oneindustry'); ?></h2>
    </div>
  </div>
    
  <div class="over-calendar">
    <div id="calendar" class="align-items-center text-center slick">
      <?php
        $today = date("Ymd");
        $loop = new WP_Query(
          array(
            'post_type' => __('kalendar', 'oneindustry'),
            'posts_per_page' => 4,
            'orderby' => 'startdate',
            'order' => 'ASC',
            'meta_query' => array(
              array(
                'key' => 'altexpiry',
                'value' => $today,
                'compare' => '>=',
              )
            )
          )
        );
        $number = 1;
      ?>

      <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

          <div id="post-<?php the_ID(); ?>" <?php post_class( '' ); ?>>
            <div class="circle d-flex">
              <a href="<?php echo get_post_meta($post->ID, "urlpspvku_23425", true); ?>" title="<?php the_title(); ?>" class="align-self-center no-decoration">
                <h3 class="mb-0">
                  <?php
                    if ( '' != get_post_meta( get_the_ID(), 'altexpiry', true ) ) {
                      $startday = get_post_meta( get_the_ID(), 'start_day', true );
                      $startdate = get_post_meta( get_the_ID(), 'start_date', true );
                      $end = get_post_meta( get_the_ID(), 'end', true );
                      if ($startdate != $end) {
                        echo $startday . "-" . $end . "<br>";
                      }
                      else {
                        echo $startdate . "<br>";
                      }
                    }
                  ?>
                  <?php the_title(); ?>
                </h3>
              </a>
            </div>
          </div>

          <?php if ($number === 2) { ?>
            <div class="no-before">
              <div class="circle m-auto">
                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("banner-square") ) : ?>
                  <?php dynamic_sidebar("banner-square"); ?>
                <?php endif;?>
              </div>
            </div>
          <?php } ?>
        <?php
          $number++;
          endwhile;
        ?>

    </div>
  </div>
</div>

<script>
        jQuery('.slick').slick({
  dots: false,
  infinite: false,
  speed: 300,
  slidesToShow: 5,
  slidesToScroll: 5,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: false,
        dots: false
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 380,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});
</script>

<?php get_footer(); ?>