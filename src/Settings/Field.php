<?php
/**
 * Object for registering a settings field.
 *
 * @see https://docs.gravityforms.com/category/developers/php-api/add-on-framework/settings-api/#field-properties
 * @package JMichaelWard\GF_Structures\Settings
 */

namespace JMichaelWard\GF_Structures\Settings;

/**
 * Class Field
 *
 * @package JMichaelWard\GF_Structures\Settings
 */
class Field {
	/**
	 * @var string
	 */
	private $type;

	/**
	 * @var string
	 */
	private $input_type;

	/**
	 * @var string
	 */
	private $name;

	/**
	 * @var string
	 */
	private $id;

	/**
	 * @var string
	 */
	private $label;

	/**
	 * @var bool
	 */
	private $required;

	/**
	 * @var string
	 */
	private $class;

	/**
	 * @var string
	 */
	private $tooltip;

	/**
	 * @var string
	 */
	private $tooltip_class;

	/**
	 * @var bool
	 */
	private $hidden;

	/**
	 * @var string
	 */
	private $default_value;

	/**
	 * @var bool
	 */
	private $horizontal;

	/**
	 * @var string|array
	 */
	private $dependency;

	/**
	 * @var array
	 */
	private $choices;

	/**
	 * @var string|array
	 */
	private $feedback_callback;

	/**
	 * @var array
	 */
	private $callback;

	/**
	 * @var string|array
	 */
	private $validation_callback;

	/**
	 * @var string
	 */
	private $after_input;

	/**
	 * @var array
	 */
	private $field_map;

	/**
	 * @var array
	 */
	private $html_attributes;
}
