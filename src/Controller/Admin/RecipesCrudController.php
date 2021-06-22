<?php

namespace App\Controller\Admin;

use App\Entity\Recipes;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use App\Field\VichImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class RecipesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Recipes::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig')
            ->setEntityLabelInSingular('Recipes')
            ->setEntityLabelInPlural('Recipes')
            ->setSearchFields(['title', 'photo_filename', 'description', 'recipe_cooking'])
            ->setDefaultSort(['title' => 'DESC']);
        ;
    }



    public function configureFields(string $pageName): iterable
    {
        yield AssociationField::new('recipeCategories');
        yield TextField::new('title');
        yield ImageField::new('photo_filename', 'Image')
            ->onlyOnIndex()
            ->setBasePath('/images');

        // yield VichImageField::new('photo_filename')->hideOnForm();
        yield VichImageField::new('imageFile')->onlyOnForms();
        // yield VichImageField::new('imageFile');

        //yield TextField::new('photo_filename');
        //yield TextField::new('photo_filename');
        yield TextareaField::new('description');
        yield TextareaField::new('recipe_cooking')
             ->setFormType(CKEditorType::class)
             ->hideOnIndex();
        ;

    }

}
