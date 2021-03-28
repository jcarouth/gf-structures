<?php
/**
 * Object for registering a settings field.
 *
 * @see https://docs.gravityforms.com/category/developers/php-api/add-on-framework/settings-api/#field-properties
 * @package JMichaelWard\GF_Structures\Settings
 */

namespace JMichaelWard\GF_Structures\Settings;

use JMichaelWard\GF_Structures\Settings\Field\FieldInterface;

/**
 * Class Field
 *
 * @package JMichaelWard\GF_Structures\Settings
 */
class Field implements FieldInterface {
	/**
	 * The field type.
	 *
	 * Types native to Gravity Forms are:
	 * text, textarea, hidden, checkbox, radio, select, select_custom, field_map, dynamic_field_map, field_select,
	 * checkbox_and_select, and save.
	 *
	 * For custom fields, pass the type of the custom field, e.g., my_custom_field.
	 *
	 * @var string
	 */
	private $type;

	/**
	 * The type of HTML input type.
	 *
	 * Note: these apply only to `text` type fields, so not all HTML types are covered by this property.
	 *
	 * Examples: email, password, tel, number.
	 *
	 * @see Field::$type
	 * @see https://developer.mozilla.org/en-US/docs/Learn/Forms/HTML5_input_types
	 * @var string
	 */
	private $input_type;

	/**
	 * The name of the setting.
	 *
	 * Used as a key to the setting value in the feed meta array for feed add-ons.
	 *
	 * @see https://docs.gravityforms.com/gffeedaddon/
	 * @var string
	 */
	private $name;

	/**
	 * The ID attribute attribute of the HTML container element for this field.
	 *
	 * If left unset, the value from the $name property will be used instead.
	 *
	 * @see Field::$name
	 * @var string
	 */
	private $id;

	/**
	 * The field label.
	 *
	 * @var string
	 */
	private $label;

	/**
	 * Indication of whether the field must be filled out for settings to be submitted.
	 *
	 * Defaults to false.
	 *
	 * @var bool
	 */
	private $required = false;

	/**
	 * Value to append to the class attribute for the field input itself.
	 *
	 * Gravity Forms has three helper classes that can be used to control the size of the field generated:
	 * - small
	 * - medium
	 * - large
	 *
	 * You may, of course, set additional custom classes to target styling of this field.
	 *
	 * @var string
	 */
	private $class;

	/**
	 * Text content to render in a tooltip for this section.
	 *
	 * @var string
	 */
	private $tooltip;

	/**
	 * Value to append to the class attribute of the HTML container element for this field's tooltip.
	 *
	 * @var string
	 */
	private $tooltip_class;

	/**
	 * Whether to apply a "display: none;" property on the field's HTML element.
	 *
	 * Note: this differs from the `hidden` Field::$type. Using this property, any field type can be hidden within
	 * the settings.
	 *
	 * Defaults to false.
	 *
	 * @var bool
	 */
	private $hidden = false;

	/**
	 * Default value for any field, excluding the checkbox type.
	 *
	 * Automatically selects a radio or select option if a matching choice or label is found.
	 *
	 * @var string
	 */
	private $default_value;

	/**
	 * Whether to display choices side-by-side.
	 *
	 * Used only by checkbox or radio fields.
	 *
	 * @var bool
	 */
	private $horizontal = false;

	/**
	 * Rules for determining whether a section will display based on the values of a given field or fields.
	 *
	 * From the official Gravity Forms docs, these values could be a string or array, containing one of the following:
	 * - the name of a field, e.g., 'my-custom-text-field'
	 * - a callback function, e.g., array( $this, 'check_textfield_dependency' )
	 * - a field name with an array of values, e.g., array( 'field' => 'my-custom-text-field', 'values' => array( 'test', 'test2' ) )
	 *
	 * In this case, the dependency will be a Field object with rules that this class will use to generate the dependency.
	 *
	 * @var Field
	 */
	private $dependency;

	/**
	 * Array of choices.
	 *
	 * This value is required for radio, checkbox, and select field types.
	 *
	 * This library will incorporate the Choice object to provide an interface for registering choices.
	 *
	 * @see Choice
	 * @var array
	 */
	private $choices;

	/**
	 * Callback method that returns true or false to present field feedback in the UI.
	 *
	 * Possibles types are a string (a global method name) or an array (an object's callback).
	 * e.g., 'my_field_callback_method' or array( $this, 'field_callback_method' )
	 *
	 * @var string|array
	 */
	private $feedback_callback;

	/**
	 * Optionally specify a different function to create the HTML markup for the field.
	 *
	 * e.g., array( $this, 'my_replacement_function_for_displaying_field' );
	 *
	 * The GF_Field object in Gravity Forms uses its `get_field_input` method by default.
	 *
	 * @var string|array
	 */
	private $callback;

