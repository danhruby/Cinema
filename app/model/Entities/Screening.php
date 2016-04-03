<?php

namespace App\Model\Entities;

use Doctrine\ORM\Mapping as ORM,
	Kdyby\Doctrine\Entities\BaseEntity;


/**
 * @package App\Model\Entities
 * @ORM\Entity
 */
class Screening extends BaseEntity
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
	 */
	protected $id;
	/**
	 * @ORM\Column(type="datetime")
	 */
	protected $time;

	/**
	 * @ORM\ManyToOne(targetEntity="Room", inversedBy="screenings")
	 */
	protected $room;

	/**
	 * @ORM\ManyToOne(targetEntity="Movie", inversedBy="screenings")
	 */
	protected $movie;

	/**
	 * @ORM\Column(type="integer")
	 */
	protected $price;

	/**
	 * @ORM\ManyToMany(targetEntity="Type", inversedBy="screenings")
	 * @ORM\JoinTable(name="movie_screening")
	 */
	protected $types;
}