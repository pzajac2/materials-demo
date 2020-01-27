<?php


namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Material
 * @package Application\Entity
 * @ORM\Entity()
 * @ORM\Table(name="materials", options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 */
class Material
{
    use EntityIdTrait;

    /**
     * @var string|null
     * @ORM\Column(name="code", type="string", length=10, nullable=false)
     */
    private $code;

    /**
     * @var string|null
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var UnitOfMeasure|null
     * @ORM\ManyToOne(targetEntity="Application\Entity\UnitOfMeasure")
     * @ORM\JoinColumn(name="unit_of_measure_id", nullable=false)
     */
    private $unitOfMeasure;

    /**
     * @var MaterialGroup|null
     * @ORM\ManyToOne(targetEntity="Application\Entity\MaterialGroup", inversedBy="materials")
     * @ORM\JoinColumn(name="material_group_id", nullable=false)
     */
    private $materialGroup;

    /**
     * @return string|null
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string|null $code
     * @return Material
     */
    public function setCode(?string $code): Material
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return Material
     */
    public function setName(?string $name): Material
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return UnitOfMeasure|null
     */
    public function getUnitOfMeasure(): ?UnitOfMeasure
    {
        return $this->unitOfMeasure;
    }

    /**
     * @param UnitOfMeasure|null $unitOfMeasure
     * @return Material
     */
    public function setUnitOfMeasure(?UnitOfMeasure $unitOfMeasure): Material
    {
        $this->unitOfMeasure = $unitOfMeasure;
        return $this;
    }

    /**
     * @return MaterialGroup|null
     */
    public function getMaterialGroup(): ?MaterialGroup
    {
        return $this->materialGroup;
    }

    /**
     * @param MaterialGroup|null $materialGroup
     * @return Material
     */
    public function setMaterialGroup(?MaterialGroup $materialGroup): Material
    {
        $this->materialGroup = $materialGroup;
        return $this;
    }

}
