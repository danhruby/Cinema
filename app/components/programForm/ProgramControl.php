<?php

namespace App\Components\Program;

use Nette\Application\UI;

/**
 * Class ProgramControl
 */
class ProgramControl extends UI\Control
{

	/**
	 * @var callable
	 */
	public $onSuccess = [];

	/**
	 * @var Orm
	 */
	private $orm;

	/**
	 * @var int
	 */
	private $id;

	/**
	 * ProgramControl constructor.
	 * @param int|null $id
	 */
	public function __construct($id)
	{
		parent::__construct();
		$this->id = $id;
	}

	public function render()
	{
		$this->template->setFile(__DIR__ . '/program.latte');
		$this->template->render();
	}

	/**
	 * @return UI\Form
	 */
	protected function createComponentProgram()
	{
		$form = new UI\Form;
		$form->addText('name', 'Name:');
		$form->addSubmit('save', 'Save');
		$form->onSuccess[] = function (UI\Form $form)
		{
			$this->process($form);
		};

		return $form;
	}

	/**
	 * @param UI\Form $form
	 */
	protected function process(UI\Form $form)
	{
		$values = $form->getValues();

		if(is_null($this->id))
		{
			$this->presenter->flashMessage('Program was successfully saved.');
		}
		else
		{
			$this->presenter->flashMessage("Program was successfully changed.");
		}

		$this->onSuccess();
	}
}