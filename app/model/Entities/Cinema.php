<?php

namespace App\Model\Entities;

use Doctrine\ORM\Mapping as ORM,
	Kdyby\Doctrine\Entities\BaseEntity,
	App\Model\Entities\Room;


/**
 * @package App\Model\Entities
 * @ORM\Entity
 */
class Cinema extends BaseEntity
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
	 */
	protected $id;

	/**
	 * @ORM\OneToMany(targetEntity="Room", mappedBy="cinema")
	 */
	protected $rooms;

	/**
	 * @ORM\Column(type="string", length=50)
	 */
	protected $name;

	/**
	 * @ORM\Column(type="string", length=50)
	 */
	protected $street;

	/**
	 * @ORM\Column(type="string", length=10)
	 */
	protected $house_number;

	/**
	 * @ORM\Column(type="string", length=50)
	 */
	protected $city;

}