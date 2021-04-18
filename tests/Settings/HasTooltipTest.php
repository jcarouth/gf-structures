<?php

namespace JMichaelWard\GF_Structures\Tests\Settings;

use JMichaelWard\GF_Structures\ArrayFormattable;
use JMichaelWard\GF_Structures\Settings\HasTooltip;
use PHPUnit\Framework\TestCase;
use TypeError;

class HasTooltipTest extends TestCase
{
	public function testTooltipIsRequired()
	{
		$classWithTooltip = $this->getClassWithTooltip();

		$this->expectException(TypeError::class);
		$classWithTooltip->set_tooltip(null);
	}

	public function testGetSetTooltip()
	{
		$classWithTooltip = $this->getClassWithTooltip();

		$classWithTooltip->set_tooltip('test_tooltip');
		$this->assertEquals('test_tooltip', $classWithTooltip->get_as_array()['tooltip']);
	}

	public function testTooltipClassIsRequired()
	{
		$classWithTooltip = $this->getClassWithTooltip();

		$this->expectException(TypeError::class);
		$classWithTooltip->set_tooltip_class(null);
	}

	public function testGetSetTooltipClass()
	{
		$classWithTooltip = $this->getClassWithTooltip();

		$classWithTooltip->set_tooltip_class('test_tooltip_class');
		$this->assertEquals('test_tooltip_class', $classWithTooltip->get_as_array()['tooltip_class']);
	}

	protected function getClassWithTooltip()
	{
		return new class() implements ArrayFormattable {
			use HasTooltip;

			public function get_as_array()
			{
				return array_filter(
					array(
						'tooltip'       => $this->get_tooltip(),
						'tooltip_class' => $this->get_tooltip_class(),
					)
				);
			}
		};
	}
}
