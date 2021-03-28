<?php
/**
 * Interface for Choice objects.
 */

namespace JMichaelWard\GF_Structures\Settings\Choice;

use JMichaelWard\GF_Structures\ArrayFormattable;
use JMichaelWard\GF_Structures\Settings\Choice;

/**
 * Interface ChoiceInterface
 *
 * @package JMichaelWard\GF_Structures\Settings\Choice
 */
interface ChoiceInterface extends ArrayFormattable {
	/**
	 * Add a choice object to the array structure.
	 *
	 * @param Choice $choice
	 */
	public function add_choice( Choice $choice );

	/**
	 * Set an array of choices.
	 *
	 * @param array $choices
	 */
	public function set_choices( array $choices );
}
