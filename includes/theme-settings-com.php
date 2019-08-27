<?php
// Create Theme settings page "Firmy"
function theme_firmy_menu_item() {
	add_submenu_page(
    'edit.php?post_type=firmy',
    __('Nastavení', 'zonerantivirus'), 
    __('Nastavení', 'zonerantivirus'), 
    "manage_options", 
    "com-theme-settings", 
    "theme_firmy_page"
  );
}
add_action("admin_menu", "theme_firmy_menu_item");

function theme_firmy_page() { 
	?>
	<div class="wrap">
    <?php settings_errors(); ?>
    <h1 class="dashicons-before dashicons-admin-generic"> <?php echo __("Firmy", "zonerantivirus"); ?></h1>
    <p class="info"><?php echo __("Každá sekce se ukládá zvlášť. Pro uložení inputu klikněte na tlačítko pod daným formulářem, jinak změna nebude respektována.", "zonerantivirus"); ?></p>

    <?php  
      $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'header-options';  
    ?>  

    <h2 class="nav-tab-wrapper">  
      <a href="?post_type=firmy&page=com-theme-settings&tab=header-options" class="nav-tab <?php echo $active_tab == 'header-options' ? 'nav-tab-active' : ''; ?>"><?php echo __("Záhlaví", "zonerantivirus"); ?></a>  
      <a href="?post_type=firmy&page=com-theme-settings&tab=url-options" class="nav-tab <?php echo $active_tab == 'url-options' ? 'nav-tab-active' : ''; ?>"><?php echo __("URL ke stažení", "zonerantivirus"); ?></a>
      <a href="?post_type=firmy&page=com-theme-settings&tab=images-options" class="nav-tab <?php echo $active_tab == 'images-options' ? 'nav-tab-active' : ''; ?>"><?php echo __("Ilustrační obrázky", "zonerantivirus"); ?></a>
      <a href="?post_type=firmy&page=com-theme-settings&tab=pricelist-options" class="nav-tab <?php echo $active_tab == 'pricelist-options' ? 'nav-tab-active' : ''; ?>"><?php echo __("Ceník", "zonerantivirus"); ?></a>  
    </h2>  

    <form id="firmy" method="post" action="options.php">
      <?php
      if ($active_tab == 'header-options') {
        settings_fields("firmy_domacnosti");
        do_settings_sections("header-firmy-theme-options");
      } else if ($active_tab == 'url-options') {
                    
      } else if ($active_tab == 'images-options') {
                    
      } else if ($active_tab == 'pricelist-options') {
                    
      }
      submit_button(); 
      ?>          
    </form>
    <br>
  </div>
<?php
}

// Create fields for Theme settings page "Firmy" [header_firmy]
function display_before_headline_header_firmy() {
	?>
    <input type="text" size="100" name="before_headline_header_firmy" id="before_headline_header_firmy" value="<?php echo get_option('before_headline_header_firmy'); ?>" />
  <?php
}
function display_headline_header_firmy() {
	?>
    <input type="text" size="100" name="headline_header_firmy" id="headline_header_firmy" value="<?php echo get_option('headline_header_firmy'); ?>" />
  <?php
}
function display_description_header_firmy() {
	?>
    <textarea cols="100" rows="4" name="description_header_firmy" id="description_header_firmy"><?php echo get_option('description_header_firmy'); ?></textarea>
  <?php
}
function display_header_firmy_fields() {
	add_settings_section("header_firmy", null, "header_firmy_theme_callback", "header-firmy-theme-options");
	
	add_settings_field("before_headline_header_firmy", __('Před nadpisem', 'zonerantivirus'), "display_before_headline_header_firmy", "header-firmy-theme-options", "header_firmy");
	add_settings_field("headline_header_firmy", __('Nadpis H1', 'zonerantivirus'), "display_headline_header_firmy", "header-firmy-theme-options", "header_firmy");
	add_settings_field("description_header_firmy", __('Text pod nadpisem', 'zonerantivirus'), "display_description_header_firmy", "header-firmy-theme-options", "header_firmy");

  register_setting("header_firmy", "before_headline_header_firmy");
	register_setting("header_firmy", "headline_header_firmy");
	register_setting("header_firmy", "description_header_firmy");
}
add_action("admin_init", "display_header_firmy_fields");