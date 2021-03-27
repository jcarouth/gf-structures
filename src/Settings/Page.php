<?php
/**
 * Object for formatting a custom settings page for Gravity Forms.
 */

namespace JMichaelWard\GF_Structures\Settings;

use JMichaelWard\GF_Structures\ArrayFormattable;

/**
 * Class Page
 *
 * @package JMichaelWard\GF_Structures\Settings
 */
class Page implements ArrayFormattable {
	/**
	 * Array of Section objects.
	 *
	 * @var array
	 */
	private $sections = array();

	/**
	 * Page constructor.
	 *
	 * The constructor accepts an optional array of sections, so that developers can either create their collection
	 * of sections first and pass it to this object, or individually add sections using the add_section method as
	 * they go.
	 *
	 * @param array $sections Optional array of sections.
	 */
	public function __construct( array $sections = array() ) {
		foreach ( $sections as $section ) {
			$this->add_section( $section );
		}
	}

	/**
	 * Set an array of sections onto the page.
	 *
	 * This is provided as a convenience method for developers who wish to create their sections array and then
	 * pass it to the Page instead of calling add_section at each step.
	 *
	 * @param array $sections
	 */
	public function set_sections( array $sections ) {
		try {
			$this->sections = array();

			foreach ( $sections as $section ) {
				$this->add_section( $section );
			}
		} catch ( \TypeError $error ) {
			throw new \TypeError( __METHOD__ . ' parameter $fields contains elements not of type ' . __NAMESPACE__ . '\\Section.' );
		}

		return $this;
	}

	/**
	 * Add a section to the page.
	 *
	 * @param Section $section
	 */
	public function add_section( Section $section ) {
		$this->sections[] = $section;

		return $this;
	}

	/**
	 * @return array
	 */
	public function get_as_array() {
		return array_map( function( ArrayFormattable $section ) {
			return $section->get_as_array();
		}, $this->sections );
	}
}
