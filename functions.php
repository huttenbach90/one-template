<?php
// Handle language
load_theme_textdomain('zoner', get_template_directory() . '/languages');

// Custom navwalker
require_once('modules/bs4navwalker.php');

// Custom post types, custom fields and settings
require_once('includes/post-types.php');
require_once('includes/theme-settings.php');
require_once('includes/theme-settings-home.php');
require_once('includes/theme-settings-com.php');
require_once('includes/custom-fields.php');

// Enqueue scripts and styles
function bootstrap_theme_enqueue_scripts() {
	$template_url = get_template_directory_uri();

	// jQuery.
	wp_enqueue_script( 'jquery' );

	// Bootstrap
	wp_enqueue_script( 'bootstrap-script', $template_url . '/assets/js/bootstrap.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'bootstrap-script', $template_url . '/assets/js/bootstrap.bundle.min.js', array( 'jquery' ) );
	wp_enqueue_style( 'bootstrap-style', $template_url . '/assets/css/bootstrap.min.css' );
	wp_enqueue_style( 'bootstrap-style', $template_url . '/assets/css/bootstrap-grid.min.css' );
    wp_enqueue_style( 'bootstrap-style', $template_url . '/assets/css/bootstrap-reboot.min.css' );

    // Styles
    wp_enqueue_style('print', get_template_directory_uri() . '/assets/css/print.css', array(), '1.0.0', 'print');
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css');
    wp_enqueue_style( 'main-style', get_stylesheet_uri() );
    wp_enqueue_style('responsive', get_template_directory_uri() . '/assets/css/responsive.css');
    
    // Scripts 
    wp_enqueue_script('main', get_template_directory_uri() . '/assets/js/main.js', array(), false, true);
}
add_action( 'wp_enqueue_scripts', 'bootstrap_theme_enqueue_scripts', 1 );

// Admin scripts
function admin_scripts() {
    wp_enqueue_script('admin', get_template_directory_uri() . '/assets/js/admin.js', array(), 1.0);
    wp_enqueue_script( 'jquery-ui-datepicker' );
}
add_action('admin_enqueue_scripts', 'admin_scripts');

// Remove emoticons support
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

//Add thumbnail, automatic feed links and title tag support
add_theme_support( 'title-tag' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'post-formats', array('video', 'chat', 'status', 'aside'));

// Add custom logo support
add_theme_support( 'custom-logo', array(
	'height'      => 70,
	'width'       => 150,
	'flex-height' => true,
	'flex-width'  => true,
	'header-text' => array( 'site-title', 'site-description' ),
) );

add_filter( 'get_custom_logo', 'change_logo_class' );
function change_logo_class( $html ) {
    $html = str_replace( 'custom-logo-link', 'navbar-brand', $html );
    return $html;
}

//Add menu support and register main menu
if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menu('top', 'Top menu');
	register_nav_menu('inside', 'Homepage');
}

// No diacritic in menu name
function clean($string) {
    $string = str_replace(' ', '-', $string); 
    return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
 }

// Register sidebar
add_action('widgets_init', 'theme_register_sidebar');
function theme_register_sidebar() {
	if ( function_exists('register_sidebar') ) {
		register_sidebar(array(
            'name' => __("Banner ATYP 1170x260", "oneindustry"),
			'id' => 'banner-atyp',
		    'before_widget' => '<div id="%1$s" class="widget %2$s">',
		    'after_widget' => '</div>'
         ));
         register_sidebar(array(
             'name' => __("Banner bok - Medium rectangle 300x250", "oneindustry"),
             'id' => 'banner-medium-rectangle',
             'before_widget' => '<div id="%1$s" class="widget %2$s">',
		    'after_widget' => '</div>'
         ));
         register_sidebar(array(
            'name' => __("Banner pod sliderem - Leaderboard 728x90", "oneindustry"),
            'id' => 'banner-leaderboard',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
           'after_widget' => '</div>'
        ));
        register_sidebar(array(
            'name' => __("Banner bok - Wide scycraper 160x600", "oneindustry"),
            'id' => 'banner-wide-scycraper',
            'before_widget' => '',
           'after_widget' => ''
        ));
        register_sidebar(array(
            'name' => __("Banner bok - Scycraper 120x600", "oneindustry"),
            'id' => 'banner-scycraper',
            'before_widget' => '',
           'after_widget' => ''
        ));
        register_sidebar(array(
            'name' => __("Banner v kalendáři - Square 158x158", "oneindustry"),
            'id' => 'banner-square',
            'before_widget' => '',
           'after_widget' => ''
        ));
        register_sidebar(array(
            'name' => __("Odkazy v patičce", "oneindustry"),
            'id' => 'footer-links',
            'before_widget' => '<div class="footer-links col-12 mb-5">',
           'after_widget' => '</div>',
           'before_title' => '<span class="d-none">',
            'after_title' => '</span>',
        ));
	}
}

