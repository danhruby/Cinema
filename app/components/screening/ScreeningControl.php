<?php

namespace App\Components\Screening;

use App\Model\Entities\Genre;
use App\Model\Entities\Screening,
	Nette\Application\UI,
	Doctrine\ORM\EntityManager;

/**
 * Class ScreeningControl
 */
class ScreeningControl extends UI\Control
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
	 * @var int
	 */
	private $id;

	/**
	 * ScreeningControl constructor.
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
		if(!is_null($this->id))
		{
			$r_screening = $this->em->getRepository(Screening::getClassName());
			$screening = $r_screening->find($this->id);

			$this['screening']['title']->setValue($screening->title);
			$this['screening']['length']->setValue($screening->length);
			$this['screening']['genres']->setDefaultValue($screening->getGenresId());
		}

		$this->template->setFile(__DIR__ . '/screening.latte');
		$this->template->render();
	}

	/**
	 * @return UI\Form
	 */
	protected function createComponentScreening()
	{
		$form = new UI\Form;
		$form->addText('title', 'Název:')
			->setAttribute('class', 'form-control')
			->setRequired("Povinné pole!");
		$form->addText('length', 'Délka filmu (min):')
			->setAttribute('class', 'form-control')
			->addRule(UI\Form::INTEGER, 'Zadejte celočíslenou hodnotu!')
			->setRequired("Povinné pole!");
		$form->addMultiSelect('genres', 'Žánr(y):', $this->getGenres());
		$form->addSubmit('save', 'Uložit');
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
		$r_genre = $this->em->getRepository(Genre::getClassName());
		if(is_null($this->id))
		{
			$screening = new Screening();
			$this->flashMessage("Film byl uložen.");
		}
		else
		{
			$r_screening = $this->em->getRepository(Screening::getClassName());
			$screening = $r_screening->find($this->id);
			$this->flashMessage("Film byl změněn.");
		}

		$screening->title = $values['title'];
		$screening->length = $values['length'];

		$screening->removeGenres();
		foreach($values['genres'] as $genre)
		{
			$screening->addToGenres($r_genre->find($genre));
		}

		$this->em->persist($screening);
		$this->em->flush();

		$this->saveGenres($screening->getId(), $values['genres']);

		$this->onSuccess();


	}

	private function getGenres()
	{
		$genres = array();
		foreach($this->em->getRepository(Genre::getClassName())->findAll() as $genre)
		{
			$genres[$genre->id] = $genre->name;
		}

		return $genres;
	}

	private function saveGenres($screening_id, $genres)
	{
		foreach($genres as $genre)
		{

		}
	}
}