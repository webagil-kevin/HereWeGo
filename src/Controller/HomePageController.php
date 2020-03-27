<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Event;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     *
     * @return Response
     */
    public function index(): Response
    {
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();
        $eventsBestPopularity = $this->getDoctrine()->getRepository(Event::class)->findBestPopularity(4);

        return $this->render('homepage/index.html.twig', [
            'categories'           => $categories,
            'eventsBestPopularity' => $eventsBestPopularity,
        ]);
    }
}