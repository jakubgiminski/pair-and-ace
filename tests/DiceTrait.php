<?php

namespace Tests;

trait DiceTrait
{
	public function testCanBeRolled()
	{
		$this->assertNotEmpty($this->dice->roll());
	}

	public function testResultOfRollingIsAnInteger()
	{
		$this->assertInternalType(
			'int',
			$this->dice->roll()
		);
	}

	public function testResultOfRollingIsGreaterThanZero()
	{
		$this->assertGreaterThan(
			0,
			$this->dice->roll()
		);
	}

	public function testResultOfRollingIsLessThanSeven()
	{
		$this->assertLessThan(
			7,
			$this->dice->roll()
		);
	}
}