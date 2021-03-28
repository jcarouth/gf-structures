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
	 * Text content to render in a tooltip for this choice.
	 *
	 * Used only for checkboxes and radio buttons.
	 *
	 * @var string
	 */
	private $tooltip;

	/**
	 * Value to append to the class attribute of the HTML container element for this choice's tooltip.
	 *
	 * @var string
	 */
	private $tooltip_class;

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
	private $choices;

	/**
	 * Choice constructor.
	 *
	 * @param string $label The choice label.
	 */
	public function __construct( $label ) {
		$this->label = $this->set_label( $label );
	}

	/**
	 * @param string $label
	 */
	public function set_label( $label ) {
		$this->label = $label;

		return $this;
	}

	/**
	 * @param string $name
	 */
	public function set_name( $name ) {
		$this->name = $name;

		return $this;
	}

	/**
	 * @param string $value
	 */
	public function set_value( $value ) {
		$this->value = $value;

		return $this;
	}

	/**
	 * @param int $default_value
	 */
	public function set_default_value( $default_value ) {
		$this->default_value = $default_value;

		return $this;
	}

	/**
	 * @param string $tooltip
	 */
	public function set_tooltip( $tooltip ) {
		$this->tooltip = $tooltip;

		return $this;
	}

	/**
	 * @param string $tooltip_class
	 */
	public function set_tooltip_class( $tooltip_class ) {
		$this->tooltip_class = $tooltip_class;

		return $this;
	}

	/**
	 * @param string $icon
	 */
	public function set_icon( $icon ) {
		$this->icon = $icon;

		return $this;
	}

	/**
	 * @param array $choices
	 */
	public function set_choices( $choices ) {
		$this->choices = array();

		foreach ( $choices as $choice ) {
			$this->add_choice( $choice );
		}

		return $this;
	}

	public function add_choice( Choice $choice ) {
		$this->choices[] = $choice;

		return $this;
	}

	/**
	 * Get the choice as a formatted array.
	 *
	 * @return array
	 */
	public function get_as_array() {
		return array(
			'label'         => $this->label,
			'name'          => $this->name,
			'value'         => $this->value,
			'default_value' => $this->default_value,
			'tooltip'       => $this->tooltip,
			'tooltip_class' => $this->tooltip_class,
			'icon'          => $this->icon,
			'choices'       => $this->choices,
		);
	}
}
