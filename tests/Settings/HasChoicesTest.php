<?php

namespace JMichaelWard\GF_Structures\Tests\Settings;

use JMichaelWard\GF_Structures\Settings\Choice\ChoiceInterface;
use JMichaelWard\GF_Structures\Settings\HasChoices;
use PHPUnit\Framework\TestCase;

class HasChoicesTest extends TestCase
{
	public function testAddIndividualChoices()
	{
		$classWithChoices = $this->getClassWithChoices();

		$this->assertEmpty($classWithChoices->get_choices_as_array());

		$choiceStub = $this->getChoiceStub('choice stub');
		$classWithChoices->add_choice($choiceStub);
		$this->assertCount(1, $classWithChoices->get_choices_as_array());
		$this->assertEquals(
			array(array('label' => 'choice stub')),
			$classWithChoices->get_choices_as_array()
		);
	}

	public function testAddChoicesAsArray()
	{
		$classWithChoices = $this->getClassWithChoices();

		$choices = array(
			$this->getChoiceStub('choice1'),
			$this->getChoiceStub('choice2')
		);

		$classWithChoices->set_choices($choices);
		$this->assertCount(2, $classWithChoices->get_choices_as_array());
		$this->assertEquals(
			array(
				array('label' => 'choice1'),
				array('label' => 'choice2'),
			),
			$classWithChoices->get_choices_as_array()
		);
	}

	/**
	 * @return ChoiceInterface
	 */
	protected function getChoiceStub($label): ChoiceInterface
	{
		$choiceStub = $this->createStub(ChoiceInterface::class);
		$choiceStub->method('get_as_array')
			->willReturn(array('label' => $label));

		return $choiceStub;
	}

	protected function getClassWithChoices()
	{
		return new class() {
			use HasChoices;
		};
	}
}
