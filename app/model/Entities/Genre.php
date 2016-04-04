<?php

namespace App\Model\Entities;

use Doctrine\ORM\Mapping as ORM,
	Kdyby\Doctrine\Entities\BaseEntity;


/**
 * @package App\Model\Entities
 * @ORM\Entity
 */
class Genre extends BaseEntity
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
	 */
	protected $id;

	/**
	 * @ORM\Column(type="string", length=100)
	 */
	protected $name;

	/**
	 * @ORM\ManyToMany(targetEntity="Movie", mappedBy="genres")
	 */
	protected $movies;

	/**
	 * Genre constructor.
	 */
	public function __construct()
	{
		$this->movies = new ArrayCollection();
	}

	public function addToMovie(Movie $movie)
	{
		$this->movies[] = $movie;
	}
}