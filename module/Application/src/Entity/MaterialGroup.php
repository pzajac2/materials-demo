<?php


namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class MaterialGroup
 * @package Application\Entity
 * @ORM\Entity()
 * @ORM\Table(name="material_groups", options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 */
class MaterialGroup
{
    use EntityIdTrait;

    /**
     * @var string|null
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return MaterialGroup
     */
    public function setName(?string $name): MaterialGroup
    {
        $this->name = $name;
        return $this;
    }

}
