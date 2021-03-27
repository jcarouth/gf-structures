<?php
/**
 * Interface for formatting structures into arrays.
 *
 * @package JMichaelWard\GF_Structures
 */

namespace JMichaelWard\GF_Structures;

/**
 * Interface ArrayFormattable
 *
 * @package JMichaelWard\GF_Structures
 */
interface ArrayFormattable {
	/**
	 * Gets the structure as an array formatted for use by Gravity Forms.
	 *
	 * @return array
	 */
	public function get_as_array();
}
