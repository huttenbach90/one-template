<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
  <title><?php if(is_home()) { echo bloginfo("name"); echo " | "; echo bloginfo("description"); } else { echo wp_title(" | ", false, "right"); echo bloginfo("name"); } ?></title>
    <meta property="og:title" content="<?php if(is_home()) { echo bloginfo('name'); echo ' | '; echo bloginfo('description'); } else { echo wp_title(' | ', false, "right"); echo bloginfo('name'); } ?>">
    <meta name="twitter:title" content="<?php if(is_home()) { echo bloginfo('name'); echo ' | '; echo bloginfo('description'); } else { echo wp_title(' | ', false, "right"); echo bloginfo('name'); } ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@<?php echo get_option('twitter_url'); ?>">
    <meta property="og:site_name" content="<?php echo bloginfo('name'); ?>">
    <meta property="og:url" content="<?php echo get_permalink(); ?>">
  <?php if (is_single() || is_page() ) : if (have_posts() ) : while (have_posts() ) : the_post(); ?>
    <meta name="description" content="<?php echo get_the_excerpt();?>">
    <meta property="og:description" content="<?php echo get_the_excerpt(); ?>">
    <meta name="twitter:description" content="<?php echo get_the_excerpt(); ?>">
    <meta property="og:type" content="article">
  <?php endwhile; endif; elseif (is_category() ): ?>
    <?php if (!empty(category_description())) : ?>
      <meta name="description" content="<?php echo strip_tags(category_description()); ?>">
      <meta property="og:description" content="<?php echo strip_tags(category_description()); ?>">
      <meta name="twitter:description" content="<?php echo strip_tags(category_description()); ?>">
    <?php else : ?>
      <meta name="description" content="<?php echo strip_tags(get_option('description_header')); ?>">
      <meta property="og:description" content="<?php echo strip_tags(get_option('description_header')); ?>">
      <meta name="twitter:description" content="<?php echo strip_tags(get_option('description_header')); ?>">
    <?php endif; ?>
  <?php elseif (is_tag()) : ?>
    <?php if (!empty(tag_description())) : ?>
      <meta name="description" content="<?php echo strip_tags(tag_description()); ?>">
      <meta property="og:description" content="<?php echo strip_tags(tag_description()); ?>">
      <meta name="twitter:description" content="<?php echo strip_tags(tag_description()); ?>">
    <?php else : ?>
      <meta name="description" content="<?php echo strip_tags(get_option('description_header')); ?>">
      <meta property="og:description" content="<?php echo strip_tags(get_option('description_header')); ?>">
      <meta name="twitter:description" content="<?php echo strip_tags(get_option('description_header')); ?>">
    <?php endif; ?>
  <?php else : ?>
    <meta name="description" content="<?php echo strip_tags(get_option('description_header')); ?>">
    <meta property="og:description" content="<?php echo strip_tags(get_option('description_header')); ?>">
    <meta name="twitter:description" content="<?php echo strip_tags(get_option('description_header')); ?>">
  <?php endif; ?>
  <?php 
    if (has_post_format('video')) {
      if ( has_post_thumbnail() ) {
        $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
        echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '">';
        echo '<meta name="twitter:image" content="' . esc_attr( $thumbnail_src[0] ) . '">';
      }
      else {
        $default_image = get_bloginfo('stylesheet_directory') . '/images/noimage-og.png';
        echo '<meta property="og:image" content="' . $default_image . '">';
        echo '<meta name="twitter:image" content="' . $default_image . '">';
      }
    }
    else {
      global $post;
      $compare_date = strtotime( "2018-08-23" );
      $post_date    = strtotime( $post->post_date );
                    
      if ( $compare_date < $post_date ) {
        if (get_post_meta($post->ID, 'nahledovyobrazek', true) != "") { 
          $default_image = get_post_meta($post->ID, 'nahledovyobrazek', true);
        }
        else {
          $default_image = get_bloginfo('stylesheet_directory') . '/images/noimage-og.png';
        }
        echo '<meta property="og:image" content="' . $default_image . '">';
        echo '<meta name="twitter:image" content="' . $default_image . '">';
      } 
      else {
        if ( has_post_thumbnail() ) {
          $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
          echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '">';
          echo '<meta name="twitter:image" content="' . esc_attr( $thumbnail_src[0] ) . '">';
        } 
        else { 
          $default_image = get_bloginfo('stylesheet_directory') . '/images/noimage-og.png';
          echo '<meta property="og:image" content="' . $default_image . '">';
          echo '<meta name="twitter:image" content="' . $default_image . '">';
        }
      } 
    }
    ?>

    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js" async></script>
    <![endif]-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <?php wp_head(); ?>

    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

    <?php if (!empty(get_option('codes_gtm'))) : ?>
      <script>
        (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','<?php echo get_option('codes_gtm') ?>');
      </script>
    <?php endif; ?>

  </head>

  <body <?php body_class(isset($class) ? $class : ''); ?>>

    <?php if (!empty(get_option('codes_gtm'))) : ?>
      <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo get_option('codes_gtm') ?>"
        height="0" width="0" style="display:none;visibility:hidden"></iframe>
      </noscript>
    <?php endif; ?>
    
    <div id="banner-top" class="container text-center">
      <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("banner-atyp") ) : ?>
        <?php dynamic_sidebar("banner-atyp"); ?>
      <?php endif;?>
    </div>
    

    <header>
      <div class="container">
        <div class="row align-items-end d-none d-lg-flex mt-3 mb-4">
          <div class="col-6">
              <?php
                the_custom_logo();
              ?>
              <div class="blogname">
                <a href="<?php bloginfo('url'); ?>" class="no-decoration text-dark">
                  <?php bloginfo('name'); ?>
                </a>
              </div>
          </div>
          <div class="col-3 text-right">
            <?php get_search_form(); ?>
          </div>
          <div id="login-out" class="col-3 text-right mb-2">
            <a href="<?php echo network_home_url(); ?>">
              <i class="fa fa-home c-dark ch-primary"></i>
            </a>
            <?php /* if(is_user_logged_in()) : ?>
              <span class="line ml-2 mr-2">|</span> 
              <?php
                $current_user = wp_get_current_user();
                echo $current_user->display_name;
              ?>
              <span class="line ml-2 mr-2">|</span>
              <a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="<?php _e('Odhlásit', 'oneindustry'); ?>" class="c-dark ch-primary">
                <i class="fa fa-sign-out"></i>
              </a>
            <?php else : ?>
              <?php global $wp;
                    $current_url = home_url(add_query_arg(array(),$wp->request)); ?>
              <a id="sign" href="<?php echo get_option('login_other'); ?>" title="<?php _e('Přihlášení', 'oneindustry'); ?>" class="c-dark ch-primary">
                <?php _e('Přihlášení', 'oneindustry'); ?>
              </a>
              <span class="line ml-2 mr-2">|</span>
              <a href="<?php echo get_option('register_other'); ?>" title="<?php _e('Registrace', 'oneindustry'); ?>" class="c-dark ch-primary">
                <?php _e('Registrace', 'oneindustry'); ?>
              </a>
            <?php endif; */ ?>
          </div>
        </div>
      </div>
     
      <nav class="navbar navbar-expand-lg navbar-dark bg-primary text-white justify-content-center mb-4">
        <div class="d-block d-lg-none navbar-brand" href="<?php echo home_url(); ?>">
          <?php the_custom_logo(); ?>
          <div class="blogname ml-3">
            <a href="<?php bloginfo('url'); ?>" class="no-decoration text-dark">
              <?php bloginfo('name'); ?>
            </a>
          </div>
        </div>
        <button class="navbar-toggler x collapsed" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        <?php
          wp_nav_menu([
            'menu'            => 'top',
            'theme_location'  => 'top',
            'container'       => 'div',
            'container_id'    => 'navigation',
            'container_class' => 'collapse navbar-collapse justify-content-center',
            'menu_id'         => false,
            'menu_class'      => 'navbar-nav',
            'depth'           => 2,
            'fallback_cb'     => 'bs4navwalker::fallback',
            'walker'          => new bs4navwalker()
          ]);
        ?>
      </nav>
    </header>

    <main role="main">