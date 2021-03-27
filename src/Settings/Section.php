<?php
/**
 * Object for rendering a settings section.
 *
 * @see https://docs.gravityforms.com/category/developers/php-api/add-on-framework/settings-api/#creating-a-plugin-settings-page
 * @package JMichaelWard\GF_Structures\Settings
 */

namespace JMichaelWard\GF_Structures\Settings;

/**
 * Class Section
 *
 * @package JMichaelWard\GF_Structures\Settings
 */
class Section {
	/**
	 * @var string
	 */
	private $title;

	/**
	 * @var string
	 */
	private $description;

	/**
	 * @var string
	 */
	private $id;

	/**
	 * @var string
	 */
	private $class;

	/**
	 * @var string
	 */
	private $style;

	/**
	 * @var string
	 */
	private $tooltip;

	/**
	 * @var string
	 */
	private $tooltip_class;

	/**
	 * @var string|array
	 */
	private $dependency;

	/**
	 * @var array
	 */
	private $fields;
}
