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

}