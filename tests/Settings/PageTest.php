<?php

namespace JMichaelWard\GF_Structures\Tests\Settings;

use JMichaelWard\GF_Structures\Settings\Choice;
use JMichaelWard\GF_Structures\Settings\Field;
use JMichaelWard\GF_Structures\Settings\Page;
use JMichaelWard\GF_Structures\Settings\Section;
use PHPUnit\Framework\TestCase;

class PageTest extends TestCase
{
    public function testBuildFullPageSettings()
    {
    	$page = (new Page())
			->add_section(
				(new Section())
					->set_title('Title for Section 1')
					->set_description('Description for section 1')
					->add_field(
						(new Field(Field\FieldType::TEXT, 'mytext'))
							->set_label('This is a text input')
					)
					->add_field(
						(new Field(Field\FieldType::SELECT, 'myselect'))
							->set_label('This is a select')
							->set_choices(array(
								(new Choice('my first choice'))->set_value('1'),
								(new Choice('my second choice'))->set_value('2'),
							))
					)
			);

    	$this->assertEquals(
    		array(
    			array(
    				'title' => 'Title for Section 1',
					'description' => 'Description for section 1',
					'fields' => array(
						array(
							'type' => 'text',
							'label' => 'This is a text input',
							'name' => 'mytext',
						),
						array(
							'type' => 'select',
							'label' => 'This is a select',
							'name' => 'myselect',
							'choices' => array(
								array('label' => 'my first choice', 'value' => '1'),
								array('label' => 'my second choice', 'value' => '2'),
							)
						)
					)
				)
			),
			$page->get_as_array()
		);
    }
}