// Add FontAwesome into visual editor
add_action( 'init', 'prefix_add_editor_styles' );
function prefix_add_editor_styles() {
    add_editor_style(get_template_directory_uri() . '/assets/css/font-awesome.min.css' );
}

function add_mce_markup( $initArray ) {
	$ext = 'i[id|name|class|style]';
	if ( isset( $initArray['extended_valid_elements'] ) ) {
			$initArray['extended_valid_elements'] .= ',' . $ext;
	} else {
			$initArray['extended_valid_elements'] = $ext;
	}
	return $initArray;
}
add_filter( 'tiny_mce_before_init', 'add_mce_markup' );

function enqueue_plugin_scripts($plugin_array){
    $plugin_array["icon_button_plugin"] =  get_template_directory_uri() . "/assets/js/visual-editor-buttons.js";
    return $plugin_array;
}
add_filter("mce_external_plugins", "enqueue_plugin_scripts");

function register_buttons_editor($buttons) {
    array_push($buttons, "icon");
    return $buttons;
}
add_filter("mce_buttons", "register_buttons_editor");

// Admin menu order
function wpse_233129_custom_menu_order() {
    return array( 'index.php', 'upload.php' );
}
add_filter( 'custom_menu_order', '__return_true' );
add_filter( 'menu_order', 'wpse_233129_custom_menu_order' );

// Add admin menu separator
add_action( 'admin_init', 'add_admin_menu_separator' );
function add_admin_menu_separator( $position ) {
	global $menu;
	$menu[ $position ] = array(
		0	=>	'',
		1	=>	'read',
		2	=>	'separator' . $position,
		3	=>	'',
		4	=>	'wp-menu-separator'
	);
}
add_action( 'admin_menu', 'set_admin_menu_separator' );
function set_admin_menu_separator() {
	do_action( 'admin_init', 13 );
} 

// Excerpt for slider
function slider_excerpt($new_length = 15, $new_more = '...') {
 
	add_filter('excerpt_length', function () use ($new_length) {
	  return $new_length;
	}, 999);

	add_filter('excerpt_more', function () use ($new_more) {
	  return $new_more;
	});

	$output = get_the_excerpt();
	$output = apply_filters('wptexturize', $output);
	$output = apply_filters('convert_chars', $output);

	echo $output;
}

// Excerpt for news
function news_excerpt($new_length = 10, $new_more = '...') {
 
	add_filter('excerpt_length', function () use ($new_length) {
	  return $new_length;
	}, 999);

	add_filter('excerpt_more', function () use ($new_more) {
	  return $new_more;
	});

	$output = get_the_excerpt();
	$output = apply_filters('wptexturize', $output);
	$output = apply_filters('convert_chars', $output);

	echo $output;
}

