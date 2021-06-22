<?php

namespace App\Entity;

use App\Repository\RecipeCategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RecipeCategoriesRepository::class)
 */
class RecipeCategories
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $recipe_category;

    /**
     * @ORM\OneToMany(targetEntity=Recipes::class, mappedBy="recipeCategories")
     */
    private $_recipes;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    public function __construct()
    {
        $this->_recipes = new ArrayCollection();
    }

        public function __toString(): string
    {
        return (string) $this->recipe_category;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRecipeCategory(): ?string
    {
        return $this->recipe_category;
    }

    public function setRecipeCategory(string $recipe_category): self
    {
        $this->recipe_category = $recipe_category;

        return $this;
    }

    /**
     * @return Collection|Recipes[]
     */
    public function getRecipes(): Collection
    {
        return $this->_recipes;
    }

    public function addRecipe(Recipes $recipe): self
    {
        if (!$this->_recipes->contains($recipe)) {
            $this->_recipes[] = $recipe;
            $recipe->setRecipeCategories($this);
        }

        return $this;
    }

    public function removeRecipe(Recipes $recipe): self
    {
        if ($this->_recipes->removeElement($recipe)) {
            // set the owning side to null (unless already changed)
            if ($recipe->getRecipeCategories() === $this) {
                $recipe->setRecipeCategories(null);
            }
        }

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}
