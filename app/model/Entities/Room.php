<?php

namespace App\Model\Entities;

use Doctrine\ORM\Mapping as ORM,
	Kdyby\Doctrine\Entities\BaseEntity,
	App\Model\Entities\Cinema;


/**
 * @package App\Model\Entities
 * @ORM\Entity
 */
class Room extends BaseEntity
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
	 */
	protected $id;

	/**
	 * @ORM\ManyToOne(targetEntity="Cinema", inversedBy="rooms")
	 */
	protected $cinema;

	/**
	 * @ORM\Column(type="string", length=50)
	 */
	protected $name;

	/**
	 * @ORM\OneToMany(targetEntity="Screening", mappedBy="rooms")
	 */

	protected $screenings;
}