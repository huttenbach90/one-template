<?php
// Create Theme settings page "Domácnosti"
function theme_domacnosti_menu_item() {
	add_submenu_page(
    'edit.php?post_type=domacnosti',
    __('Nastavení', 'zonerantivirus'),
    __('Nastavení', 'zonerantivirus'),
    "manage_options",
    "home-theme-settings",
    "theme_domacnosti_page"
  );
}
add_action("admin_menu", "theme_domacnosti_menu_item");

function theme_domacnosti_page() { 
	?>
	<div class="wrap">
    <?php settings_errors(); ?>
            
    <h1 class="dashicons-before dashicons-admin-generic"> <?php echo __("Domácnosti", "zonerantivirus"); ?></h1>
    <p class="info"><?php echo __("Každá sekce se ukládá zvlášť. Pro uložení inputu klikněte na tlačítko pod daným formulářem, jinak změna nebude respektována.", "zonerantivirus"); ?></p>

    <?php $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'header-options'; ?>  

    <h2 class="nav-tab-wrapper">  
      <a href="?post_type=domacnosti&page=home-theme-settings&tab=header-options" class="nav-tab <?php echo $active_tab == 'header-options' ? 'nav-tab-active' : ''; ?>"><?php echo __("Záhlaví", "zonerantivirus"); ?></a>  
      <a href="?post_type=domacnosti&page=home-theme-settings&tab=url-options" class="nav-tab <?php echo $active_tab == 'url-options' ? 'nav-tab-active' : ''; ?>"><?php echo __("URL ke stažení", "zonerantivirus"); ?></a>
      <a href="?post_type=domacnosti&page=home-theme-settings&tab=images-options" class="nav-tab <?php echo $active_tab == 'images-options' ? 'nav-tab-active' : ''; ?>"><?php echo __("Ilustrační obrázky", "zonerantivirus"); ?></a>
      <a href="?post_type=domacnosti&page=home-theme-settings&tab=pricelist-options" class="nav-tab <?php echo $active_tab == 'pricelist-options' ? 'nav-tab-active' : ''; ?>"><?php echo __("Ceník", "zonerantivirus"); ?></a>
      <a href="?post_type=domacnosti&page=home-theme-settings&tab=contact-options" class="nav-tab <?php echo $active_tab == 'contact-options' ? 'nav-tab-active' : ''; ?>"><?php echo __("Kontakt", "zonerantivirus"); ?></a>  
    </h2>  

    <form id="domacnosti" method="post" action="options.php">
      <?php
        if ($active_tab == 'header-options') {
          settings_fields("header_domacnosti");
          do_settings_sections("header-domacnosti-theme-options");
        } else if ($active_tab == 'url-options') {
          settings_fields("url_domacnosti");
          do_settings_sections("url-domacnosti-theme-options"); 
        } else if ($active_tab == 'images-options') {
          settings_fields("images_domacnosti");
          do_settings_sections("images-domacnosti-theme-options");
        } else if ($active_tab == 'pricelist-options') {
          settings_fields("pricelist_domacnosti");
          do_settings_sections("pricelist-domacnosti-theme-options");
        } else if ($active_tab == 'contact-options') {
          settings_fields("contact_domacnosti");
          do_settings_sections("contact-domacnosti-theme-options");
        }
        submit_button(); 
      ?>          
    </form>
    
    <br>
  </div>
<?php
}

// Create fields for Theme settings page "Domácnosti" [header_domacnosti]
function display_headline_header_domacnosti() {
	?>
  <input type="text" size="100" name="headline_header_domacnosti" id="headline_header_domacnosti" value="<?php echo get_option('headline_header_domacnosti'); ?>" />
  <?php
}
function display_description_header_domacnosti() {
	?>
  <textarea cols="100" rows="4" name="description_header_domacnosti" id="description_header_domacnosti"><?php echo get_option('description_header_domacnosti'); ?></textarea>
  <?php
}
function display_header_domacnosti_fields() {
	add_settings_section("header_domacnosti", null, null, "header-domacnosti-theme-options");
	
	add_settings_field("headline_header_domacnosti", __('Nadpis H1', 'zonerantivirus'), "display_headline_header_domacnosti", "header-domacnosti-theme-options", "header_domacnosti");
	add_settings_field("description_header_domacnosti", __('Text pod nadpisem', 'zonerantivirus'), "display_description_header_domacnosti", "header-domacnosti-theme-options", "header_domacnosti");

	register_setting("header_domacnosti", "headline_header_domacnosti");
	register_setting("header_domacnosti", "description_header_domacnosti");
}
add_action("admin_init", "display_header_domacnosti_fields");

