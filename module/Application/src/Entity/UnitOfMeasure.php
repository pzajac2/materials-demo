<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class MaterialUnit
 * @ORM\Entity()
 * @ORM\Table(name="units_of_measure", options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 */
class UnitOfMeasure
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned": true})
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", nullable=false)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(name="short_name", type="string", nullable=false)
     */
    private $shortName;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getShortName(): string
    {
        return $this->shortName;
    }

    /**
     * @param string $shortName
     */
    public function setShortName(string $shortName)
    {
        $this->shortName = $shortName;
    }

}