<?php
/**
 * Object for rendering a settings section.
 *
 * @see https://docs.gravityforms.com/category/developers/php-api/add-on-framework/settings-api/#creating-a-plugin-settings-page
 * @package JMichaelWard\GF_Structures\Settings
 */

namespace JMichaelWard\GF_Structures\Settings;

/**
 * Class Section
 *
 * @package JMichaelWard\GF_Structures\Settings
 */
class Section {
	/**
	 * The section title.
	 *
	 * @var string
	 */
	private $title;

	/**
	 * The section description.
	 *
	 * @var string
	 */
	private $description;

	/**
	 * The ID attribute of the HTML container element for this section.
	 *
	 * @var string
	 */
	private $id;

	/**
	 * Value to append to the class attribute of the HTML container element for this section.
	 *
	 * @var string
	 */
	private $class;

	/**
	 * Value to append tot he style attribute of the HTML container element for this section.
	 *
	 * @var string
	 */
	private $style;

	/**
	 * Text content to render in a tooltip for this section.
	 *
	 * @var string
	 */
	private $tooltip;

	/**
	 * Value to append to the class attribute of the HTML container element for this section's tooltip.
	 *
	 * @var string
	 */
	private $tooltip_class;

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
	 * Array of section fields.
	 *
	 * Gravity Forms requires an associative array of field configurations to define this. This class will take a set
	 * of Field objects and convert those values to Gravity Forms's requirements.
	 *
	 * @see Field
	 * @var array
	 */
	private $fields;
}
