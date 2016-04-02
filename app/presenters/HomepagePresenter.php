<?php

namespace App\Presenters;

use Nette,
	App\Model,
	App\Components\Program\IProgramFactory,
	App\Components\Program\ProgramControl;


class HomepagePresenter extends BasePresenter
{

	public function renderDefault()
	{
		$this->template->anyVariable = 'any value';
	}

	/**
	 * @param IProgramFactory $programFactory
	 * @return ProgramControl
	 */
	protected function createComponentProgram(IProgramFactory $programFactory)
	{
		$program = $programFactory->create($this->getParameter('id'));
		$program->onSuccess[] = function ()
		{
			$this->redirect('Home:default');
		};
		return $program;
	}

}
