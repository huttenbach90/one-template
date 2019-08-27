<?php
add_action('add_meta_boxes', 'expiry_date_box');
function expiry_date_box() {
	add_meta_box('expiry_date', __("Datum akce", "oneindustry"), 'display_expiry_date', __('kalendar', 'oneindustry'), 'side', 'high');
}
function display_expiry_date($expiry) { ?>
<script type="text/javascript" src="<?php echo get_template_directory_uri() . '/assets/js/daterangepicker.js'; ?>"></script>
<link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/assets/css/daterangepicker.css'; ?>">
<script>
$(document).ready(function() {

   function cb() {
	   $('#datepicker2').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
   }
   $("#datepicker2").daterangepicker({
	   opens: "left",
	   locale: {
		   format: 'DD. M. YYYY',
	   }
	}).bind("change",function() {
		var start = $("#datepicker2").data("daterangepicker").startDate.format("D.M.YYYY");
		var startday = $("#datepicker2").data("daterangepicker").startDate.format("D.");
		var enddate = $("#datepicker2").data("daterangepicker").endDate.format("D.M.YYYY");
		var startdate = $("#datepicker2").data("daterangepicker").startDate.format("YYYYMMDD");
		var ende = $("#datepicker2").data("daterangepicker").endDate.format("YYYYMMDD");
		$("#start").val(start);
		$("#startday").val(startday);
		$("#altexpiry").val(ende);
		$("#startdate").val(startdate);
		$("#end").val(enddate);
	});

});
</script>

		<input type="text" name="meta[end_date]" id="datepicker2" value="<?php echo get_post_meta($expiry->ID, 'end_date', true); ?>"/>
		<input type="hidden" name="meta[start_date]" id="start" value="<?php echo get_post_meta($expiry->ID, 'start_date', true); ?>"/>
		<input type="hidden" name="meta[start_day]" id="startday" value="<?php echo get_post_meta($expiry->ID, 'start_day', true); ?>" />
		<input type="hidden" name="meta[end]" id="end" value="<?php echo get_post_meta($expiry->ID, 'end', true); ?>" />
		<input type="hidden" name="meta[startdate]" id="startdate" value="<?php echo get_post_meta($expiry->ID, 'startdate', true); ?>" />
    <input type="hidden" id="altexpiry" name="meta[altexpiry]" value="<?php echo get_post_meta($expiry->ID, 'altexpiry', true); ?>"/>
<?php
  }

add_action( 'save_post', 'add_expiry_fields', 10, 2 );
function add_expiry_fields( $expiry_id, $expiry ) {
   if ( $expiry->post_type == 'kalendar' ) {
	   if ( isset( $_POST['meta'] ) ) {
		   foreach( $_POST['meta'] as $key => $value ){
			   update_post_meta( $expiry_id, $key, $value );
		   }
	   }
   }
}

