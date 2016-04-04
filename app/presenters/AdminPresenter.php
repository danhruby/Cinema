<?php

namespace App\Presenters;

use App\Components\Screening\IScreeningFactory;
use App\Model\Entities\Movie,
	App\Model\Entities\Screening,
	Nette,
	App\Components\Movie\IMovieFactory;


class AdminPresenter extends BasePresenter
{
	public function handleDeleteMovie($id)
	{
		$r_movies = $this->em->getRepository(Movie::getClassName());
		$movie = $r_movies->find($id);

		$movie->removeGenres();
		$this->em->persist($movie);
		$this->em->flush();

		$this->em->remove($movie);
		$this->em->flush();
		$this->flashMessage('Film byl vymazán.');

		$this->redirect('Admin:default');
	}

	public function handleDeleteScreening($id)
	{

	}

	public function renderDefault()
	{
		$r_movies = $this->em->getRepository(Movie::getClassName());
		$r_screenings = $this->em->getRepository(Screening::getClassName());

		$this->template->movies = $r_movies->findAll();
		$this->template->screenings = $r_screenings->findAll();
	}

	public function renderEditMovie($id)
	{
	}

	public function renderEditScreening($id)
	{
	}

	/**
	 * @param IMovieFactory $movieFactory
	 * @return MovieControl
	 */
	protected function createComponentMovie(IMovieFactory $movieFactory)
	{
		$movie = $movieFactory->create($this->getParameter('id'));
		$movie->onSuccess[] = function ()
		{
			$this->redirect("Admin:default");
		};
		return $movie;
	}

	/**
	 * @param IScreeningFactory $screeningFactory
	 * @return ScreeningControl
	 */
	protected function createComponentScreening(IScreeningFactory $screeningFactory)
	{
		$screening = $screeningFactory->create($this->getParameter('id'));
		$screening->onSuccess[] = function ()
		{
			$this->redirect("Admin:default");
		};
		return $screening;
	}
}
