<?php

namespace App\Presenters;

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

		$this->em->remove($movie);
		$this->em->flush();
		$this->flashMessage('Film byl vymazán.');

		$this->redirect('Admin:default');
	}

	public function renderDefault()
	{
		$r_movies = $this->em->getRepository(Movie::getClassName());
		$r_screenings = $this->em->getRepository(Screening::getClassName());

		$this->template->movies = $r_movies->findAll();
		$this->template->screenings = $r_screenings->findAll();
	}

	public function renderEdit($id)
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
}
