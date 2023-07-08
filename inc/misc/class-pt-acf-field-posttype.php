<?php
/**
 * Defines the custom field type class.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * PREFIX_acf_field_FIELD_NAME class.
 */
class pt_acf_field_posttype extends \acf_field {
	/**
	 * Controls field type visibilty in REST requests.
	 *
	 * @var bool
	 */
	public $show_in_rest = true;

	/**
	 * Environment values relating to the theme or plugin.
	 *
	 * @var array $env Plugin or theme context such as 'url' and 'version'.
	 */
	private $env;

	/**
	 * Constructor.
	 */
	public function __construct() {
		/**
		 * Field type reference used in PHP and JS code.
		 *
		 * No spaces. Underscores allowed.
		 */
		$this->name = 'post_type';

		/**
		 * Field type label.
		 *
		 * For public-facing UI. May contain spaces.
		 */
		$this->label = __( 'Select Post Type', 'nsm' );

		/**
		 * The category the field appears within in the field type picker.
		 */
		$this->category = 'choise'; // basic | content | choice | relational | jquery | layout | CUSTOM GROUP NAME

		/**
		 * Defaults for your custom user-facing settings for this field type.
		 */
		$this->defaults = array(
			'select_post_type'	=> '0',
		);

		

		$this->env = array(
			'url'     => site_url( str_replace( ABSPATH, '', __DIR__ ) ), // URL to the acf-FIELD-NAME directory.
			'version' => '1.0', // Replace this with your theme or plugin version constant.
		);

		parent::__construct();
	}

	/**
	 * Settings to display when users configure a field of this type.
	 *
	 * These settings appear on the ACF “Edit Field Group” admin page when
	 * setting up the field.
	 *
	 * @param array $field
	 * @return void
	 */
	public function render_field_settings( $field ) {
		/*
		 * Repeat for each setting you wish to display for this field type.
		 */
		acf_render_field_setting(
			$field,
			array(
				'label'			=> __( 'Select Post Types','nsm' ),
				'instructions'	=> __( 'select multiple post types','nsm' ),
				'type'			=> 'select',
				'name'			=> 'select_post_type',
                'ui'            =>  1,
				'choices' => array(
                    0 => __( 'Checkboxes' ),
                    1 => __( 'Radio' ),
                    2 => __( 'Select' ),
                )
			)
		);

		// To render field settings on other tabs in ACF 6.0+:
		// https://www.advancedcustomfields.com/resources/adding-custom-settings-fields/#moving-field-setting
	}

	/**
	 * HTML content to show when a publisher edits the field on the edit screen.
	 *
	 * @param array $field The field settings and values.
	 * @return void
	 */
	public function render_field( $field ) {
		// defaults?
		$field = array_merge( $this->defaults, $field );

		//$post_types = acf_get_pretty_post_types();
        $post_types = get_post_types(array('public'=>true));
        unset($post_types['attachment']);
		/**
		 * Filters the array of post types.
		 *
		 * @since 1.0.1
		 *
		 * @param array $post_types List of post types.
		 * @param array $field      The field being rendered.
		 */
		$post_types = apply_filters( 'post_type_selector_post_types', $post_types, $field );

		// create Field HTML
		$checked = array( );

		switch ( $field[ 'select_post_type' ] ) {

			case 0:
                
				echo '<ul class="checkbox_list checkbox">';

 				if ( ! empty( $field[ 'value'] ) && $field[ 'value'] != null ) {

					foreach(  $field[ 'value' ] as $val ) {

						$checked[ $val ] = 'checked="checked"';

					}

				}

				foreach( $post_types as $post_type => $post_type_label ) {

				?>

					<li><label><input type="checkbox" <?php echo ( isset( $checked[ $post_type ] ) ) ? $checked[ $post_type] : null; ?> class="<?php echo $field[ 'class' ]; ?>" name="<?php echo $field[ 'name' ]; ?>[]" value="<?php echo $post_type; ?>"><?php echo $post_type_label; ?></label></li>
				<?php

				}

				echo '</ul>';

			break;

			case 1:

				echo '<ul class="radio_list radio horizontal">';

				$checked[ $field[ 'value' ] ] = 'checked="checked"';

				foreach( $post_types as $post_type => $post_type_label ) {

				?>

					<li><label><input type="radio" <?php echo ( isset( $checked[ $post_type ] ) ) ? $checked[ $post_type] : null; ?> class="<?php echo $field[ 'class' ]; ?>" name="<?php echo $field[ 'name' ]; ?>" value="<?php echo $post_type; ?>"> <?php echo $post_type_label; ?></label></li>

				<?php

				}

				echo '</ul>';


			break;

			case 2:

                echo '<select id="' . $field[ 'name' ] . '" class="' . $field[ 'class' ] . '" name="' . $field[ 'name' ] . '">';

				$checked[ $field[ 'value' ] ] = 'selected="selected"';

				foreach( $post_types as $post_type => $post_type_label ) {
					echo '<option ' . (isset($checked[ $post_type ]) ? $checked [ $post_type ] : null) . ' value="' . $post_type . '">' . $post_type_label . '</option>';
				}

				echo '</select>';

			break;

		}
	}

	/**
	 * Enqueues CSS and JavaScript needed by HTML in the render_field() method.
	 *
	 * Callback for admin_enqueue_script.
	 *
	 * @return void
	 */
	public function input_admin_enqueue_scripts() {
		$url     = trailingslashit( $this->env['url'] );
		$version = $this->env['version'];

		wp_register_script(
			'pt-posttype',
			"{$url}assets/js/field.js",
			array( 'acf-input' ),
			$version
		);

		wp_register_style(
			'pt-posttype',
			"{$url}assets/css/field.css",
			array( 'acf-input' ),
			$version
		);

		wp_enqueue_script( 'pt-posttype' );
		wp_enqueue_style( 'pt-posttype' );
	}
}