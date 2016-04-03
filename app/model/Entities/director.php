<?php

namespace App\Model\Entities;

use Doctrine\ORM\Mapping as ORM,
	Kdyby\Doctrine\Entities\BaseEntity;


/**
 * @package App\Model\Entities
 * @ORM\Entity
 */
class Director extends BaseEntity
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
	 */
	protected $id;

	/**
	 * @ORM\Column(type="string", length=50)
	 */
	protected $firstname;

	/**
	 * @ORM\Column(type="string", length=50)
	 */
	protected $lastname;

	/**
	 * @ORM\Column(type="date")
	 */
	protected $born;

	/**
	 * @ORM\ManyToMany(targetEntity="Movie", mappedBy="directors")
	 */
	protected $movies;
}