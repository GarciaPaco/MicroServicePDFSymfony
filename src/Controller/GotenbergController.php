<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Services\CallApiService;

class GotenbergController extends AbstractController
{
    private CallApiService $callApiService;

    public function __construct(CallApiService $callApiService)
    {
        $this->callApiService = $callApiService;
    }

    #[Route('/urltopdf', name: 'app_gotenberg')]
    public function urlToPdf(Request $request): Response
    {
        $url = $request->get('url');
        $pdf = $this->callApiService->sendUrlToGotenberg($url);

        $response = new Response($pdf);
        $response->headers->set('Content-Type', 'application/pdf');

        return $response;
    }


}
