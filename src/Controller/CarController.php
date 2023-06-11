<?php

namespace App\Controller;

use App\Entity\CarCategory;
use App\Form\SearchType;
use App\Model\SearchData;
use App\Repository\CarRepository;
use App\Service\WeatherDisplay;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarController extends AbstractController
{
    #[Route('/', name: 'home', methods: ['GET'])]
    public function index(CarRepository $carRepository, PaginatorInterface $paginator, Request $request, WeatherDisplay $weatherDisplay): Response
    {
        $cars = $paginator->paginate(
            $carRepository->findAll(),
            $request->query->getInt('page', 1),
            20
        );

        $searchData = new SearchData();
        $form = $this->createForm(SearchType::class, $searchData);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $searchData->page = $request->query->getInt('page', 1);
            $cars = $carRepository->findBySearch($searchData);
    
            return $this->render('home.html.twig', [
                'form' => $form->createView(),
                'cars' => $cars,
                'weather' => $weatherDisplay->weatherPerHour(),
            ]);
        }

        return $this->render('home.html.twig', [
            'cars' => $cars,
            'form' => $form->createView(),
            'weather' => $weatherDisplay->weatherPerHour(),
        ]);
    }
}
