<?php
/**
 * Interface for Section-style objects.
 *
 * @package JMichaelWard\GF_Structures\Settings
 */

namespace JMichaelWard\GF_Structures\Settings;

use JMichaelWard\GF_Structures\ArrayFormattable;

/**
 * Class SectionInterface
 *
 * @package JMichaelWard\GF_Structures\Settings
 */
interface SectionInterface extends ArrayFormattable {
	/**
	 * Add a section field.
	 *
	 * @param Field $field A Field object.
	 */
	public function add_field( $field );

	/**
	 * Add an array of fields all at once.
	 *
	 * @param array $fields
	 */
	public function set_fields( array $fields );
}
