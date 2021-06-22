<?php

namespace App\Controller\Admin;

use App\Entity\RecipeCategories;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
class RecipeCategoriesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return RecipeCategories::class;
    }


    // public function configureFields(string $pageName): iterable
    // {
    //     return [
    //         yield IdField::new('id')->hideOnForm(),
    //         yield Text
    //     ];
    // }

}
