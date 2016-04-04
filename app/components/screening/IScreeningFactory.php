<?php

namespace App\Components\Screening;

/**
 * Interface IScreeningFactory
 */
interface IScreeningFactory
{

	/**
	 * @return ScreeningControl
	 */
	public function create($id);

}