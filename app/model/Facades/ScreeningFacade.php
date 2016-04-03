<?php
namespace App\Model\Facades;

use App\Model\Entities\Screening,
	Kdyby\Doctrine\EntityManager,
	Nette\Utils\DateTime,
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
	public function getScreeningsByDay($from)
	{
		$to = clone $from;

		$r_screening = $this->em->getRepository(Screening::getClassName());
		$screenings = $r_screening->createQueryBuilder("s")
			->join('s.movie', 'm')
			->where('s.time BETWEEN :from AND :to')->setParameter('from', $from)->setParameter('to', $to->modify('+1 day'))
			->getQuery()
			->execute();

		$program = array();
		foreach($screenings as $screening)
		{
			$program[$screening->movie->id]['title'] = $screening->movie->title;
			$program[$screening->movie->id][$screening->time->format('G')] = $screening->time->format('H:i');
		}

		return $program;
	}
}