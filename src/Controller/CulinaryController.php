<?php

namespace App\Controller;

use App\Entity\Recipes;
use App\Entity\RecipeCategories;
use App\Repository\RecipeCategoriesRepository;
use App\Repository\RecipesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\RoutInterfacee;
use Knp\Component\Pager\PaginatorInterface;
use Twig\Environment;
use App\Contoller\AddressButtonsController;

class CulinaryController extends AbstractController
{
  // string $buttons="<h3>TEST</h3";

    /**
     * @Route("/", name="homepage")
     */
    public function index(Environment $twig, RecipesRepository $recipesRepository, string $photoDir): Response
    {
        return new Response($twig->render('culinary/index.html.twig', [
            'recipes' => $recipesRepository->findAll(),
        ]));
    }


    /**
     * @Route("about", name="about")
    */
    public function about(Environment $twig, Request $request, string $photoDir):Response
    {
      $uri=$request->getBaseUrl();
      $image=$photoDir.'Alina Surova.jpeg';
      return new Response($twig->render('culinary/about.html.twig',[
        'photoDir'=>$image,
        'uri'=>$uri,
      ]));
    }

    /**
     * @Route("recipes/{slug}", name="recipes")
     */
     public function show(Environment $twig, RecipeCategories $categories, RecipesRepository $recipesRepository,
     PaginatorInterface $paginator, Request $request, string $photoDir): Response
     {

            $recipes = $paginator->paginate(
            $recipesRepository->findBy(['recipeCategories' => $categories]),
            $request->query->getInt('page', 1),
            8
          );
          return new Response($twig->render('culinary/show.html.twig', [
              'categories' => $categories,
              'recipes' => $recipes,
              'photoDir' => $photoDir,
          ]));
      }

      /**
       * @Route("cooking/{title}", name="cooking")
       */
      public function show_cooking(Environment $twig, string $title, RecipesRepository $recipesRepository, Recipes $recipes, Request $request): Response
      {
        $recipes = $recipesRepository->findBy(['title' => $title]);

        return new Response($twig->render('culinary/cooking.html.twig', [
          'title' => $title,
          'recipes' => $recipes,
        ]));

      }
    }
