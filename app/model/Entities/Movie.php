<?php

namespace App\Model\Entities;

use Doctrine\ORM\Mapping as ORM,
	Kdyby\Doctrine\Entities\BaseEntity;


/**
 * @package App\Model\Entities
 * @ORM\Entity
 */
class Movie extends BaseEntity
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
	 */
	protected $id;

	/**
	 * @ORM\Column(type="string", length=200)
	 */
	protected $title;

	/**
	 * @ORM\Column(type="string", length=10)
	 */
	protected $length;

	/**
 * @ORM\ManyToMany(targetEntity="Director", inversedBy="movies")
 * @ORM\JoinTable(name="movie_director")
 */
	protected $directors;

	/**
	 * @ORM\ManyToMany(targetEntity="Genre", inversedBy="movies")
	 * @ORM\JoinTable(name="movie_genre")
	 */
	protected $genres;

	/**
	 * @ORM\OneToMany(targetEntity="Screening", mappedBy="movie")
	 */
	protected $screenings;
}