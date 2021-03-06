<?php

namespace App\Components\Movie;

use App\Model\Entities\Genre;
use App\Model\Entities\Movie,
	Nette\Application\UI,
	Doctrine\ORM\EntityManager;

/**
 * Class MovieControl
 */
class MovieControl extends UI\Control
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
	 * MovieControl constructor.
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
			$r_movie = $this->em->getRepository(Movie::getClassName());
			$movie = $r_movie->find($this->id);

			$this['movie']['title']->setValue($movie->title);
			$this['movie']['length']->setValue($movie->length);
			$this['movie']['genres']->setDefaultValue($movie->getGenresId());
		}

		$this->template->setFile(__DIR__ . '/movie.latte');
		$this->template->render();
	}

	/**
	 * @return UI\Form
	 */
	protected function createComponentMovie()
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
			$movie = new Movie();
			$this->flashMessage("Film byl uložen.");
		}
		else
		{
			$r_movie = $this->em->getRepository(Movie::getClassName());
			$movie = $r_movie->find($this->id);
			$this->flashMessage("Film byl změněn.");
		}

		$movie->title = $values['title'];
		$movie->length = $values['length'];

		$movie->removeGenres();
		foreach($values['genres'] as $genre)
		{
			$movie->addToGenres($r_genre->find($genre));
		}

		$this->em->persist($movie);
		$this->em->flush();

		$this->saveGenres($movie->getId(), $values['genres']);

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

	private function saveGenres($movie_id, $genres)
	{
		foreach($genres as $genre)
		{

		}
	}
}