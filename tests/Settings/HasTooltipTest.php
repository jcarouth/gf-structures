<?php

namespace JMichaelWard\GF_Structures\Tests\Settings;

use JMichaelWard\GF_Structures\Settings\HasTooltip;
use PHPUnit\Framework\TestCase;
use TypeError;

class HasTooltipTest extends TestCase
{
	public function testGetSetTooltip()
	{
		$classWithTooltip = $this->getClassWithTooltip();

		$this->expectException(TypeError::class);
		$classWithTooltip->set_tooltip(null);

		$classWithTooltip->set_tooltip('tooltip');
		$this->assertEquals('tooltip', $classWithTooltip->get_tooltip());
	}

	public function testGetSetTooltipClass()
	{
		$classWithTooltip = $this->getClassWithTooltip();

		$this->expectException(TypeError::class);
		$classWithTooltip->set_tooltip_class(null);

		$classWithTooltip->set_tooltip_class('tooltip_class');
		$this->assertEquals('tooltip_class', $classWithTooltip->get_tooltip_class());
	}

	protected function getClassWithTooltip()
	{
		return new class() {
			use HasTooltip;
		};
	}
}
