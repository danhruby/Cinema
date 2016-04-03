<?php

namespace App\Model\Entities;

use Doctrine\ORM\Mapping as ORM,
	Kdyby\Doctrine\Entities\BaseEntity;


/**
 * @package App\Model\Entities
 * @ORM\Entity
 */
class Type extends BaseEntity
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
	 * @ORM\ManyToMany(targetEntity="Screening", mappedBy="types")
	 */
	protected $screenings;
}