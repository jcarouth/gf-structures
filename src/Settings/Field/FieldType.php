<?php
/**
 * This interface registers the set of default field types available in Gravity Forms.
 *
 * @package JMichaelWard\GF_Structures\Settings
 */

namespace JMichaelWard\GF_Structures\Settings\Field;

/**
 * Interface FieldType
 *
 * @package JMichaelWard\GF_Structures\Settings
 */
interface FieldType {
	/**
	 * Gravity Forms default available field types.
	 */
	const TEXT                = 'text';
	const TEXTAREA            = 'textarea';
	const HIDDEN              = 'hidden';
	const CHECKBOX            = 'checkbox';
	const RADIO               = 'radio';
	const SELECT              = 'select';
	const SELECT_CUSTOM       = 'select_custom';
	const FIELD_MAP           = 'field_map';
	const DYNAMIC_FIELD_MAP   = 'dynamic_field_map';
	const FIELD_SELECT        = 'field_select';
	const CHECKBOX_AND_SELECT = 'checkbox_and_select';
	const SAVE                = 'save';
}