	/**
	 * Callback method that validates the field input and returns true or false.
	 *
	 * As with other callback properties, this can be a string or an array.
	 * e.g., 'my_validation_callback_method' or array( $this, 'my_validation_callback_method' )
	 *
	 * @var string|array
	 */
	private $validation_callback;

	/**
	 * Text content to render after the input.
	 *
	 * Note: official docs say "after the text field.", so this may not apply to all types.
	 *
	 * @var string
	 */
	private $after_input;

	/**
	 * An array of child fields that a user would map to form fields.
	 *
	 * Used only by field_map and dynamic_field_map types.
	 *
	 * This array will contain additional Field objects, and this library will process them accordingly.
	 *
	 * @see Field::$type
	 * @var array
	 */
	private $field_map;

	/**
	 * Additional HTML attributes to apply to the field.
	 *
	 * Primarily used for events, such as onclick and onchange. However, any attribute could be applied here,
	 * such as min/max for number inputs, maxlength, size, readonly, disabled, and so on.
	 *
	 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/Input#attributes
	 * @var array
	 */
	private $html_attributes;

	/**
	 * Field constructor.
	 *
	 * @param string $type The field type.
	 * @param string $name The field name.
	 */
	public function __construct( $type, $name ) {
		$this->type = $type;
		$this->name = $name;
	}

	/**
	 * @param string $input_type
	 */
	public function set_input_type( $input_type ) {
		$this->input_type = $input_type;

		return $this;
	}

	/**
	 * @param string $id
	 */
	public function set_id( $id ) {
		$this->id = $id;

		return $this;
	}

	/**
	 * @param string $label
	 */
	public function set_label( $label ) {
		$this->label = $label;

		return $this;
	}

	/**
	 * @param bool $required
	 */
	public function set_required( $required ) {
		$this->required = $required;

		return $this;
	}

	/**
	 * @param string $class
	 */
	public function set_class( $class ) {
		$this->class = $class;

		return $this;
	}

	/**
	 * @param string $tooltip
	 */
	public function set_tooltip( $tooltip ) {
		$this->tooltip = $tooltip;

		return $this;
	}

	/**
	 * @param string $tooltip_class
	 */
	public function set_tooltip_class( $tooltip_class ) {
		$this->tooltip_class = $tooltip_class;

		return $this;
	}

	/**
	 * @param bool $hidden
	 */
	public function set_hidden( $hidden ) {
		$this->hidden = $hidden;

		return $this;
	}

	/**
	 * @param string $default_value
	 */
	public function set_default_value( $default_value ) {
		$this->default_value = $default_value;

		return $this;
	}

	/**
	 * @param bool $horizontal
	 */
	public function set_horizontal( $horizontal ) {
		$this->horizontal = $horizontal;

		return $this;
	}

	/**
	 * @param Field $dependency
	 */
	public function set_dependency( $dependency ) {
		$this->dependency = $dependency;

		return $this;
	}

	/**
	 * @param array $choices
	 */
	public function set_choices( $choices ) {
		$this->choices = $choices;

		return $this;
	}

	/**
	 * @param array|string $feedback_callback
	 */
	public function set_feedback_callback( $feedback_callback ) {
		$this->feedback_callback = $feedback_callback;

		return $this;
	}

	/**
	 * @param array|string $callback
	 */
	public function set_callback( $callback ) {
		$this->callback = $callback;

		return $this;
	}

	/**
	 * @param array|string $validation_callback
	 */
	public function set_validation_callback( $validation_callback ) {
		$this->validation_callback = $validation_callback;

		return $this;
	}

	/**
	 * @param string $after_input
	 */
	public function set_after_input( $after_input ) {
		$this->after_input = $after_input;

		return $this;
	}

	/**
	 * @param array $field_map
	 */
	public function set_field_map( $field_map ) {
		$this->field_map = $field_map;

		return $this;
	}

	/**
	 * @param array $html_attributes
	 */
	public function set_html_attributes( $html_attributes ) {
		$this->html_attributes = $html_attributes;

		return $this;
	}

	/**
	 * Get the field values as an array formatted for Gravity Forms.
	 *
	 * @return array
	 */
	public function get_as_array() {
		return array_filter(
			array(
				'type'                => $this->type,
				'input_type'          => $this->input_type,
				'name'                => $this->name,
				'id'                  => $this->id,
				'label'               => $this->label,
				'required'            => $this->required,
				'class'               => $this->class,
				'tooltip'             => $this->tooltip,
				'tooltip_class'       => $this->tooltip_class,
				'hidden'              => $this->hidden,
				'default_value'       => $this->default_value,
				'horizontal'          => $this->horizontal,
				'dependency'          => $this->dependency,
				'choices'             => $this->choices,
				'feedback_callback'   => $this->feedback_callback,
				'callback'            => $this->callback,
				'validation_callback' => $this->validation_callback,
				'after_input'         => $this->after_input,
				'field_map'           => $this->field_map,
			)
		);
	}
}
