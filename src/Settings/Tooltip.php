<?php
/**
 * Grants the behavior for a particular element to have a tooltip.
 */
namespace JMichaelWard\GF_Structures\Settings;

/**
 * Trait Tooltip
 *
 * @package JMichaelWard\GF_Structures\Settings
 */
trait Tooltip {
	/**
	 * Text content to render in a tooltip for this element.
	 *
	 * @var string
	 */
	private $tooltip;

	/**
	 * Value to append to the class attribute of the HTML container element for this element's tooltip.
	 *
	 * @var string
	 */
	private $tooltip_class;

	/**
	 * Set the tooltip property.
	 *
	 * @param string $tooltip
	 */
	public function set_tooltip( $tooltip ) {
		if ( ! is_string( $tooltip ) ) {
			throw new \TypeError( __METHOD__ . ' parameter $tooltip must be of type string.' );
		}

		$this->tooltip = $tooltip;

		return $this;
	}

	/**
	 * Set the tooltip class property.
	 *
	 * @param string $tooltip_class
	 */
	public function set_tooltip_class( $tooltip_class ) {
		if ( ! is_string( $tooltip_class ) ) {
			throw new \TypeError( __METHOD__ . ' parameter $tooltip_class must be of type string.' );
		}

		$this->tooltip_class = $tooltip_class;

		return $this;
	}

	/**
	 * Get the tooltip text from the structure.
	 *
	 * @return string
	 */
	protected function get_tooltip() {
		return $this->tooltip;
	}

	/**
	 * Get the tooltip class from the structure.
	 *
	 * @return string
	 */
	protected function get_tooltip_class() {
		return $this->tooltip_class;
	}
}
