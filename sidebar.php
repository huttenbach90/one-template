<aside class="row">

  <?php if (is_home() || is_front_page()) : ?>
    
    <div id="banner-sidebar-1" class="banner-sidebar col-12 d-none d-lg-block mt-0 mb-5">
      <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("banner-medium-rectangle") ) : ?>
        <?php dynamic_sidebar("banner-medium-rectangle"); ?>
      <?php endif;?>
    </div>

    <?php 
      $popularpost = new WP_Query( 
        array( 
          'post_type' => 'post',
          'posts_per_page' => 3, 
          'order' => 'desc', 
          'orderby' => 'meta_value_num',
          'meta_key' => 'wpb_post_views_count',
          'tax_query' => array( array(
            'taxonomy' => 'post_format',
            'field' => 'slug',
            'terms' => 'post-format-video',
            'operator' => 'IN'
           ) )
        )     
      ); 
    ?>

    <div class="col-12 mt-5 d-none d-lg-block mt-lg-0">
      <h2 class="line"><?php _e('Nejsledovanější videa', 'oneindustry'); ?></h2>
    </div>

    <?php while ( $popularpost->have_posts() ) : $popularpost->the_post(); ?>
          
      <div id="post-<?php the_ID(); ?>" <?php post_class( 'col-12 col-md-4 d-none d-lg-block col-lg-12 mt-3' ); ?>>
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

    <div id="banner-sidebar-2" class="banner-sidebar col-12 mt-3 d-none d-lg-block">
      <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("banner-wide-scycraper") ) : ?>
        <?php dynamic_sidebar("banner-wide-scrycraper"); ?>
      <?php endif;?>
      <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("banner-scycraper") ) : ?>
        <?php dynamic_sidebar("banner-scycraper"); ?>
      <?php endif;?>
    </div>

  <?php elseif (is_archive() || is_search()) : ?>

    <div id="banner-sidebar-1" class="banner-sidebar col-12 d-none d-lg-block mt-3 mb-5">
      <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("banner-medium-rectangle") ) : ?>
        <?php dynamic_sidebar("banner-medium-rectangle"); ?>
      <?php endif;?>
    </div>

    <div class="col-12<?php if (is_search()) : ?> mt-4<?php endif; ?>">
      <h2 class="line"><?php _e('Nejčtenější články', 'oneindustry'); ?></h2>
    </div>

    <?php 
      $popularpost = new WP_Query( 
        array( 
          'post_type' => array( 'post' ),
          'posts_per_page' => 3, 
          'order' => 'desc', 
          'orderby' => 'meta_value_num',
          'meta_key' => 'wpb_post_views_count',
        )     
      ); 
    ?>

    <?php while ( $popularpost->have_posts() ) : $popularpost->the_post(); ?>
          
      <div id="post-<?php the_ID(); ?>" <?php post_class( 'col-12 mt-3' ); ?>>
        <div class="post-meta">
          <a href="<?php echo get_permalink(); ?>" title="<?php the_title(); ?>" class="c-dark ch-primary transition nodecoration">
            <h3><?php the_title(); ?></h3>
          </a>
          <div class="post-excerpt">
            <?php news_excerpt(); ?>
          </div>
          <a href="<?php echo get_permalink(); ?>" class="d-block c-primary ch-primary link-more mt-3 nodecoration"><?php _e('Číst dále'); ?></a>
        </div>
      </div>

    <?php endwhile; ?>

    <div id="banner-sidebar-2" class="banner-sidebar col-12 mt-3 d-none d-lg-block">
      <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("banner-wide-scycraper") ) : ?>
        <?php dynamic_sidebar("banner-wide-scrycraper"); ?>
      <?php endif;?>
      <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("banner-scycraper") ) : ?>
        <?php dynamic_sidebar("banner-scycraper"); ?>
      <?php endif;?>
    </div>

  <?php elseif (is_single()) : ?>

    <div id="banner-sidebar-1" class="banner-sidebar col-12 d-none d-lg-block mt-5 mb-4">
      <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("banner-medium-rectangle") ) : ?>
        <?php dynamic_sidebar("banner-medium-rectangle"); ?>
      <?php endif;?>
    </div>

    <?php 
      $custom_taxterms = wp_get_object_terms( $post->ID, 'tag', array('fields' => 'ids') );
      $post_type = get_post_type();
      $args = array(
        'post_type' => $post_type,
        'post_status' => 'publish',
        'posts_per_page' => 3,
        'orderby' => 'rand',
        'tax_query' => array(
            array(
                'taxonomy' => 'tag',
                'field' => 'id',
                'terms' => $custom_taxterms
            )
        ),
        'post__not_in' => array ($post->ID),
      );
      $related_items = new WP_Query( $args );
      if ($related_items->have_posts()) : ?>
        <div class="col-12 mt-5">
          <h2 class="line"><?php _e('Doporučené v kategorii', 'oneindustry'); ?></h2>
        </div>
      <?php 
        while ( $related_items->have_posts() ) : $related_items->the_post();
      ?>
        <div class="col-12 mt-3 mb-3 grid-icon">
          <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
              <div class="item bg-secondary">
                <div class="post-thumbnail p-relative">
                  <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="no-decoration">
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
                  <a href="<?php echo get_permalink(); ?>" title="<?php the_title(); ?>" class="text-white">
                    <h3 class="mb-0"><?php the_title(); ?></h3>
                  </a>
                  <div class="post-tags">
                    <?php the_terms( $post->ID, 'tag', '', '' ); ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
      <?php
        endwhile;
        endif;
      
      wp_reset_postdata();
    ?>

    <div id="banner-sidebar-2" class="banner-sidebar col-12 mt-3 d-none d-lg-block">
      <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("banner-wide-scycraper") ) : ?>
        <?php dynamic_sidebar("banner-wide-scrycraper"); ?>
      <?php endif;?>
      <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("banner-scycraper") ) : ?>
        <?php dynamic_sidebar("banner-scycraper"); ?>
      <?php endif;?>
    </div>

  <?php else : ?>

  <?php endif; ?>

</aside>