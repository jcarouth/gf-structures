<?php
/**
 * Object for rendering a settings section.
 *
 * @see     https://docs.gravityforms.com/category/developers/php-api/add-on-framework/settings-api/#creating-a-plugin-settings-page
 * @package JMichaelWard\GF_Structures\Settings
 */

namespace JMichaelWard\GF_Structures\Settings;

use JMichaelWard\GF_Structures\ArrayFormattable;
use JMichaelWard\GF_Structures\Settings\Section\SectionInterface;

/**
 * Class Section
 *
 * @package JMichaelWard\GF_Structures\Settings
 */
class Section implements SectionInterface {
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
	 * - a field name with an array of values, e.g.,
	 *      array( 'field' => 'my-custom-text-field', 'values' => array( 'test', 'test2' ) )
	 *
	 * In this case, the dependency will be a Field object with rules that this class will use to generate the
	 * dependency.
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
	private $fields = array();

	/**
	 * Set the section title.
	 *
	 * @param string $title
	 *
	 * @return Section
	 */
	public function set_title( $title ) {
		if ( ! is_string( $title ) ) {
			throw new \TypeError( __METHOD__ . ' parameter $title must be of type string.' );
		}

		$this->title = $title;

		return $this;
	}

	/**
	 * Set the section description.
	 *
	 * @param string $description
	 *
	 * @return Section
	 */
	public function set_description( $description ) {
		if ( ! is_string( $description ) ) {
			throw new \TypeError( __METHOD__ . ' parameter $description must be of type string.' );
		}

		$this->description = $description;

		return $this;
	}

	/**
	 * Set the section ID.
	 *
	 * @param string $id
	 *
	 * @return Section
	 */
	public function set_id( $id ) {
		if ( ! is_string( $id ) ) {
			throw new \TypeError( __METHOD__ . ' parameter $id must be of type string.' );
		}

		$this->id = $id;

		return $this;
	}

	/**
	 * Set the section class string.
	 *
	 * @param string $class
	 *
	 * @return Section
	 */
	public function set_class( $class ) {
		if ( ! is_string( $class ) ) {
			throw new \TypeError( __METHOD__ . ' parameter $class must be of type string.' );
		}

		$this->class = $class;

		return $this;
	}

	/**
	 * Set the section class style.
	 *
	 * @param string $style
	 *
	 * @return Section
	 */
	public function set_style( $style ) {
		if ( ! is_string( $style ) ) {
			throw new \TypeError( __METHOD__ . ' parameter $style must be of type string.' );
		}

		$this->style = $style;

		return $this;
	}

	/**
	 * Set an array of fields onto the section.
	 *
	 * This is provided as a convenience method for developers who wish to create their fields array and then
	 * pass it to the Section instead of calling add_field at each step.
	 *
	 * @param array $fields
	 */
	public function set_fields( array $fields ) {
		try {
			$this->fields = array();

			foreach ( $fields as $field ) {
				$this->add_field( $field );
			}
		} catch ( \TypeError $error ) {
			throw new \TypeError(
				__METHOD__ . ' parameter $fields contains elements not of type ' . __NAMESPACE__ . '\\Field.'
			);
		}

		return $this;
	}

	/**
	 * Add a field to the section.
	 *
	 * @param Field $field
	 *
	 * @return $this
	 */
	public function add_field( $field ) {
		if ( ! $field instanceof Field ) {
			throw new \TypeError( __METHOD__ . ' parameter $field must be instance of ' . __NAMESPACE__ . '\\Field.' );
		}

		$this->fields[] = $field;

		return $this;
	}

	/**
	 * Gets this settings section, formatted as an array expected by the Gravity Forms settings API.
	 *
	 * Filters out any values that are empty.
	 *
	 * @return array
	 */
	public function get_as_array() {
		return array_filter(
			array(
				'title'         => $this->title,
				'description'   => $this->description,
				'id'            => $this->id,
				'class'         => $this->class,
				'style'         => $this->style,
				'tooltip'       => $this->tooltip,
				'tooltip_class' => $this->tooltip_class,
				'dependency'    => $this->dependency,
				'fields'        => $this->get_fields_as_array(),
			)
		);
	}

	/**
	 * Get all of the fields, formatted as an array.
	 *
	 * @return array
	 */
	private function get_fields_as_array() {
		return array_map( function( ArrayFormattable $field ) {
			return $field->get_as_array();
		}, $this->fields );
	}
}
