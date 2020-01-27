<?php


namespace Application\Entity;


trait EntityIdTrait
{
    /**
     * @var int|null
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned": true})
     */
    private $id;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id)
    {
        $this->id = $id;
    }

}
