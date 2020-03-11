<?php

namespace App\Controller;

use App\Entity\City;
use App\Form\EventType;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/city")
 */
class CityController extends AbstractController
{
    /**
     * @Route("/", name="city_select")
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function countrySelectAction(Request $request): JsonResponse
    {

        $q = $request->get('q');
        $pageLimit = $request->get('page_limit');

        if (!is_numeric($pageLimit) || $pageLimit > 10) {
            $pageLimit = 10;
        }

        $cities = $this->getDoctrine()->getRepository(City::class)->findByPartialName($q, $pageLimit);

        $items = [];
        foreach($cities as $item) {
            $items[] = [
                'id' => $item->getId(),
                'text' => $item->getName() . ' (' . $item->getCp() . ')',
            ];
        }

        return new JsonResponse($items);
    }
}