// Breadcrumb
function get_hansel_and_gretel_breadcrumbs()
{
    // Set variables for later use
    $home_link        = home_url('/');
    $home_text        = __( 'Homepage' );
    $link_before      = '<li class="breadcrumb-item"><span typeof="v:Breadcrumb">';
    $link_after       = '</span></li>';
    $link_attr        = ' rel="v:url" property="v:title"';
    $link             = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;
    $delimiter        = '';              
    $before           = '<li class="breadcrumb-item active"><span class="current">'; 
    $after            = '</span></li>';                
    $page_addon       = '';                       // Adds the page number if the query is paged
    $breadcrumb_trail = '';
    $category_links   = '';

    /** 
     * Set our own $wp_the_query variable. Do not use the global variable version due to 
     * reliability
     */
    $wp_the_query   = $GLOBALS['wp_the_query'];
    $queried_object = $wp_the_query->get_queried_object();

    // Handle single post requests which includes single pages, posts and attatchments
    if ( is_singular() ) 
    {
        /** 
         * Set our own $post variable. Do not use the global variable version due to 
         * reliability. We will set $post_object variable to $GLOBALS['wp_the_query']
         */
        $post_object = sanitize_post( $queried_object );

        // Set variables 
        $title          = apply_filters( 'the_title', $post_object->post_title );
        $parent         = $post_object->post_parent;
        $post_type      = $post_object->post_type;
        $post_id        = $post_object->ID;
        $post_link      = $before . $title . $after;
        $parent_string  = '';
        $post_type_link = '';

        if ( 'post' === $post_type ) 
        {
            // Get the post categories
            $categories = get_the_category( $post_id );
            if ( $categories ) {
                // Lets grab the first category
                $category  = $categories[0];

                $category_links = get_category_parents( $category, true, $delimiter );
                $category_links = str_replace( '<a',   $link_before . '<a' . $link_attr, $category_links );
                $category_links = str_replace( '</a>', '</a>' . $link_after,             $category_links );
            }
        }

        if ( !in_array( $post_type, ['post', 'page', 'attachment'] ) )
        {
            $post_type_object = get_post_type_object( $post_type );
            $archive_link     = esc_url( get_post_type_archive_link( $post_type ) );

            $post_type_link   = sprintf( $link, $archive_link, $post_type_object->labels->singular_name );
        }

        // Get post parents if $parent !== 0
        if ( 0 !== $parent ) 
        {
            $parent_links = [];
            while ( $parent ) {
                $post_parent = get_post( $parent );

                $parent_links[] = sprintf( $link, esc_url( get_permalink( $post_parent->ID ) ), get_the_title( $post_parent->ID ) );

                $parent = $post_parent->post_parent;
            }

            $parent_links = array_reverse( $parent_links );

            $parent_string = implode( $delimiter, $parent_links );
        }

        // Lets build the breadcrumb trail
        if ( $parent_string ) {
            $breadcrumb_trail = $parent_string . $delimiter . $post_link;
        } else {
            $breadcrumb_trail = $post_link;
        }

        if ( $post_type_link )
            $breadcrumb_trail = $post_type_link . $delimiter . $breadcrumb_trail;

        if ( $category_links )
            $breadcrumb_trail = $category_links . $breadcrumb_trail;
    }

    // Handle archives which includes category-, tag-, taxonomy-, date-, custom post type archives and author archives
    if( is_archive() )
    {
        if (    is_category()
             || is_tag()
             || is_tax()
        ) {
            // Set the variables for this section
            $term_object        = get_term( $queried_object );
            $taxonomy           = $term_object->taxonomy;
            $term_id            = $term_object->term_id;
            $term_name          = $term_object->name;
            $term_parent        = $term_object->parent;
            $taxonomy_object    = get_taxonomy( $taxonomy );
            $current_term_link  = $before . $taxonomy_object->labels->singular_name . ': ' . $term_name . $after;
            $parent_term_string = '';

            if ( 0 !== $term_parent )
            {
                // Get all the current term ancestors
                $parent_term_links = [];
                while ( $term_parent ) {
                    $term = get_term( $term_parent, $taxonomy );

                    $parent_term_links[] = sprintf( $link, esc_url( get_term_link( $term ) ), $term->name );

                    $term_parent = $term->parent;
                }

                $parent_term_links  = array_reverse( $parent_term_links );
                $parent_term_string = implode( $delimiter, $parent_term_links );
            }

            if ( $parent_term_string ) {
                $breadcrumb_trail = $parent_term_string . $delimiter . $current_term_link;
            } else {
                $breadcrumb_trail = $current_term_link;
            }

        } elseif ( is_author() ) {

            $breadcrumb_trail = __( 'Autor', 'oneindustry') .  $before . $queried_object->data->display_name . $after;

        } elseif ( is_date() ) {
            // Set default variables
            $year     = $wp_the_query->query_vars['year'];
            $monthnum = $wp_the_query->query_vars['monthnum'];
            $day      = $wp_the_query->query_vars['day'];

            // Get the month name if $monthnum has a value
            if ( $monthnum ) {
                $date_time  = DateTime::createFromFormat( '!m', $monthnum );
                $month_name = $date_time->format( 'F' );
            }

            if ( is_year() ) {

                $breadcrumb_trail = $before . $year . $after;

            } elseif( is_month() ) {

                $year_link        = sprintf( $link, esc_url( get_year_link( $year ) ), $year );

                $breadcrumb_trail = $year_link . $delimiter . $before . $month_name . $after;

            } elseif( is_day() ) {

                $year_link        = sprintf( $link, esc_url( get_year_link( $year ) ),             $year       );
                $month_link       = sprintf( $link, esc_url( get_month_link( $year, $monthnum ) ), $month_name );

                $breadcrumb_trail = $year_link . $delimiter . $month_link . $delimiter . $before . $day . $after;
            }

        } elseif ( is_post_type_archive() ) {

            $post_type        = $wp_the_query->query_vars['post_type'];
            $post_type_object = get_post_type_object( $post_type );

            $breadcrumb_trail = $before . $post_type_object->labels->singular_name . $after;

        }
    }   

    // Handle the search page
    if ( is_search() ) {
        $breadcrumb_trail = __( 'Hledání: ', 'oneindustry' ) . $before . get_search_query() . $after;
    }

    // Handle 404's
    if ( is_404() ) {
        $breadcrumb_trail = $before . __( 'Chyba 404', 'oneindustry' ) . $after;
    }

    // Handle paged pages
    if ( is_paged() ) {
        $current_page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : get_query_var( 'page' );
        $page_addon   = $before . sprintf( __( ' ( Strana %s )', 'oneindustry' ), number_format_i18n( $current_page ) ) . $after;
    }

    $breadcrumb_output_link  = '';
    $breadcrumb_output_link .= '<nav aria-label="breadcrumb"><ol class="breadcrumb bg-white pl-0 pr-0">';
    if (    is_home()
         || is_front_page()
    ) {
        // Do not show breadcrumbs on page one of home and frontpage
        if ( is_paged() ) {
            $breadcrumb_output_link .= '<li class="breadcrumb-item"><a href="' . $home_link . '">' . $home_text . '</a></li>';
            $breadcrumb_output_link .= $page_addon;
        }
    } else {
        $breadcrumb_output_link .= '<li class="breadcrumb-item"><a href="' . $home_link . '" rel="v:url" property="v:title">' . $home_text . '</a></li>';
        $breadcrumb_output_link .= $delimiter;
        $breadcrumb_output_link .= $breadcrumb_trail;
        $breadcrumb_output_link .= $page_addon;
    }
    $breadcrumb_output_link .= '</ol></nav>';

    return $breadcrumb_output_link;
}

