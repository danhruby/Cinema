<?php

namespace App\Components\Program;

/**
 * Interface IProgramFactory
 */
interface IProgramFactory
{

	/**
	 * @return ProgramControl
	 */
	public function create($id);

}