<?php

namespace JMichaelWard\GF_Structures\Tests\Settings;

use JMichaelWard\GF_Structures\Settings\Field;
use JMichaelWard\GF_Structures\Settings\Section;
use PHPUnit\Framework\TestCase;

class SectionTest extends TestCase
{
	protected Section $section;

	protected function setUp(): void
	{
		$this->section = new Section();
	}

    public function testSetTitleMustBeString()
    {
    	$this->expectException(\TypeError::class);
    	$this->section->set_title(1);
    }

    public function testSettableProperties()
	{
		$expectedValues = array(
			'title'       => 'Test Title',
			'description' => 'Test Description',
			'id'          => 'Test Id',
			'class'       => 'Test Class',
			'style'       => 'Test Style',
		);

		$this->section
			->set_title($expectedValues['title'])
			->set_description($expectedValues['description'])
			->set_id($expectedValues['id'])
			->set_class($expectedValues['class'])
			->set_style($expectedValues['style']);

		$this->assertEquals(
			$expectedValues,
			$this->section->get_as_array()
		);
	}

    public function testSetFieldsAsArray()
    {
    	$fieldsToSet = array(
    		$this->createFieldStub(Field\FieldType::HIDDEN, 'Hidden Field'),
			$this->createFieldStub(Field\FieldType::TEXT, 'Text Field'),
		);

    	$this->assertArrayNotHasKey('fields', $this->section->get_as_array());

    	$this->section->set_fields($fieldsToSet);
    	$this->assertArrayHasKey('fields', $this->section->get_as_array());
    	$this->assertEquals(
    		array(
				'fields' => array(
					array('type' => Field\FieldType::HIDDEN, 'name' => 'Hidden Field'),
					array('type' => Field\FieldType::TEXT, 'name' => 'Text Field'),
				),
			),
			$this->section->get_as_array()
		);
    }

    public function testSetFieldsOverwriteExistingFields()
	{
		$this->section->add_field($this->createFieldStub(Field\FieldType::TEXT, 'Existing Field'));
		$this->assertEquals(
			array(
				'fields' => array(
					array('type' => Field\FieldType::TEXT, 'name' => 'Existing Field'),
				),
			),
			$this->section->get_as_array()
		);

		$this->section->set_fields(array(
			$this->createFieldStub(Field\FieldType::TEXT, 'New Field'),
		));
		$this->assertEquals(
			array(
				'fields' => array(
					array('type' => Field\FieldType::TEXT, 'name' => 'New Field'),
				),
			),
			$this->section->get_as_array()
		);
	}

    public function testAddFieldIndividually()
    {
		$fieldStub = $this->createFieldStub(Field\FieldType::TEXT, 'Test Field');

		$this->section->add_field($fieldStub);

    	$this->assertEquals(
    		array(
    			'fields' => array(
    				array(
    					'type' => Field\FieldType::TEXT,
						'name' => 'Test Field',
					)
				)
			),
			$this->section->get_as_array()
		);
    }

	protected function createFieldStub($type, $name)
	{
		$fieldStub = $this->createStub(Field::class);
		$fieldStub->method('get_as_array')
			->willReturn(array(
				'type' => $type,
				'name' => $name,
			));

		return $fieldStub;
	}
}