// Include better comments file
function add_comment_js(){
	if (!is_admin()){
		if (!is_page() AND is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}
add_action('get_header', 'add_comment_js');

// Placeholder comment form
add_filter( 'comment_form_defaults', 'help4cms_textarea_placeholder' );
function help4cms_textarea_placeholder( $fields ) {
        $fields['comment_field'] = str_replace(
            '<textarea',
            '<textarea placeholder="' . __('Přidat se do diskuze ...', 'oneindustry') . '"',
            $fields['comment_field']
        );
    return $fields;
}

// Class for button comment form
function as_adapt_comment_form( $arg ) {
    $arg['class_submit'] = 'btn btn-primary';
    return $arg;
}
add_filter( 'comment_form_defaults', 'as_adapt_comment_form' );

// Replace link "you have to be logged" in comments
add_filter( 'comment_form_defaults', function( $fields ) {
    $fields['must_log_in'] = sprintf( 
        __( '<p class="must-log-in font-weight-bold">
                Pro vstup do diskuze se musíte <u><a href="' . get_option('login_other') . '">přihlásit</a></u>.</p>', 'oneindustry' 
        ),
        wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )   
    );
    return $fields;
});

// Author slug
add_action('init', 'wp_snippet_author_base');
function wp_snippet_author_base() {
    global $wp_rewrite;
    $author_slug = __('firma','oneindustry'); // the new slug name
    $wp_rewrite->author_base = $author_slug;
}

// Add a custom user role
$result = add_role( __('firma', 'oneindustry'), __('Firma' ),
    array(
    'read' => true, 
    'edit_posts' => true, 
    'edit_pages' => false,
    'edit_others_posts' => true,
    'create_posts' => true, 
    'manage_categories' => true, 
    'publish_posts' => true,
    'edit_themes' => false, 
    'install_plugins' => false, 
    'update_plugin' => false, 
    'update_core' => false
    )
);

/* Adding Image Upload Fields */
add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );

function my_show_extra_profile_fields( $user ) { ?>
	<style type="text/css">
		.fh-profile-upload-options th,
		.fh-profile-upload-options td,
		.fh-profile-upload-options input {
			vertical-align: top;
		}
		.user-preview-image {
			display: block;
			height: auto;
			width: auto
		}
	</style>
	<table class="form-table fh-profile-upload-options">
		<tr>
			<th>
				<label for="image"><?php _e('Profilový obrázek', 'oneindustry'); ?></label>
			</th>

			<td>
				<img class="user-preview-image" src="<?php echo esc_attr( get_the_author_meta( 'image', $user->ID ) ); ?>">
				<input type="text" name="image" id="image" value="<?php echo esc_attr( get_the_author_meta( 'image', $user->ID ) ); ?>" class="regular-text" />
				<input type='button' class="button-primary" value="<?php _e('Nahrát obrázek', 'oneindustry'); ?>" id="uploadimage"/><br />
			</td>
		</tr>
	</table>

	<script type="text/javascript">
		(function( $ ) {
			$( '#uploadimage' ).on( 'click', function() {
				tb_show('test', 'media-upload.php?type=image&TB_iframe=1');
				window.send_to_editor = function( html ) {
					imgurl = $( 'img',html ).attr( 'src' );
					$( '#image' ).val(imgurl);
					tb_remove();
				}
				return false;
			});
		})(jQuery);
	</script>
<?php 
}
add_action( 'admin_enqueue_scripts', 'enqueue_admin' );
function enqueue_admin(){
	wp_enqueue_script( 'thickbox' );
	wp_enqueue_style('thickbox');
	wp_enqueue_script('media-upload');
}
add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );
function my_save_extra_profile_fields( $user_id ) {
	if ( !current_user_can( 'edit_user', $user_id ) ) {
		return false;
	}
    update_user_meta( $user_id, 'image', $_POST[ 'image' ] );
}

// Add profile Contacts field
add_action( 'show_user_profile', 'profile_contact_field' );
add_action( 'edit_user_profile', 'profile_contact_field' );
function profile_contact_field( $user ){ ?>
    <table class="form-table">
        <tr>
            <th><label for="profile_contact"><?php _e('Kontaktní údaje', 'oneindustry'); ?></label></th>
            <td>
                <textarea type="text" name="profile_contact" style="height: 200px" id="profile_contact" class="regular-text" /><?php echo esc_attr( get_the_author_meta( 'profile_contact', $user->ID ) ); ?></textarea>
            </td>
        </tr>

    </table>
<?php };
add_action( 'personal_options_update', 'save_profile_contact_field' );
add_action( 'edit_user_profile_update', 'save_profile_contact_field' );
function save_profile_contact_field( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) )
        return false;
    update_usermeta( $user_id, 'profile_contact', $_POST['profile_contact'] );
}

