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
	 * Set the section title.
	 *
	 * @param string $title The section title.
	 *
	 * @return void
	 */
	public function set_title( $title );

	/**
	 * Set the section description.
	 *
	 * @param string $description The section description.
	 *
	 * @return void
	 */
	public function set_description( $description );
}
