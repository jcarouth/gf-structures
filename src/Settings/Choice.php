<?php
/**
 * Object for registering a single field choice.
 *
 * @package JMichaelWard\GF_Structures\Settings
 */

namespace JMichaelWard\GF_Structures\Settings;

/**
 * Class Choice
 *
 * @package JMichaelWard\GF_Structures\Settings
 */
class Choice {
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
}