// Views
function wpb_set_post_views($postID) {
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
function wpb_track_post_views ($post_id) {
    if ( !is_single() ) return;
    if ( empty ( $post_id) ) {
        global $post;
        $post_id = $post->ID;    
    }
    wpb_set_post_views($post_id);
}
add_action( 'wp_head', 'wpb_track_post_views');

// Last post class
add_filter('post_class', function($classes){
    global $wp_query;
    if(($wp_query->current_post + 1) == $wp_query->post_count)
      $classes[] = 'last';  
    return $classes;
});

// Pagination 
function kriesi_pagination($pages = '', $range = 1) {  
    $showitems = ($range * 2);  
    global $paged;
    if(empty($paged)) $paged = 1;
    if($pages == '') {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if(!$pages) {
            $pages = 1;
        }
    }   
    if(1 != $pages) {
        echo "<div class='pagination mt-4 text-center'>";
        if($paged > 1 && $paged > $range+1 && $showitems < $pages) echo "<a class='btn btn-secondary ml-1 mr-1' href='".get_pagenum_link(1)."'>&laquo;</a>";
        if($paged > 1) echo "<a class='btn btn-secondary ml-1 mr-1' href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";
        for ($i=1; $i <= $pages; $i++) {
            if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
                echo ($paged == $i)? "<span class='btn btn-secondary cursor-default current ml-1 mr-1'>strana ".$i." z " . $pages . "</span>":"";
            }
        }
        if ($paged < $pages) echo "<a class='btn btn-secondary ml-1 mr-1' href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
        if ($paged < $pages-1 && $paged+$range-1 < $pages && $showitems < $pages) echo "<a class='btn btn-secondary ml-1 mr-1' href='".get_pagenum_link($pages)."'>&raquo;</a>";
        echo "</div>\n";
    }
}

// Login ¨¨
/*
function redirect_login_page() {
    $login_page  = home_url( '/prihlaseni/' );
    $page_viewed = basename($_SERVER['REQUEST_URI']);
   
    if( $page_viewed == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
      wp_redirect($login_page);
      exit;
    }
  }
  add_action('init','redirect_login_page');
  function login_failed() {
    $login_page  = home_url( '/prihlaseni/' );
    wp_redirect( $login_page . '?login=failed' );
    exit;
  }
  add_action( 'wp_login_failed', 'login_failed' );
   
  function verify_username_password( $user, $username, $password ) {
    $login_page  = home_url( '/prihlaseni/' );
      if( $username == "" || $password == "" ) {
          wp_redirect( $login_page . "?login=empty" );
          exit;
      }
  }
  add_filter( 'authenticate', 'verify_username_password', 1, 3);
  function logout_page() {
    $login_page  = home_url( '/prihlaseni/' );
    wp_redirect( $login_page . "?login=false" );
    exit;
  }
add_action('wp_logout','logout_page');

/*
add_action('init','tiny_login');
function tiny_login() {
  global $tiny_error;
  $tiny_error = false;
  if (isset($_POST['username']) && isset($_POST['password'])) {
    $creds = array();
    $creds['user_login'] = $_POST['username'];
    $creds['user_password'] = $_POST['password'];
    //$creds['remember'] = false;
    $user = wp_signon( $creds );
    if ( is_wp_error($user) ) {
      $tiny_error = $user->get_error_message();
    } else {
      if (isset($_POST['redirect']) && $_POST['redirect']) {
        wp_redirect($_POST['redirect']);
      }
    }
  }
}
// shows error message
function the_tiny_error() {
  echo get_tiny_error();
}
function get_tiny_error() {
  global $tiny_error;
  if ($tiny_error) {
    $return = $tiny_error;
    $tiny_error = false;
    return $return;
  } else {
    return false;
  }
}
// shows login form (or a message, if user already logged in)
function get_tiny_login_form($redirect=false) {
  if (!is_user_logged_in()) {
    $return = "<form action=\"\" method=\"post\" class=\"tiny_form tiny_login\">\r\n";
    $error = get_tiny_error();
    if ($error)
      $return .= "<p class=\"error\">{$error}</p>\r\n";
    $return .= "  <p>
      <label for=\"tiny_username\">".__('Username','theme')."</label>
      <input type=\"text\" id=\"tiny_username\" name=\"username\" value=\"".(isset($_POST['username'])?$_POST['username']:"")."\"/>
    </p>\r\n";
    $return .= "  <p>
      <label for=\"tiny_password\">".__('Password','theme')."</label>
      <input type=\"password\" id=\"tiny_password\" name=\"password\"/>
    </p>\r\n";
    if ($redirect)
      $return .= "  <input type=\"hidden\" name=\"redirect\" value=\"{$redirect}\">\r\n";
    $return .= "  <button type=\"submit\">".__('Login','theme')."</button>\r\n";
    $return .= "</form>\r\n";
  } else {
    $return = "<p>".__('User is already logged in','theme')."</p>";
  }
  return $return;
}
function the_tiny_login_form($redirect=false) {
  echo get_tiny_login_form($redirect);
}
// adds a handy [tiny_login] shortcode to use in posts/pages
add_shortcode('tiny_login','tiny_login_shortcode');
function tiny_login_shortcode ($atts,$content=false) {
  $atts = shortcode_atts(array(
    'redirect' => false
  ), $atts);
  return get_tiny_login_form($atts['redirect']);
}
  */

