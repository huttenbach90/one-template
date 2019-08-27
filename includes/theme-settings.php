<?php
// Create Theme settings page "Nastavení šablony"
function theme_menu_item() {
	add_submenu_page(
    'options-general.php',
    __('Nastavení šablony', 'oneindustry'),
    __('Nastavení šablony', 'oneindustry'),
    "manage_options",
    "theme-settings",
    "theme_page"
  );
}
add_action("admin_menu", "theme_menu_item");

function theme_page() { 
	?>
	<div class="wrap">
    <?php settings_errors(); ?>
            
    <h1 class="dashicons-before dashicons-admin-generic"> <?php echo __("Nastavení šablony", "oneindustry"); ?></h1>
    <p class="info"><?php echo __("Každá sekce se ukládá zvlášť. Pro uložení inputu klikněte na tlačítko pod daným formulářem, jinak změna nebude respektována.", "oneindustry"); ?></p>

    <?php $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'codes-global'; ?>  

    <h2 class="nav-tab-wrapper">  
      <a href="?page=theme-settings&tab=codes-global" class="nav-tab <?php echo $active_tab == 'codes-global' ? 'nav-tab-active' : ''; ?>"><?php echo __("Kódy v šabloně", "oneindustry"); ?></a>  
      <a href="?page=theme-settings&tab=social-media" class="nav-tab <?php echo $active_tab == 'social-media' ? 'nav-tab-active' : ''; ?>"><?php echo __("Sociální média", "oneindustry"); ?></a>
      <a href="?page=theme-settings&tab=marketing" class="nav-tab <?php echo $active_tab == 'marketing' ? 'nav-tab-active' : ''; ?>"><?php echo __("Marketing", "oneindustry"); ?></a>
      <a href="?page=theme-settings&tab=other" class="nav-tab <?php echo $active_tab == 'other' ? 'nav-tab-active' : ''; ?>"><?php echo __("Ostatní", "oneindustry"); ?></a>
    </h2>  

    <form id="sablona" method="post" action="options.php">
      <?php
        if ($active_tab == 'codes-global') {
          settings_fields("codes_global");
          do_settings_sections("codes-global-theme-options");
        } elseif ($active_tab == 'social-media') {
          settings_fields("social_media");
          do_settings_sections("social-media-theme-options"); 
        } elseif ($active_tab == 'marketing') {
          settings_fields("marketing");
          do_settings_sections("marketing-theme-options"); 
        } elseif ($active_tab == 'other') {
          settings_fields("other");
          do_settings_sections("other-theme-options"); 
        }
        submit_button(); 
      ?>          
    </form>
    
    <br>
  </div>
<?php
}

// Create fields for Theme settings page [codes_global]
function display_before_header_end_codes_global() {
	?>
  <textarea cols="100" rows="4" name="before_header_end_codes_global" id="before_header_end_codes_global"><?php echo get_option('before_header_end_codes_global'); ?></textarea>
  <?php
}
function display_after_body_codes_global() {
	?>
  <textarea cols="100" rows="4" name="after_body_codes_global" id="after_body_codes_global"><?php echo get_option('after_body_codes_global'); ?></textarea>
  <?php
}
function display_in_footer_codes_global() {
	?>
  <textarea cols="100" rows="4" name="in_footer_codes_global" id="in_footer_codes_global"><?php echo get_option('in_footer_codes_global'); ?></textarea>
  <?php
}
function display_description_header_codes_global() {
  ?>
  <input type="text" size="100" name="description_header" id="description_header" value="<?php echo get_option("description_header"); ?>" />
  <?php 
}
function display_codes_global_fields() {
	add_settings_section("codes_global", null, null, "codes-global-theme-options");
	
	add_settings_field("before_header_end_codes_global", __('Před <\ head > tagem', 'oneindustry'), "display_before_header_end_codes_global", "codes-global-theme-options", "codes_global");
	add_settings_field("after_body_codes_global", __('Za < body > tagem', 'oneindustry'), "display_after_body_codes_global", "codes-global-theme-options", "codes_global");
  add_settings_field("in_footer_codes_global", __('V patičce', 'oneindustry'), "display_in_footer_codes_global", "codes-global-theme-options", "codes_global");
  add_settings_field("description_header", __("Popis webu, když není vyplněn", "oneindustry"), "display_description_header_codes_global", "codes-global-theme-options", "codes_global");

  register_setting("codes_global", "before_header_end_codes_global");
	register_setting("codes_global", "after_body_codes_global");
  register_setting("codes_global", "in_footer_codes_global");
  register_setting("codes_global", "description_header");
}
add_action("admin_init", "display_codes_global_fields");

