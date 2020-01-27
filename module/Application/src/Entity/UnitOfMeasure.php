<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class MaterialUnit
 * @ORM\Entity()
 * @ORM\Table(
 *     name="units_of_measure",
 *     options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"},
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(name="name", columns={"name"})
 *     })
 */
class UnitOfMeasure
{
    use EntityIdTrait;

    /**
     * @var string|null
     * @ORM\Column(name="name", type="string", nullable=false)
     */
    private $name;

    /**
     * @var string|null
     * @ORM\Column(name="short_name", type="string", nullable=false)
     */
    private $shortName;

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return UnitOfMeasure
     */
    public function setName(?string $name): UnitOfMeasure
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getShortName(): ?string
    {
        return $this->shortName;
    }

    /**
     * @param string|null $shortName
     * @return UnitOfMeasure
     */
    public function setShortName(?string $shortName): UnitOfMeasure
    {
        $this->shortName = $shortName;
        return $this;
    }

}