// Redirect login
add_action( 'wp_login_failed', 'my_front_end_login_fail' ); 
function my_front_end_login_fail( $username ) {
   $referrer = $_SERVER['HTTP_REFERER'];  
   if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') ) {
      wp_redirect( $referrer . '?login=failed' ); 
      exit;
   }
}

/* Register
function registration_form( $username, $password, $email, $website, $first_name, $last_name, $nickname, $bio ) {
    echo '
    <style>
    div {
        margin-bottom:2px;
    }
     
    input{
        margin-bottom:4px;
    }
    </style>
    ';
 
    echo '
    <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
    <div>
    <label for="username">Username <strong>*</strong></label>
    <input type="text" name="username" value="' . ( isset( $_POST['username'] ) ? $username : null ) . '">
    </div>
     
    <div>
    <label for="password">Password <strong>*</strong></label>
    <input type="password" name="password" value="' . ( isset( $_POST['password'] ) ? $password : null ) . '">
    </div>
     
    <div>
    <label for="email">Email <strong>*</strong></label>
    <input type="text" name="email" value="' . ( isset( $_POST['email']) ? $email : null ) . '">
    </div>
     
    <div>
    <label for="website">Website</label>
    <input type="text" name="website" value="' . ( isset( $_POST['website']) ? $website : null ) . '">
    </div>
     
    <div>
    <label for="firstname">First Name</label>
    <input type="text" name="first_name" value="' . ( isset( $_POST['first_name']) ? $first_name : null ) . '">
    </div>
     
    <div>
    <label for="website">Last Name</label>
    <input type="text" name="last_name" value="' . ( isset( $_POST['last_name']) ? $last_name : null ) . '">
    </div>
     
    <div>
    <label for="nickname">Nickname</label>
    <input type="text" name="nickname" value="' . ( isset( $_POST['nickname']) ? $nickname : null ) . '">
    </div>
     
    <div>
    <label for="bio">About / Bio</label>
    <textarea name="bio">' . ( isset( $_POST['bio']) ? $bio : null ) . '</textarea>
    </div>
    <input type="submit" name="submit" value="Register"/>
    </form>
    ';
}
function registration_validation( $username, $password, $email, $website, $first_name, $last_name, $nickname, $bio )  {
    global $reg_errors;
$reg_errors = new WP_Error;
if ( empty( $username ) || empty( $password ) || empty( $email ) ) {
    $reg_errors->add('field', 'Required form field is missing');
}
if ( 4 > strlen( $username ) ) {
    $reg_errors->add( 'username_length', 'Username too short. At least 4 characters is required' );
}
if ( username_exists( $username ) ) {
    $reg_errors->add('user_name', 'Sorry, that username already exists!');
}
if ( ! validate_username( $username ) ) {
    $reg_errors->add( 'username_invalid', 'Sorry, the username you entered is not valid' );
}
if ( 5 > strlen( $password ) ) {
    $reg_errors->add( 'password', 'Password length must be greater than 5' );
}
if ( !is_email( $email ) ) {
    $reg_errors->add( 'email_invalid', 'Email is not valid' );
}
if ( email_exists( $email ) ) {
    $reg_errors->add( 'email', 'Email Already in use' );
}
if ( ! empty( $website ) ) {
    if ( ! filter_var( $website, FILTER_VALIDATE_URL ) ) {
        $reg_errors->add( 'website', 'Website is not a valid URL' );
    }
}
if ( is_wp_error( $reg_errors ) ) {
 
    foreach ( $reg_errors->get_error_messages() as $error ) {
     
        echo '<div>';
        echo '<strong>ERROR</strong>:';
        echo $error . '<br/>';
        echo '</div>';
         
    }
 
}
}
function complete_registration() {
    global $reg_errors, $username, $password, $email, $website, $first_name, $last_name, $nickname, $bio;
    if ( 1 > count( $reg_errors->get_error_messages() ) ) {
        $userdata = array(
        'user_login'    =>   $username,
        'user_email'    =>   $email,
        'user_pass'     =>   $password,
        'user_url'      =>   $website,
        'first_name'    =>   $first_name,
        'last_name'     =>   $last_name,
        'nickname'      =>   $nickname,
        'description'   =>   $bio,
        );
        $user = wp_insert_user( $userdata );
        echo 'Registration complete. Goto <a href="' . get_site_url() . '/wp-login.php">login page</a>.';   
    }
}
function custom_registration_function() {
    if ( isset($_POST['submit'] ) ) {
        registration_validation(
        $_POST['username'],
        $_POST['password'],
        $_POST['email'],
        $_POST['website'],
        $_POST['first_name'],
        $_POST['last_name'],
        $_POST['nickname'],
        $_POST['bio']
        );
         
        // sanitize user form input
        global $username, $password, $email, $website, $first_name, $last_name, $nickname, $bio;
        $username   =   sanitize_user( $_POST['username'] );
        $password   =   esc_attr( $_POST['password'] );
        $email      =   sanitize_email( $_POST['email'] );
        $website    =   esc_url( $_POST['website'] );
        $first_name =   sanitize_text_field( $_POST['first_name'] );
        $last_name  =   sanitize_text_field( $_POST['last_name'] );
        $nickname   =   sanitize_text_field( $_POST['nickname'] );
        $bio        =   esc_textarea( $_POST['bio'] );
 
        // call @function complete_registration to create the user
        // only when no WP_error is found
        complete_registration(
        $username,
        $password,
        $email,
        $website,
        $first_name,
        $last_name,
        $nickname,
        $bio
        );
    }
 
    registration_form(
        $username,
        $password,
        $email,
        $website,
        $first_name,
        $last_name,
        $nickname,
        $bio
        );
}

// Register a new shortcode: [cr_custom_registration]
add_shortcode( 'cr_custom_registration', 'custom_registration_shortcode' );
 
// The callback function that will replace [book]
function custom_registration_shortcode() {
    ob_start();
    custom_registration_function();
    return ob_get_clean();
}*/

