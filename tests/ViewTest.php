<?php

use App\View\View;

class ViewTest extends PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		$this->view = new View;
	}

	public function testDisplayingStartGameMessageReturnsItself()
	{
		$this->assertInstanceOf(
			View::class,
			$this->view->displayStartGameMessage()
		);
	}

	public function testDisplayingNoLuckMessageReturnsItself()
	{
		$this->assertInstanceOf(
			View::class,
			$this->view->displayNoLuckMessage()
		);
	}

	public function testDisplayingNewRoundMessageReturnsItself()
	{
		$this->assertInstanceOf(
			View::class,
			$this->view->displayNewRoundMessage(123)
		);
	}

	public function testDisplayingWinnerMessageReturnsItself()
	{
		$this->assertInstanceOf(
			View::class,
			$this->view->displayWinnerMessage('Mietek')
		);
	}

	public function testDisplayingGameFinishedMessageReturnsItself()
	{
		$this->assertInstanceOf(
			View::class,
			$this->view->displayGameFinishedMessage()
		);
	}
}
