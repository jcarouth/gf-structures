<?php
/**
 * Object for registering a single field choice.
 *
 * @package JMichaelWard\GF_Structures\Settings
 */

namespace JMichaelWard\GF_Structures\Settings;

use JMichaelWard\GF_Structures\Settings\Choice\ChoiceInterface;

/**
 * Class Choice
 *
 * @package JMichaelWard\GF_Structures\Settings
 */
class Choice implements ChoiceInterface {
	use Tooltip;

	/**
	 * The choice label.
	 *
	 * @var string
	 */
	private $label;

	/**
	 * Name of the setting.
	 *
	 * Only used for checkboxes, and is also used as the ID attribute for the containing HTML element.
	 *
	 * @var string
	 */
	private $name;

	/**
	 * Only used for radio buttons and select.
	 *
	 * Defaults to the value of label if empty.
	 *
	 * @see Choice::$label
	 * @var string
	 */
	private $value;

	/**
	 * Default value for the choice, only used by checkboxes.
	 *
	 * The official Gravity Forms documentation lists this as a boolean, but a value of 1 or 0 is expected.
	 *
	 * Defaults to 0.
	 *
	 * @var int
	 */
	private $default_value = 0;

	/**
	 * Either an image URL or classname for an icon.
	 *
	 * Official documentation states class icon names are Font Awesome. This property is only used by radio and
	 * checkbox fields.
	 *
	 * @var string
	 */
	private $icon;

	/**
	 * Array of choices for this option group, which follow the same structure as this class.
	 *
	 * @see Choice
	 * @var array
	 */
	private $choices = array();

	/**
	 * Choice constructor.
	 *
	 * @param string $label The choice label.
	 */
	public function __construct( $label ) {
		if ( ! is_string( $label ) ) {
			throw new \TypeError( __METHOD__ . ' parameter $label must be of type string.' );
		}

		$this->label = $label;
	}

	/**
	 * Set the name property.
	 *
	 * @param string $name
	 */
	public function set_name( $name ) {
		if ( ! is_string( $name ) ) {
			throw new \TypeError( __METHOD__ . ' pamater $name must be of type string.' );
		}

		$this->name = $name;

		return $this;
	}

	/**
	 * Set the value property.
	 *
	 * @param string $value
	 */
	public function set_value( $value ) {
		if ( ! is_string( $value ) ) {
			throw new \TypeError( __METHOD__ . ' parameter $value must be of type string.' );
		}

		$this->value = $value;

		return $this;
	}

	/**
	 * Set the default_value property.
	 *
	 * @param int $default_value
	 */
	public function set_default_value( $default_value ) {
		if ( ! in_array( $default_value, array( 0, 1 ), true ) ) {
			throw new \TypeError( __METHOD__ . ' parameter $default_value must be of type int with a value of 0 or 1.' );
		}

		$this->default_value = $default_value;

		return $this;
	}

	/**
	 * Set the icon property.
	 *
	 * @param string $icon
	 */
	public function set_icon( $icon ) {
		if ( ! is_string( $icon ) ) {
			throw new \TypeError( __METHOD__ . ' parameter $icon must be of type string.' );
		}

		$this->icon = $icon;

		return $this;
	}

	/**
	 * Set all choices on the structure.
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
	 * Add a single choice to the choices array.
	 *
	 * @param Choice $choice
	 *
	 * @return $this
	 */
	public function add_choice( Choice $choice ) {
		$this->choices[] = $choice;

		return $this;
	}

	public function get_choices_as_array() {
		return array_map( function( ChoiceInterface $choice ) {
			return $choice->get_as_array();
		}, $this->choices );
	}

	/**
	 * Get the choice as a formatted array.
	 *
	 * @return array
	 */
	public function get_as_array() {
		return array_filter(
			array(
				'label'         => $this->label,
				'name'          => $this->name,
				'value'         => $this->value,
				'default_value' => $this->default_value,
				'tooltip'       => $this->get_tooltip(),
				'tooltip_class' => $this->get_tooltip_class(),
				'icon'          => $this->icon,
				'choices'       => $this->get_choices_as_array(),
			)
		);
	}
}
