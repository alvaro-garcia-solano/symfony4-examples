<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PropertyRepository")
 */
class Property
{
    /**
     * The properties id (PK)
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     */
    private $id;

    /**
     * The properties title
     *
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 2,
     *      max = 100,
     *      minMessage = "El titulo debe tener al menos {{ limit }} caracteres",
     *      maxMessage = "El titulo debe tener como maximo {{ limit }} caracteres"
     * )
     */
    private $title;

    /**
     * The properties description
     *
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Escribe una descripción")
     *
     */
    private $description;

    /**
     * The properties prize with two decimal places
     *
     * @ORM\Column(type="decimal", scale=2)
     * @Assert\NotBlank(message="Escribe un precio")
     */
    private $prize;

    /**
     * The properties rooms number
     *
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Escribe el número de habitaciones")
     * @Assert\Range(min=0, minMessage="El número de habitaciones no puede ser negativo")
     */
    private $rooms;

    /**
     * The properties bathroom number
     *
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Escribe el número de cuartos de baño")
     * @Assert\Range(min=0, minMessage="El número de cuartos de baño no puede ser negativo")
     */
    private $bathrooms;

    /**
     * The properties toilets number
     *
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Escribe el número de aseos")
     * @Assert\Range(min=0, minMessage="El número de aseos no puede ser negativo")
     */
    private $toilets;

    /**
     * The properties size (m2)
     *
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Escribe el tamaño en m2")
     * @Assert\Range(min=0, minMessage="El tamaño en m2 no puede ser negativo")
     */
    private $size;

    /**
     * The properties plot size (m2)
     *
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Escribe el tamaño de la parcela en m2")
     * @Assert\Range(min=0, minMessage="El tamaño de la parcela en m2 no puede ser negativo")
     */
    private $plotSize;

    /**
     * The province where the property is located
     *
     * @ORM\ManyToOne(targetEntity="Province")
     * @ORM\JoinColumn(nullable=false)
     *
     */
    private $province;

    /*private $createdDate;

    private $updatedDate;
    */

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getPrize()
    {
        return $this->prize;
    }

    /**
     * @param mixed $prize
     */
    public function setPrize($prize): void
    {
        $this->prize = $prize;
    }

    /**
     * @return mixed
     */
    public function getRooms()
    {
        return $this->rooms;
    }

    /**
     * @param mixed $rooms
     */
    public function setRooms($rooms): void
    {
        $this->rooms = $rooms;
    }

    /**
     * @return mixed
     */
    public function getBathrooms()
    {
        return $this->bathrooms;
    }

    /**
     * @param mixed $bathrooms
     */
    public function setBathrooms($bathrooms): void
    {
        $this->bathrooms = $bathrooms;
    }

    /**
     * @return mixed
     */
    public function getToilets()
    {
        return $this->toilets;
    }

    /**
     * @param mixed $toilets
     */
    public function setToilets($toilets): void
    {
        $this->toilets = $toilets;
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param mixed $size
     */
    public function setSize($size): void
    {
        $this->size = $size;
    }

    /**
     * @return mixed
     */
    public function getPlotSize()
    {
        return $this->plotSize;
    }

    /**
     * @param mixed $plotSize
     */
    public function setPlotSize($plotSize): void
    {
        $this->plotSize = $plotSize;
    }

    /**
     * @return mixed
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * @param mixed $province
     */
    public function setProvince(Province $province): void
    {
        $this->province = $province;
    }


}

