<?php

namespace App\Controller;

use App\Service\CalculationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DefaultController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function homepage(): Response
    {
        return $this->render('homepage.html.twig');
    }

    #[Route('/api/shipping/calculate', name: 'calculate', methods: ['POST'])]
    public function calculate(
        Request $request,
        CalculationService $calculation,
    ): JsonResponse {

        if ($calculation->isValid($request)) {
            $price = $calculation->calculate();
            if(null === $price) {
                return $this->json(['error' => 'Unsupported carrier',]);
            }

            return $this->json([
                'carrier' => $calculation->getCarrier(),
                'weight' => $calculation->getWeight(),
                'currency' => 'EUR',
                'price' => $price
            ]);
        }

        return $this->json(['error' => 'Unsupported carrier',]);
    }
}
