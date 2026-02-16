<?php

namespace App\Controller;

use App\Form\CalculationFormType;
use App\Service\CalculationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DefaultController extends AbstractController
{
    public function __construct(
        private CalculationService $calculation
    ){
    }

    #[Route('/', name: 'homepage')]
    public function homepage(Request $request): Response|array
    {
        $form =$this->createForm(CalculationFormType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            if ($this->calculation->isValid($data)) {
                $price = $this->calculation->calculate();

                if(null === $price) {
                    return $this->json(['error' => 'Unsupported carrier',]);
                }

                $result = [
                    'carrier' => $this->calculation->getCarrier(),
                    'weight' => $this->calculation->getWeight(),
                    'currency' => 'EUR',
                    'price' => $price,
                ];
            }
        }

        return $this->render('homepage.html.twig', [
            'form' => $form->createView(),
            'result' => $result ?? null,
        ]);
    }

    #[Route('/api/shipping/calculate', name: 'calculate', methods: ['POST'])]
    public function calculate(Request $request): JsonResponse
    {

        if ($this->calculation->isValid($request)) {
            $price = $this->calculation->calculate();
            if(null === $price) {
                return $this->json(['error' => 'Unsupported carrier',]);
            }

            return $this->json([
                'carrier' => $this->calculation->getCarrier(),
                'weight' => $this->calculation->getWeight(),
                'currency' => 'EUR',
                'price' => $price
            ]);
        }

        return $this->json(['error' => 'Unsupported carrier',]);
    }
}
