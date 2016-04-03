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
		/*if(!$this->isAjax())
		{*/
			$this->template->program = $this->screeningFacade->getScreeningsByDay(new DateTime('today'));
		/*}*/
	}

	public function handleChangeProgram()
	{
		$this->template->program = $this->screeningFacade->getScreeningsByDay(new DateTime("03/27/2016"));
		if ($this->isAjax()) {
			$this->redrawControl('progr');
		}
	}

	/*public function handleChangeVariable()
	{
		$this->template->anyVariable = 'changed value via ajax';
		if ($this->isAjax()) {
			$this->redrawControl('ajaxChange');
		}
	}*/

	/**
	 * @param IProgramFactory $programFactory
	 * @return ProgramControl
	 */
	protected function createComponentProgram(IProgramFactory $programFactory)
	{
		$program = $programFactory->create($this->getParameter('id'));
		$program->onSuccess[] = function ($day)
		{
			if($this->isAjax())
			{
				$this->template->program = $this->screeningFacade->getScreeningsByDay($day);
				$this->redrawControl("progr");

			}
		};
		return $program;
	}

}
