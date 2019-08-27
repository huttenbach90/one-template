<?php
  // Register Kalendář Post Type
  function calendar_post_type() {
    $labels = array(
      'name'                  => _x( 'Kalendář', 'Post Type General Name', 'oneindustry' ),
      'singular_name'         => _x( 'Kalendář', 'Post Type Singular Name', 'oneindustry' ),
      'menu_name'             => __( 'Kalendář', 'oneindustry' ),
      'name_admin_bar'        => __( 'Kalendář', 'oneindustry' ),
      'archives'              => __( 'Archiv', 'oneindustry' ),
      'attributes'            => __( 'Vlastnosti', 'oneindustry' ),
      'parent_item_colon'     => __( 'Nadřazený:', 'oneindustry' ),
      'all_items'             => __( 'Vše', 'oneindustry' ),
      'add_new_item'          => __( 'Přidat', 'oneindustry' ),
      'add_new'               => __( 'Přidat', 'oneindustry' ),
      'new_item'              => __( 'Nový', 'oneindustry' ),
      'edit_item'             => __( 'Editovat', 'oneindustry' ),
      'update_item'           => __( 'Aktualizovat', 'oneindustry' ),
      'view_item'             => __( 'Zobrazit', 'oneindustry' ),
      'view_items'            => __( 'Zobrazit', 'oneindustry' ),
      'search_items'          => __( 'Hledat', 'oneindustry' ),
      'not_found'             => __( 'Nenalezeno', 'oneindustry' ),
      'not_found_in_trash'    => __( 'Nenalezeno', 'oneindustry' ),
      'featured_image'        => __( 'Náhledový obrázek', 'oneindustry' ),
      'set_featured_image'    => __( 'Nastavit náhledový obrázek', 'oneindustry' ),
      'remove_featured_image' => __( 'Smazat náhledový obrázek', 'oneindustry' ),
      'use_featured_image'    => __( 'Použít jako náhledový obrázek', 'oneindustry' ),
      'insert_into_item'      => __( 'Vložit', 'oneindustry' ),
      'uploaded_to_this_item' => __( 'Vloženo', 'oneindustry' ),
      'items_list'            => __( 'Seznam', 'oneindustry' ),
      'items_list_navigation' => __( 'Navigace seznamu', 'oneindustry' ),
      'filter_items_list'     => __( 'Filtrovat seznam', 'oneindustry' ),
    );
    $args = array(
      'label'                 => __( 'Kalendář', 'oneindustry' ),
      'labels'                => $labels,
      'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions' ),
      'hierarchical'          => false,
      'public'                => true,
      'show_ui'               => true,
      'show_in_menu'          => true,
      'menu_position'         => 11,
      'menu_icon'             => 'dashicons-calendar-alt',
      'show_in_admin_bar'     => true,
      'show_in_nav_menus'     => true,
      'can_export'            => true,
      'has_archive'           => true,		
      'exclude_from_search'   => false,
      'publicly_queryable'    => true,
      'capability_type'       => 'page',
    );
    register_post_type( __('kalendar', 'oneindustry'), $args );
  }
  add_action( 'init', 'calendar_post_type', 0 );


// Register Custom Taxonomy
function custom_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Štítky', 'Taxonomy General Name', 'oneindustry' ),
		'singular_name'              => _x( 'Štítek', 'Taxonomy Singular Name', 'oneindustry' ),
		'menu_name'                  => __( 'Štítky', 'oneindustry' ),
		'all_items'                  => __( 'Vše', 'oneindustry' ),
		'new_item_name'              => __( 'Nový', 'oneindustry' ),
		'add_new_item'               => __( 'Přidat', 'oneindustry' ),
		'edit_item'                  => __( 'Editovat', 'oneindustry' ),
		'update_item'                => __( 'Aktualizovat', 'oneindustry' ),
		'view_item'                  => __( 'Zobrazit', 'oneindustry' ),
		'separate_items_with_commas' => __( 'Štítky oddělujte čárkou', 'oneindustry' ),
		'add_or_remove_items'        => __( 'Přidat nebo odstranit štítek', 'oneindustry' ),
		'choose_from_most_used'      => __( 'Vyberte z nejpoužívanějších štítků', 'oneindustry' ),
		'popular_items'              => __( 'Oblíbené štítky', 'oneindustry' ),
		'search_items'               => __( 'Hledat', 'oneindustry' ),
		'not_found'                  => __( 'Nenalezeno', 'oneindustry' ),
		'no_terms'                   => __( 'Nic', 'oneindustry' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
  register_taxonomy( 'tag', 'kalendar', $args );

}
add_action( 'init', 'custom_taxonomy', 0 );