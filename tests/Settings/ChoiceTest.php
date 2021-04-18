<?php

namespace JMichaelWard\GF_Structures\Tests\Settings;

use JMichaelWard\GF_Structures\Settings\Choice;
use PHPUnit\Framework\TestCase;
use TypeError;

class ChoiceTest extends TestCase
{
	public function testDefaults()
	{
		$choice = new Choice('Test');
		$this->assertEquals(
			array('label' => 'Test'),
			$choice->get_as_array()
		);
	}

	public function testLabelIsRequired()
	{
		$this->expectException(TypeError::class);
		new Choice();
	}

	public function testLabelMustBeString()
	{
		$this->expectException(TypeError::class);
		new Choice(1);
	}

	public function testLabelCannotBeEmpty()
	{
		$choice = new Choice('');
		$this->assertEquals(array(), $choice->get_as_array());
	}

	public function testNameCannotBeNull()
	{
		$choice = new Choice('Test Choice');

		$this->expectException(TypeError::class);
		$choice->set_name(null);
	}

	public function testSetName()
	{
		$choice = new Choice('Test Choice');

		$this->assertArrayNotHasKey('name', $choice->get_as_array());

		$choice->set_name('testchoice');
		$this->assertArrayHasKey('name', $choice->get_as_array());
		$this->assertEquals('testchoice', $choice->get_as_array()['name']);
	}

	public function testFluentInterface()
	{
		$choice = new Choice('test label');

		$this->assertSame($choice, $choice->set_choices(array()));
		$this->assertSame($choice, $choice->set_default_value(1));
		$this->assertSame($choice, $choice->set_icon('icon'));
		$this->assertSame($choice, $choice->set_name('choice name'));
		$this->assertSame($choice, $choice->set_tooltip('tooltip'));
		$this->assertSame($choice, $choice->set_tooltip_class('class'));
		$this->assertSame($choice, $choice->set_value('value'));
	}
}
