<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\Categories;
use App\Repository\ArticlesRepository;
use App\Repository\CategoriesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
  #[Route('/', name: 'app_home')]
  public function index(ArticlesRepository $articlesRepository, CategoriesRepository $categoriesRepository): Response
  {
    return $this->render('home/index.html.twig', [
      'articles' => $articlesRepository->findAll(),
      'categories' => $categoriesRepository->findAll(),
    ]);
  }

  #[Route('/article/{id}', name: 'article_show')]
  public function show(?Articles $article): Response
  {
    if (!$article) {
      return $this->redirectToRoute('app_home');
    }
    return $this->render('home/show.html.twig', [
      'article' => $article
    ]);
  }


  #[Route('/articlesByCategory/{id}', name: 'articles_by_category')]
  public function articlesByCategory(?Categories $category, CategoriesRepository $categoriesRepository): Response
  {
    if (!$category) {
      return $this->redirectToRoute('app_home');
    }
    return $this->render('home/index.html.twig', [
      'articles' => $category->getArticles()->getValues(),
      'categories' => $categoriesRepository->findAll(),
    ]);
  }
}
