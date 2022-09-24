<?php

namespace App\Controller;

use App\Repository\ScriptRepository;
use MobileDetectBundle\DeviceDetector\MobileDetectorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/accueil', name: 'app_index')]
    public function index(ScriptRepository $scriptRepository): Response
    {
        $scripts = $scriptRepository->findAll();
        return $this->render('index/index.html.twig', [
            'scripts' => $scripts,
        ]);
    }
}