// Create fields for Theme settings page "Domácnosti" [url_domacnosti]
function display_android_url_domacnosti() {
	?>
  <input type="text" size="100" name="android_url_domacnosti" id="android_url_domacnosti" value="<?php echo get_option('android_url_domacnosti'); ?>" />
  <?php
}
function display_ios_url_domacnosti() {
	?>
  <input type="text" size="100" name="ios_url_domacnosti" id="ios_url_domacnosti" value="<?php echo get_option('ios_url_domacnosti'); ?>" />
<?php
}
function display_windows_url_domacnosti() {
	?>
  <input type="text" size="100" name="windows_url_domacnosti" id="windows_url_domacnosti"><?php echo get_option('windows_url_domacnosti'); ?>
<?php
}
function display_linux_url_domacnosti() {
	?>
  <input type="text" size="100" name="linux_url_domacnosti" id="linux_url_domacnosti"><?php echo get_option('linux_url_domacnosti'); ?></textarea>
<?php
}
function display_url_domacnosti_fields() {
	add_settings_section("url_domacnosti", null, null, "url-domacnosti-theme-options");
	
	add_settings_field("android_url_domacnosti", __('Android', 'zonerantivirus'), "display_android_url_domacnosti", "url-domacnosti-theme-options", "url_domacnosti");
  add_settings_field("ios_url_domacnosti", __('iOS', 'zonerantivirus'), "display_ios_url_domacnosti", "url-domacnosti-theme-options", "url_domacnosti");
  add_settings_field("windows_url_domacnosti", __('Windows', 'zonerantivirus'), "display_windows_url_domacnosti", "url-domacnosti-theme-options", "url_domacnosti");
  add_settings_field("linux_url_domacnosti", __('Linux', 'zonerantivirus'), "display_linux_url_domacnosti", "url-domacnosti-theme-options", "url_domacnosti");

  register_setting("url_domacnosti", "android_url_domacnosti");
	register_setting("url_domacnosti", "ios_url_domacnosti");
  register_setting("url_domacnosti", "windows_url_domacnosti");
  register_setting("url_domacnosti", "linux_url_domacnosti");
}
add_action("admin_init", "display_url_domacnosti_fields");

