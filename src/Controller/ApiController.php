<?php

namespace App\Controller;

use App\Service\SearchService;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    private SearchService $dataSearch;

    public function __construct(SearchService $dataSearch)
    {
        $this->dataSearch = $dataSearch;
    }

    /** @Route("/statistics") */
    public function statistics(Request $request): Response
    {
        $date = DateTime::createFromFormat('Y-m-d', $request->get('date'));
        if (!$date) {
            $date = null;
        }

        return new JsonResponse($this->dataSearch->retrieveData($date));
    }
}