/* First name as default display name. */
add_action( 'profile_update', 'set_display_name', 10 );
function set_display_name( $user_id ) {
    $data = get_userdata( $user_id );
    if($data->first_name) {
        remove_action( 'profile_update', 'set_display_name', 10 );
        wp_update_user( 
            array (
                'ID' => $user_id, 
                'display_name' => "$data->first_name"
            ) 
        );
        add_action( 'profile_update', 'set_display_name', 10 );
    }
}


add_filter( 'gettext', 'wpse_change_error_string', 10, 3 );
/**
 * Translate text.
 *
 * @param string $translation  Translated text.
 * @param string $text         Text to translate.
 * @param string $domain       Text domain. Unique identifier for retrieving translated strings.
 *
 * @return string
 */
function wpse_change_error_string( $translation, $text, $domain ) {
    // The 'default' text domain is reserved for the WP core. If no text domain
    // is passed to a gettext function, the 'default' domain will be used.
    if ( 'default' === $domain && 'Sorry, that username already exists!' === $text ) {
        $translation = __("Zvolená emailová adresa už je bohužel registrována!", "oneindustry");
    }

    return $translation;
}

// default target blank links
function default_target_blank() {
    ?>
    <script>
        jQuery(document).on( 'wplink-open', function( wrap ) {
            if ( jQuery( 'input#wp-link-url' ).val() <= 0 )
                jQuery( 'input#wp-link-target' ).prop('checked', true );
        });
    </script>
    <?php
}
add_action( 'admin_footer-post-new.php', 'default_target_blank', 10, 0 );
add_action( 'admin_footer-post.php', 'default_target_blank', 10, 0 );

add_filter( 'get_custom_logo',  'custom_logo_url' );
function custom_logo_url ( $html ) {

$custom_logo_id = get_theme_mod( 'custom_logo' );
$url = network_site_url();
$html = sprintf( '<a href="%1$s" class="navbar-brand" rel="home" itemprop="url">%2$s</a>',
        esc_url( $url  ),
        wp_get_attachment_image( $custom_logo_id, 'full', false, array(
            'class'    => 'custom-logo',
        ) )
    );
return $html;    
}

add_action('admin_head', 'broadcast_css');
function broadcast_css() {
    echo "
        <script>
        $(document).ready(function() {
            $('#plainview_sdk_broadcast_form2_inputs_checkbox_link').attr('checked', false);
        });
        </script>";
}

function when_rewrite_rules( $wp_rewrite ) {
    $newrules = array();
    $new_rules['type/([^/]+)/category/([^/]+)/?$'] = 'index.php?post_format=$matches[1]&category_name=$matches[2]';
    $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
  }
  add_filter('generate_rewrite_rules','when_rewrite_rules');

  function my_get_post_format_slugs() {

	$slugs = array(
		'aside'   => 'clanky',
		'chat'    => 'rozhovory',
		'status'  => 'akce',
		'video'   => 'video'
	);

	return $slugs;
}

/* Remove core WordPress filter. */
remove_filter( 'term_link', '_post_format_link', 10 );

/* Add custom filter. */
add_filter( 'term_link', 'my_post_format_link', 10, 3 );

