<?php
/**
 * UserRegistrationAdvancedFields Admin.
 *
 * @class    UR_Form_Field_Phone
 * @version  1.0.0
 * @package  UserRegistrationAdvancedFields/Form
 * @category Admin
 * @author   WPEverest
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * UR_Form_Field_Phone Class
 */
class UR_Form_Field_Phone extends UR_Form_Field {

	/**
	 * Instance of this class.
	 *
	 * @var object
	 */
	private static $_instance;

	/**
	 * Get Instance of this class.
	 */
	public static function get_instance() {
		// If the single instance hasn't been set, set it now.
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Hook in tabs.
	 */
	public function __construct() {

		$this->id = 'user_registration_phone';

		$this->form_id = 1;

		$this->registered_fields_config = array(

			'label' => __( 'Phone', 'user-registration-advanced-fields' ),

			'icon'  => 'ur-icon ur-icon-phone',
		);
		$this->field_defaults           = array(

			'default_label'        => __( 'Phone', 'user-registration-advanced-fields' ),

			'default_field_name'   => 'phone_' . ur_get_random_number(),

			'default_input_mask'   => '(999) 999-9999',

			'default_phone_format' => 'default',

		);
		add_filter( "{$this->id}_advance_class", array( $this, 'settings_override' ), 10, 1 );
	}

	/**
	 * Settigns Override
	 *
	 * @param mixed $file_path_override file path.
	 */
	public function settings_override( $file_path_override ) {
		$file_path_override['file_path'] = URAF_ABSPATH . 'includes' . UR_DS . 'form' . UR_DS . 'settings' . UR_DS . 'class-ur-setting-phone.php';
		return $file_path_override;
	}

	/**
	 * Get registered admin fields
	 */
	public function get_registered_admin_fields() {

		return '<li id="' . $this->id . '_list "

				class="ur-registered-item draggable"

                data-field-id="' . $this->id . '"><span class="' . $this->registered_fields_config['icon'] . '"></span>' . $this->registered_fields_config['label'] . '</li>';
	}

	/**
	 * Validate Phone field.
	 *
	 * @param mixed $single_form_field Single form field.
	 * @param mixed $form_data Form Data.
	 * @param mixed $filter_hook Filter hook.
	 * @param int   $form_id Form id.
	 */
	public function validation( $single_form_field, $form_data, $filter_hook, $form_id ) {

		$field_label = $single_form_field->general_setting->label;
		$value       = isset( $form_data->value ) ? $form_data->value : '';

		// Mask Validation.
		$mask         = $single_form_field->general_setting->input_mask;
		$phone_format = $single_form_field->general_setting->phone_format;

		if ( ! empty( $mask ) && ! empty( $value ) && 'smart' !== $phone_format ) {

			$required = isset( $single_form_field->general_setting->required ) ?
			'yes' === $single_form_field->general_setting->required :
			false;

			// CASE: Field not filled by user and mask is submitted as field value.
			if ( str_replace( '9', '_', $mask ) === $value ) {
				if ( $required ) {
					add_filter(
						$filter_hook,
						function ( $msg ) use ( $field_label ) {
							/* translators: %1$s - Field Label */
							return sprintf( __( '%1$s is a required field.', 'user-registration' ), "<strong>$field_label</strong>" );
						}
					);
					return;
				} else {
					return;
				}
			}

			// Match the value against the predefined mask.
			$mask_regex = str_replace(
				array( '9', '(', ')', '+' ),
				array( '\d', '\(', '\)', '\+' ),
				$mask
			);
			$mask_regex = '/^' . $mask_regex . '$/';

			if ( 0 === preg_match( $mask_regex, $value ) ) {
				add_filter(
					$filter_hook,
					function ( $msg ) use ( $field_label ) {
						/* translators: %1$s - Field Label */
						return sprintf( __( 'Please provide a valid value for %1$s', 'user-registration-advanced-fields' ), "<strong>$field_label</strong>." );
					}
				);
			}
		}
	}
}

return UR_Form_Field_Phone::get_instance();
