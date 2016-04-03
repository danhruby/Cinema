<?php
namespace App\Model\Facades;

use App\Model\Entities\User,
	Kdyby\Doctrine\EntityManager,
	Nette\Object;


/**
 * @package App\Model\Facades
 */
class ScreeningFacade extends Object
{
	/**
	 * @var EntityManager
	 */
	private $em;

	/**
	 * @param EntityManager $em
	 */
	public function __construct(EntityManager $em)
	{
		$this->em = $em;
	}

	/**
	 * @param datetime day
	 * @return array
	 */
	public function getScreeningsByDay($day)
	{
		return array("1" => 1);
	}
}