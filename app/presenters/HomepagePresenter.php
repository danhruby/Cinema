<?php

namespace App\Presenters;

use Nette,
	App\Model,
	App\Components\Program\IProgramFactory,
	App\Components\Program\ProgramControl,
	App\Model\Entities\Screening,
	App\Model\Entities\Movie,
	Nette\Utils\DateTime,
	App\Model\Facades\ScreeningFacade;


class HomepagePresenter extends BasePresenter
{
	/**
	 * @var ScreeningFacade
	 * @inject
	 */
	public $screeningFacade;

	public function renderDefault()
	{
		
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