// Create fields for Theme settings page "Nastavení šablony" [social_media]
function display_facebook_social_media() {
	?>
  <input type="text" size="100" name="facebook_social_media" id="facebook_social_media" value="<?php echo get_option('facebook_social_media'); ?>" />
  <?php
}
function display_fb_app_id_social_media() {
	?>
  <input type="text" size="100" name="fb_app_id_social_media" id="fb_app_id_social_media" value="<?php echo get_option('fb_app_id_social_media'); ?>" />
  <?php
}
function display_twitter_social_media() {
	?>
  <input type="text" size="100" name="twitter_social_media" id="twitter_social_media" value="<?php echo get_option('twitter_social_media'); ?>" />
<?php
}
function display_social_media_fields() {
	add_settings_section("social_media", null, null, "social-media-theme-options");
	
  add_settings_field("facebook_social_media", __('Facebook user', 'oneindustry'), "display_facebook_social_media", "social-media-theme-options", "social_media");
  add_settings_field("fb_app_id_social_media", __('Facebook APP ID', 'oneindustry'), "display_fb_app_id_social_media", "social-media-theme-options", "social_media");
  add_settings_field("twitter_social_media", __('Twitter user', 'oneindustry'), "display_twitter_social_media", "social-media-theme-options", "social_media");
  
  register_setting("social_media", "facebook_social_media");
  register_setting("social_media", "fb_app_id_social_media");
	register_setting("social_media", "twitter_social_media");
}
add_action("admin_init", "display_social_media_fields");

// Create fields for Theme settings page "Nastavení šablony" [marketing]
function display_codes_gtm() {
	?>
  <input type="text" size="100" name="codes_gtm" id="codes_gtm" value="<?php echo get_option('codes_gtm'); ?>" />
  <?php
}
function display_marketing_fields() {
	add_settings_section("marketing", null, null, "marketing-theme-options");
	
  add_settings_field("codes_gtm", __('Google Tag Manager', 'oneindustry'), "display_codes_gtm", "marketing-theme-options", "marketing");
  
  register_setting("marketing", "codes_gtm");
}
add_action("admin_init", "display_marketing_fields");

// Create fields for Theme settings page "Nastavení šablony" [ostatni]
function display_login_other() {
	?>
  <input type="text" size="100" name="login_other" id="login_other" value="<?php echo get_option('login_other'); ?>" />
  <?php
}
function display_register_other() {
	?>
  <input type="text" size="100" name="register_other" id="register_other" value="<?php echo get_option('register_other'); ?>" />
  <?php
}
function display_default_image_other() {
  if(function_exists( 'wp_enqueue_media' )){
    wp_enqueue_media();
  }else{
    wp_enqueue_style('thickbox');
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
  }
  ?>
  <input class="default_image_other" id="default_image_other" type="text" name="default_image_other" size="60" value="<?php echo get_option('default_image_other'); ?>">
  <a href="#" id="choose_default_image_other" class="button button-default"><?php echo __("Vybrat obrázek"); ?></a><br />
  <img class="preview_image" src="<?php echo get_option('default_image_other'); ?>" height="100" width="auto"/>
  <?php
}

function display_other_fields() {
	add_settings_section("other", null, null, "other-theme-options");
	
  add_settings_field("login_other", __('Přihlášení URL', 'oneindustry'), "display_login_other", "other-theme-options", "other");
  add_settings_field("register_other", __('Registrace URL', 'oneindustry'), "display_register_other", "other-theme-options", "other");
  add_settings_field("default_image_other", __('Výchozí obrázek', 'oneindustry'), "display_default_image_other", "other-theme-options", "other");
  
  register_setting("other", "login_other");
  register_setting("other", "register_other");
  register_setting("other", "default_image_other");
}
add_action("admin_init", "display_other_fields");