// Create fields for Theme settings page "Domácnosti" [images_domacnosti]
function display_header_images_domacnosti() {
  if(function_exists( 'wp_enqueue_media' )){
    wp_enqueue_media();
  }else{
    wp_enqueue_style('thickbox');
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
  }
  ?>
  <input id="header_images_domacnosti" type="text" name="header_images_domacnosti" size="60" value="<?php echo get_option('header_images_domacnosti'); ?>">
  <a href="#" id="choose_header_images_domacnosti" class="button button-default"><?php echo __("Vybrat obrázek"); ?></a><br />
  <img id="preview_header_images_domacnosti" src="<?php echo get_option('header_images_domacnosti'); ?>" height="100" width="auto"/>
  <?php
}
function display_desktop_images_domacnosti() {
  if(function_exists( 'wp_enqueue_media' )){
    wp_enqueue_media();
  }else{
    wp_enqueue_style('thickbox');
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
  }
  ?>
  <input id="desktop_images_domacnosti" type="text" name="desktop_images_domacnosti" size="60" value="<?php echo get_option('desktop_images_domacnosti'); ?>">
  <a href="#" id="choose_desktop_images_domacnosti" class="button button-default"><?php echo __("Vybrat obrázek"); ?></a><br />
  <img id="preview_desktop_images_domacnosti" src="<?php echo get_option('desktop_images_domacnosti'); ?>" height="100" width="auto"/>
  <?php
}
function display_mobile_images_domacnosti() {
  if(function_exists( 'wp_enqueue_media' )){
    wp_enqueue_media();
  }else{
    wp_enqueue_style('thickbox');
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
  }
  ?>
  <input id="mobile_images_domacnosti" type="text" name="mobile_images_domacnosti" size="60" value="<?php echo get_option('mobile_images_domacnosti'); ?>">
  <a href="#" id="choose_mobile_images_domacnosti" class="button button-default"><?php echo __("Vybrat obrázek"); ?></a><br />
  <img id="preview_mobile_images_domacnosti" src="<?php echo get_option('mobile_images_domacnosti'); ?>" height="100" width="auto"/>
  <?php
}
function display_images_domacnosti_fields() {
	add_settings_section("images_domacnosti", null, null, "images-domacnosti-theme-options");
  
  add_settings_field("header_images_domacnosti", __("Hlavička", "zonerantivirus"), "display_header_images_domacnosti", "images-domacnosti-theme-options", "images_domacnosti");
  add_settings_field("desktop_images_domacnosti", __("Vyzkoušej desktop", "zonerantivirus"), "display_desktop_images_domacnosti", "images-domacnosti-theme-options", "images_domacnosti");
  add_settings_field("mobile_images_domacnosti", __("Vyzkoušej mobilní", "zonerantivirus"), "display_mobile_images_domacnosti", "images-domacnosti-theme-options", "images_domacnosti");

  register_setting("images_domacnosti", "header_images_domacnosti");
  register_setting("images_domacnosti", "desktop_images_domacnosti");
  register_setting("images_domacnosti", "mobile_images_domacnosti");
}
add_action("admin_init", "display_images_domacnosti_fields");

// Create fields for Theme settings page "Domácnosti" [contact_domacnosti]
function display_map_contact_domacnosti() {
	?>
  <textarea cols="100" rows="4" name="map_contact_domacnosti" id="map_contact_domacnosti"><?php echo get_option('map_contact_domacnosti'); ?></textarea>
  <?php
}
function display_address_contact_domacnosti() {
	?>
  <textarea cols="100" rows="4" name="address_contact_domacnosti" id="address_contact_domacnosti"><?php echo get_option('address_contact_domacnosti'); ?></textarea>
  <?php
}
function display_email_contact_domacnosti() {
	?>
  <input type="text" size="100" name="email_contact_domacnosti" id="email_contact_domacnosti" value="<?php echo get_option('email_contact_domacnosti'); ?>" />
  <?php
}
function display_phone_contact_domacnosti() {
	?>
  <input type="text" size="100" name="phone_contact_domacnosti" id="phone_contact_domacnosti" value="<?php echo get_option('phone_contact_domacnosti'); ?>" />
  <?php
}
function display_contact_domacnosti_fields() {
	add_settings_section("contact_domacnosti", null, null, "contact-domacnosti-theme-options");
	
  add_settings_field("map_contact_domacnosti", __('Mapa', 'zonerantivirus'), "display_map_contact_domacnosti", "contact-domacnosti-theme-options", "contact_domacnosti");
  add_settings_field("address_contact_domacnosti", __('Adresa', 'zonerantivirus'), "display_address_contact_domacnosti", "contact-domacnosti-theme-options", "contact_domacnosti");
  add_settings_field("email_contact_domacnosti", __('E-mail', 'zonerantivirus'), "display_email_contact_domacnosti", "contact-domacnosti-theme-options", "contact_domacnosti");
  add_settings_field("phone_contact_domacnosti", __('Telefon', 'zonerantivirus'), "display_phone_contact_domacnosti", "contact-domacnosti-theme-options", "contact_domacnosti");

	register_setting("contact_domacnosti", "map_contact_domacnosti");
  register_setting("contact_domacnosti", "address_contact_domacnosti");
  register_setting("contact_domacnosti", "email_contact_domacnosti");
  register_setting("contact_domacnosti", "phone_contact_domacnosti");
}
add_action("admin_init", "display_contact_domacnosti_fields");