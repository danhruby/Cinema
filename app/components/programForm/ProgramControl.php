<?php

namespace App\Components\Program;

use App\Model\Entities\Cinema,
	Nette\Application\UI,
	App\Model\Facades\ScreeningFacade,
	Kdyby\Doctrine\EntityManager;

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
	 * @var EntityManager
	 */
	private $em;

	/**
	 * @var ScreeningFacade
	 * @inject
	 */
	public $screeningFacade;

	/**
	 * @var int
	 */
	private $id;

	/**
	 * ProgramControl constructor.
	 * @param int|null $id
	 * @param EntityManager $em
	 */
	public function __construct($id, EntityManager $em)
	{
		parent::__construct();
		$this->id = $id;
		$this->em = $em;
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
		$form->getElementPrototype()->class('ajax');
		$form->addText('time', 'Time:')
			->setAttribute('id', 'datepicker')
			->setAttribute('class', 'form-control')
			->setAttribute('placeholder', 'Select day');
		$form->addSelect('cinema', "Kino: ", $this->getCinemas())
			->setAttribute('class', 'form-control');
		$form->addSubmit('find', 'Vyhledat');
		/*$form->onSuccess[] = function (UI\Form $form)
		{
			$this->process($form);
		};*/

		return $form;
	}

	/*/**
	 * @param UI\Form $form
	 */
	/*protected function process(UI\Form $form)
	{
		$values = $form->getHttpData();

		$this->onSuccess(new DateTime($values['time']));
	}*/

	protected function getCinemas()
	{
		$r_cinemas = $this->em->getRepository(Cinema::getClassName());

		$cinemas = array();
		foreach($r_cinemas->findAll() as $cinema)
		{
			$cinemas[$cinema->id] = $cinema->name;
		}

		return $cinemas;
	}
}