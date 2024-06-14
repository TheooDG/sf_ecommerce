<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class FrontController extends AbstractController
{
    #[Route('/{_locale<%app.supported_locales%>}', name: 'app_front')]
    public function index(ProductRepository $productRepository): Response
    {
        return $this->render('front/index.html.twig', [
            'products' => $productRepository->findByPriceRange(100, 150)
        ]);
    }

    #[Route('/{locale<%app.supported_locales%>}/product/{slug}', name: 'app_static_product')]
    public function product(#[MapEntity(mapping: ['slug' => 'slug'])] Product $product): Response
    {
        return $this->render('front/product.html.twig', [
            'product' => $product
        ]);
    }


#[Route('/{_locale<%app.supported_locales%>}/pages/{pageName}', name: 'app_static_page')]
    public function staticPage(string $_locale, string $pageName, Environment $twig): Response
    {
        $template = 'front/pages/' . $pageName . '.' . $_locale . '.html.twig';
        $loader = $twig->getLoader();
        if (!$loader->exists($template))
            throw new NotFoundHttpException();

        return $this->render($template, []);
    }
}
