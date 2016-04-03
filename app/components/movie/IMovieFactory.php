<?php

namespace App\Components\Movie;

/**
 * Interface IMovieFactory
 */
interface IMovieFactory
{

	/**
	 * @return MovieControl
	 */
	public function create($id);

}