class veslideruMetabox {
	private $screen = array(
		'post',
	);
	private $meta_fields = array(
		array(
			'label' => 'Obrázek slideru',
			'id' => 'obrzekslideru_26971',
			'type' => 'media',
		),
	);
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'admin_footer', array( $this, 'media_fields' ) );
		add_action( 'save_post', array( $this, 'save_fields' ) );
	}
	public function add_meta_boxes() {
		foreach ( $this->screen as $single_screen ) {
			add_meta_box(
				'veslideru',
				__( 'Obrázek ve slideru', 'oneindustry' ),
				array( $this, 'meta_box_callback' ),
				$single_screen,
				'side',
				'default'
			);
		}
	}
	public function meta_box_callback( $post ) {
		wp_nonce_field( 'veslideru_data', 'veslideru_nonce' );
		echo 'Pokud není vybrán, příspěvek se v slideru nezobrazí. Doporučený rozměr: 550x780px';
		$this->field_generator( $post );
	}
	public function media_fields() {
		?><script>
			jQuery(document).ready(function($){
				if ( typeof wp.media !== 'undefined' ) {
					var _custom_media = true,
					_orig_send_attachment = wp.media.editor.send.attachment;
					$('.veslideru-media').click(function(e) {
						var send_attachment_bkp = wp.media.editor.send.attachment;
						var button = $(this);
						var id = button.attr('id').replace('_button', '');
						_custom_media = true;
							wp.media.editor.send.attachment = function(props, attachment){
							if ( _custom_media ) {
								$('input#'+id).val(attachment.url);
							} else {
								return _orig_send_attachment.apply( this, [props, attachment] );
							};
						}
						wp.media.editor.open(button);
						return false;
					});
					$('.add_media').on('click', function(){
						_custom_media = false;
					});
				}
			});
		</script><?php
	}
	public function field_generator( $post ) {
		$output = '';
		foreach ( $this->meta_fields as $meta_field ) {
			$label = '<label for="' . $meta_field['id'] . '">' . $meta_field['label'] . '</label>';
			$meta_value = get_post_meta( $post->ID, $meta_field['id'], true );
			if ( empty( $meta_value ) ) {
				$meta_value = $meta_field['default']; }
			switch ( $meta_field['type'] ) {
				case 'media':
					$input = sprintf(
						'<input style="width: 100%%" id="%s" name="%s" type="text" value="%s"> <input style="width: 100%%" class="button veslideru-media" id="%s_button" name="%s_button" type="button" value="Vybrat" />',
						$meta_field['id'],
						$meta_field['id'],
						$meta_value,
						$meta_field['id'],
						$meta_field['id']
					);
					break;
				default:
					$input = sprintf(
						'<input %s id="%s" name="%s" type="%s" value="%s">',
						$meta_field['type'] !== 'color' ? 'style="width: 100%"' : '',
						$meta_field['id'],
						$meta_field['id'],
						$meta_field['type'],
						$meta_value
					);
			}
			$output .= $this->format_rows( $label, $input );
		}
		echo '<table class="form-table"><tbody>' . $output . '</tbody></table>';
	}
	public function format_rows( $label, $input ) {
		return '<tr><td>'.$input.'</td></tr>';
	}
	public function save_fields( $post_id ) {
		if ( ! isset( $_POST['veslideru_nonce'] ) )
			return $post_id;
		$nonce = $_POST['veslideru_nonce'];
		if ( !wp_verify_nonce( $nonce, 'veslideru_data' ) )
			return $post_id;
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;
		foreach ( $this->meta_fields as $meta_field ) {
			if ( isset( $_POST[ $meta_field['id'] ] ) ) {
				switch ( $meta_field['type'] ) {
					case 'email':
						$_POST[ $meta_field['id'] ] = sanitize_email( $_POST[ $meta_field['id'] ] );
						break;
					case 'text':
						$_POST[ $meta_field['id'] ] = sanitize_text_field( $_POST[ $meta_field['id'] ] );
						break;
				}
				update_post_meta( $post_id, $meta_field['id'], $_POST[ $meta_field['id'] ] );
			} else if ( $meta_field['type'] === 'checkbox' ) {
				update_post_meta( $post_id, $meta_field['id'], '0' );
			}
		}
	}
}
if (class_exists('veslideruMetabox')) {
	new veslideruMetabox;
};

class urlMetabox {
	private $screen = array(
		'post',
		'kalendar',
	);
	private $meta_fields = array(
		array(
			'label' => 'URL příspěvku',
			'id' => 'urlpspvku_23425',
			'type' => 'url',
		),
	);
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_fields' ) );
	}
	public function add_meta_boxes() {
		foreach ( $this->screen as $single_screen ) {
			add_meta_box(
				'url',
				__( 'Broadcast URL na hlavním webu', 'oneindustry' ),
				array( $this, 'meta_box_callback' ),
				$single_screen,
				'advanced',
				'high'
			);
		}
	}
	public function meta_box_callback( $post ) {
		wp_nonce_field( 'url_data', 'url_nonce' );
		$this->field_generator( $post );
	}
	public function field_generator( $post ) {
		$output = '';
		foreach ( $this->meta_fields as $meta_field ) {
			$label = '<label for="' . $meta_field['id'] . '">' . $meta_field['label'] . '</label>';
			$meta_value = get_post_meta( $post->ID, $meta_field['id'], true );
			if ( empty( $meta_value ) ) {
				$meta_value = $meta_field['default']; }
			switch ( $meta_field['type'] ) {
				default:
					$input = sprintf(
						'<input %s id="%s" name="%s" type="%s" value="%s">',
						$meta_field['type'] !== 'color' ? 'style="width: 100%"' : '',
						$meta_field['id'],
						$meta_field['id'],
						$meta_field['type'],
						$meta_value
					);
			}
			$output .= $this->format_rows( $label, $input );
		}
		echo '<table class="form-table"><tbody>' . $output . '</tbody></table>';
	}
	public function format_rows( $label, $input ) {
		return '<tr><th>'.$label.'</th><td>'.$input.'</td></tr>';
	}
	public function save_fields( $post_id ) {
		if ( ! isset( $_POST['url_nonce'] ) )
			return $post_id;
		$nonce = $_POST['url_nonce'];
		if ( !wp_verify_nonce( $nonce, 'url_data' ) )
			return $post_id;
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;
		foreach ( $this->meta_fields as $meta_field ) {
			if ( isset( $_POST[ $meta_field['id'] ] ) ) {
				switch ( $meta_field['type'] ) {
					case 'email':
						$_POST[ $meta_field['id'] ] = sanitize_email( $_POST[ $meta_field['id'] ] );
						break;
					case 'text':
						$_POST[ $meta_field['id'] ] = sanitize_text_field( $_POST[ $meta_field['id'] ] );
						break;
				}
				update_post_meta( $post_id, $meta_field['id'], $_POST[ $meta_field['id'] ] );
			} else if ( $meta_field['type'] === 'checkbox' ) {
				update_post_meta( $post_id, $meta_field['id'], '0' );
			}
		}
	}
}
if (class_exists('urlMetabox')) {
	new urlMetabox;
};


