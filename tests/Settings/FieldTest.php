<?php

namespace JMichaelWard\GF_Structures\Tests\Settings;

use JMichaelWard\GF_Structures\Settings\Field;
use PHPUnit\Framework\TestCase;

class FieldTest extends TestCase
{
	protected $mockCallable;

	public function testTypeParameterMustBeString()
	{
		$this->expectException(\TypeError::class);
		new Field(array(), 'Name');
	}

	public function testNameParameterMustBeString()
	{
		$this->expectException(\TypeError::class);
		new Field('Type', 42);
	}

    public function testGetAsArray()
    {
    	$this->markTestSkipped('Skipping because using array_filter removes falsey-valued properties');

    	$expectedValues = array(
			'type'                => Field\FieldType::TEXT,
			'input_type'          => 'Input Type',
			'name'                => 'Text Field',
			'id'                  => 'ID',
			'label'               => 'Label',
			'required'            => true,
			'class'               => 'Class',
			'hidden'              => false,
			'default_value'       => 'Default Value',
			'horizontal'          => false,
			//'dependency'          => $this->dependency,
			//'choices'             => $this->get_choices_as_array(),
			'feedback_callback'   => $this->getFakeCallback(),
			'callback'            => $this->getFakeCallback(),
			'validation_callback' => $this->getFakeCallback(),
			'after_input'         => 'After Input',
			//'field_map'           => $this->field_map,
		);

    	$field = (new Field($expectedValues['type'], $expectedValues['name']))
			->set_input_type($expectedValues['input_type'])
			->set_id($expectedValues['id'])
			->set_label($expectedValues['label'])
			->set_required($expectedValues['required'])
			->set_class($expectedValues['class'])
			->set_hidden($expectedValues['hidden'])
			->set_default_value($expectedValues['default_value'])
			->set_horizontal($expectedValues['horizontal'])
			->set_feedback_callback($expectedValues['feedback_callback'])
			->set_callback($expectedValues['callback'])
			->set_validation_callback($expectedValues['validation_callback'])
			->set_after_input($expectedValues['after_input']);

    	$this->assertEquals($expectedValues, $field->get_as_array());
    }

    protected function getFakeCallback()
	{
		if ( is_null( $this->mockCallable ) ) {
			$this->mockCallable = $this->getMockBuilder(\stdClass::class)->addMethods(['__invoke'])->getMock();
		}

		return $this->mockCallable;
	}
}
