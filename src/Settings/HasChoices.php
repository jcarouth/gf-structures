<?php
/**
 * Trait that can be applied to structures which have choices.
 */

namespace JMichaelWard\GF_Structures\Settings;

use JMichaelWard\GF_Structures\Settings\Choice\ChoiceInterface;

/**
 * Trait HasChoices
 *
 * @package JMichaelWard\GF_Structures\Settings
 */
trait HasChoices {
	/**
	 * Array of choices applied to a given structure.
	 *
	 * @var array
	 */
	protected $choices = array();

	/**
	 * Set an array of choices all at once.
	 *
	 * @param array $choices
	 */
	public function set_choices( array $choices ) {
		$this->choices = array();

		foreach ( $choices as $choice ) {
			$this->add_choice( $choice );
		}

		return $this;
	}

	/**
	 * Add a single choice to the field at a time.
	 *
	 * @param ChoiceInterface $choice Instance of a Choice object.
	 *
	 * @return $this
	 */
	public function add_choice( ChoiceInterface $choice ) {
		$this->choices[] = $choice;

		return $this;
	}

	/**
	 * Get all field choices as a formatted array.
	 *
	 * @return array
	 */
	public function get_choices_as_array() {
		return array_map( function( ChoiceInterface $choice ) {
			return $choice->get_as_array();
		}, $this->choices );
	}

}