class nahledovyobrazekMetabox {
	private $screen = array(
		'post',
		'page',
	);
	private $meta_fields = array(
		array(
			'label' => 'Nahledovy obrazek',
			'id' => 'nahledovyobrazek',
			'type' => 'media',
		),
	);
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'admin_footer', array( $this, 'media_fields' ) );
		add_action( 'save_post', array( $this, 'save_fields' ) );
	}
	public function add_meta_boxes() {
		foreach ( $this->screen as $single_screen ) {
			add_meta_box(
				'nahledovyobrazek',
				__( 'Náhledový obrázek (!)', 'oneindustry' ),
				array( $this, 'meta_box_callback' ),
				$single_screen,
				'side',
				'low'
			);
		}
	}
	public function meta_box_callback( $post ) {
		wp_nonce_field( 'nahledovyobrazek_data', 'nahledovyobrazek_nonce' );
		echo 'Zde nastavte náhledový obrázek. Jestliže příspěvek vznikl před datem 23.8.2018, zobrazte si nativní Náhledový obrázek WP';
		$this->field_generator( $post );
	}
	public function media_fields() {
		?><script>
			jQuery(document).ready(function($){
				if ( typeof wp.media !== 'undefined' ) {
					var _custom_media = true,
					_orig_send_attachment = wp.media.editor.send.attachment;
					$('.nahledovyobrazek-media').click(function(e) {
						var send_attachment_bkp = wp.media.editor.send.attachment;
						var button = $(this);
						var id = button.attr('id').replace('_button', '');
						_custom_media = true;
							wp.media.editor.send.attachment = function(props, attachment){
							if ( _custom_media ) {
								$('input#'+id).val(attachment.url);
							} else {
								return _orig_send_attachment.apply( this, [props, attachment] );
							};
						}
						wp.media.editor.open(button);
						return false;
					});
					$('.add_media').on('click', function(){
						_custom_media = false;
					});
				}
			});
		</script><?php
	}
	public function field_generator( $post ) {
		$output = '';
		foreach ( $this->meta_fields as $meta_field ) {
			$label = '<label for="' . $meta_field['id'] . '">' . $meta_field['label'] . '</label>';
			$meta_value = get_post_meta( $post->ID, $meta_field['id'], true );
			if ( empty( $meta_value ) ) {
				$meta_value = $meta_field['default']; }
			switch ( $meta_field['type'] ) {
				case 'media':
					$input = sprintf(
						'<input style="width: 100%%" id="%s" name="%s" type="text" value="%s"> <input style="width: 100%%" class="button nahledovyobrazek-media" id="%s_button" name="%s_button" type="button" value="Vybrat" />',
						$meta_field['id'],
						$meta_field['id'],
						$meta_value,
						$meta_field['id'],
						$meta_field['id']
					);
					break;
				default:
					$input = sprintf(
						'<input %s id="%s" name="%s" type="%s" value="%s">',
						$meta_field['type'] !== 'color' ? 'style="width: 100%"' : '',
						$meta_field['id'],
						$meta_field['id'],
						$meta_field['type'],
						$meta_value
					);
			}
			$output .= $this->format_rows( $label, $input );
		}
		echo '<table class="form-table"><tbody>' . $output . '</tbody></table>';
	}
	public function format_rows( $label, $input ) {
		return '<tr><td>'.$input.'</td></tr>';
	}
	public function save_fields( $post_id ) {
		if ( ! isset( $_POST['nahledovyobrazek_nonce'] ) )
			return $post_id;
		$nonce = $_POST['nahledovyobrazek_nonce'];
		if ( !wp_verify_nonce( $nonce, 'nahledovyobrazek_data' ) )
			return $post_id;
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;
		foreach ( $this->meta_fields as $meta_field ) {
			if ( isset( $_POST[ $meta_field['id'] ] ) ) {
				switch ( $meta_field['type'] ) {
					case 'email':
						$_POST[ $meta_field['id'] ] = sanitize_email( $_POST[ $meta_field['id'] ] );
						break;
					case 'text':
						$_POST[ $meta_field['id'] ] = sanitize_text_field( $_POST[ $meta_field['id'] ] );
						break;
				}
				update_post_meta( $post_id, $meta_field['id'], $_POST[ $meta_field['id'] ] );
			} else if ( $meta_field['type'] === 'checkbox' ) {
				update_post_meta( $post_id, $meta_field['id'], '0' );
			}
		}
	}
}
if (class_exists('nahledovyobrazekMetabox')) {
	new nahledovyobrazekMetabox;
};