<?php

namespace App\Entity;

use App\Repository\RecipesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
/**
 * @ORM\Entity(repositoryClass=RecipesRepository::class)
 * @Vich\Uploadable
 */
class Recipes
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
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $photo_filename;

    /**
     * @Vich\UploadableField(mapping="recipes", fileNameProperty="photo_filename")
     * @var File
     */
    private $imageFile;

    /**
    * @ORM\Column(type="datetime")
    * @var \DateTime
    */
   private $updatedAt;


    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="text")
     */
    public $recipe_cooking;

    /**
     * @ORM\ManyToOne(targetEntity=RecipeCategories::class, inversedBy="_recipes")
     */
    public $recipeCategories;


    public function setImageFile(File $image = null)
        {
            $this->imageFile = $image;

            // VERY IMPORTANT:
            // It is required that at least one field changes if you are using Doctrine,
            // otherwise the event listeners won't be called and the file is lost
            if ($image) {
                // if 'updatedAt' is not defined in your entity, use another property
                $this->updatedAt = new \DateTime('now');
            }
        }

        public function getImageFile()
        {
            return $this->imageFile;
        }

        public function __toString(): string
    {
        return $this->title;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getPhotoFilename(): ?string
    {
        return $this->photo_filename;
    }

    public function setPhotoFilename(?string $photo_filename): self
    {

        $this->photo_filename = $photo_filename;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getRecipeCooking(): ?string
    {
        return $this->recipe_cooking;
    }

    public function setRecipeCooking(string $recipe_cooking): self
    {
        $this->recipe_cooking = $recipe_cooking;

        return $this;
    }

    public function getRecipeCategories(): ?RecipeCategories
    {
        return $this->recipeCategories;
    }

    public function setRecipeCategories(?RecipeCategories $recipeCategories): self
    {
        $this->recipeCategories = $recipeCategories;

        return $this;
    }
}
