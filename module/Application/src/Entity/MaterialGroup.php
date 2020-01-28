<?php


namespace Application\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class MaterialGroup
 * @package Application\Entity
 * @ORM\Entity(repositoryClass="Application\Repository\MaterialGroupsRepository")
 * @ORM\Table(
 *     name="material_groups",
 *     options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"},
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(name="name", columns={"name"})
 *     }
 * )
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
     * Group has many Materials
     * @var Material[]|Collection
     * @ORM\OneToMany(targetEntity="Material", mappedBy="materialGroup")
     */
    private $materials;

    /**
     * One Category has Many Categories.
     * @var MaterialGroup[]|Collection
     * @ORM\OneToMany(targetEntity="MaterialGroup", mappedBy="parent")
     */
    private $children;

    /**
     * Many Categories have One Category.
     * @var MaterialGroup|null
     * @ORM\ManyToOne(targetEntity="MaterialGroup", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private $parent;

    public function __construct()
    {
        $this->children = new ArrayCollection();
        $this->materials = new ArrayCollection();
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
     * @return MaterialGroup
     */
    public function setName(?string $name): MaterialGroup
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Material[]|Collection
     */
    public function getMaterials()
    {
        return $this->materials;
    }

    /**
     * @param Material[]|Collection $materials
     * @return MaterialGroup
     */
    public function setMaterials(Collection $materials)
    {
        $this->materials = $materials;
        return $this;
    }

    /**
     * @return MaterialGroup[]|Collection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @param MaterialGroup[]|Collection $children
     * @return MaterialGroup
     */
    public function setChildren(Collection $children)
    {
        $this->children = $children;
        return $this;
    }

    /**
     * @return MaterialGroup|null
     */
    public function getParent(): ?MaterialGroup
    {
        return $this->parent;
    }

    /**
     * @param MaterialGroup|null $parent
     * @return MaterialGroup
     */
    public function setParent(?MaterialGroup $parent): MaterialGroup
    {
        $this->parent = $parent;
        return $this;
    }

}