/**
 * Filters post format links to use a custom slug.
 *
 * @param string $link The permalink to the post format archive.
 * @param object $term The term object.
 * @param string $taxnomy The taxonomy name.
 * @return string
 */
function my_post_format_link( $link, $term, $taxonomy ) {
	global $wp_rewrite;

	if ( 'post_format' != $taxonomy )
		return $link;

	$slugs = my_get_post_format_slugs();

	$slug = str_replace( 'post-format-', '', $term->slug );
	$slug = isset( $slugs[ $slug ] ) ? $slugs[ $slug ] : $slug;

	if ( $wp_rewrite->get_extra_permastruct( $taxonomy ) )
		$link = str_replace( "/{$term->slug}", '/' . $slug, $link );
	else
		$link = add_query_arg( 'post_format', $slug, remove_query_arg( 'post_format', $link ) );

	return $link;
}

/* Remove the core WordPress filter. */
remove_filter( 'request', '_post_format_request' );

/* Add custom filter. */
add_filter( 'request', 'my_post_format_request' );

/**
 * Changes the queried post format slug to the slug saved in the database.
 *
 * @param array $qvs The queried variables.
 * @return array
 */
function my_post_format_request( $qvs ) {

	if ( !isset( $qvs['post_format'] ) )
		return $qvs;

	$slugs = array_flip( my_get_post_format_slugs() );

	if ( isset( $slugs[ $qvs['post_format'] ] ) )
		$qvs['post_format'] = 'post-format-' . $slugs[ $qvs['post_format'] ];

	$tax = get_taxonomy( 'post_format' );

	if ( !is_admin() )
		$qvs['post_type'] = $tax->object_type;

	return $qvs;
}

function rename_post_formats($translation, $text, $context, $domain) {
    $names = array(
        'Aside'  => 'Článek/Aktualita',
        'Status' => 'Akce',
        'Chat' => 'Rozhovor',
        'Standard' => 'Bez formátu'
    );
    if ($context == 'Post format') {
        $translation = str_replace(array_keys($names), array_values($names), $text);
    }
    return $translation;
}
add_filter('gettext_with_context', 'rename_post_formats', 10, 4);

function clear_cache() {
    // deletes the default cache for normal Post. (1)
    $cache_key = _count_posts_cache_key( 'post' , 'readable' );

    wp_cache_delete( $cache_key, 'counts' );
}

add_action( 'admin_init', 'clear_cache' );    // you might use other hooks.

function fix_count_orders( $counts, $type, $perm ) {
    global $wpdb;

    if ( ! post_type_exists( $type ) ) {
        return new stdClass();
    }

    $query = "SELECT post_status, COUNT( * ) AS num_posts FROM {$wpdb->posts} WHERE post_type = %s";

    $post_type_object = get_post_type_object( $type );

    // adds condition to respect `$perm`. (3)
    if ( $perm === 'readable' && is_user_logged_in() ) {
        if ( ! current_user_can( $post_type_object->cap->read_private_posts ) ) {
            $query .= $wpdb->prepare(
                " AND (post_status != 'private' OR ( post_author = %d AND post_status = 'private' ))",
                get_current_user_id()
            );
        }
    }

    // limits only author's own posts. (6)
    if ( is_admin() && !current_user_can( 'editor' ) && !current_user_can('admin') ) {
        $query .= $wpdb->prepare( ' AND post_author = %d', get_current_user_id() );
    }

    $query .= ' GROUP BY post_status';

    $results = (array) $wpdb->get_results( $wpdb->prepare( $query, $type ), ARRAY_A );
    $counts  = array_fill_keys( get_post_stati(), 0 );

    foreach ( $results as $row ) {
        $counts[ $row['post_status'] ] = $row['num_posts'];
    }

    $counts    = (object) $counts;
    $cache_key = _count_posts_cache_key( $type, 'readable' );

    // caches the result. (2)
    // although this is not so efficient because the cache is almost always deleted.
    wp_cache_set( $cache_key, $counts, 'counts' );

    return $counts;
}

function query_set_only_author( $wp_query ) {
    if ( ! is_admin() ) {
        return;
    }

    $allowed_types = [ 'post' ];
    $current_type  = get_query_var( 'post_type', 'post' );

    if ( in_array( $current_type, $allowed_types, true ) ) {
        $post_type_object = get_post_type_object( $type );

        if (!current_user_can( 'editor' ) && !current_user_can('admin')  ) {    // (6)
            $wp_query->set( 'author', get_current_user_id() );

            add_filter( 'wp_count_posts', 'fix_count_orders', PHP_INT_MAX, 3 );    // (4)
        }
    }
}

add_action( 'pre_get_posts', 'query_set_only_author', PHP_INT_MAX );    // (4)

function fix_views( $views ) {
    // For normal Post.
    if ( current_user_can( 'admin' ) || current_user_can('editor') ) {
        return;
    }

    unset( $views[ 'sticky' ] );

    return $views;
}

add_filter( 'views_edit-post', 'fix_views', PHP_INT_MAX );     // (5)