<?php

namespace App\Controller;

use App\Repository\ScriptRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    #[Route('/accueil', name: 'app_index')]
    public function indexPage(ScriptRepository $scriptRepository): Response
    {
        $scripts = $scriptRepository->findAll();
        return $this->render('index/index.html.twig', [
            'scripts' => $scripts,
        ]);
    }
    #[Route('/script/{id}', name: 'app_script')]
    public function scriptPage($id, ScriptRepository $scriptRepository): Response
    {
        $script = $scriptRepository->findOneBy([ 'id' => $id]);

        return $this->render('act/index.html.twig', [
            'acts' => $script->getListAct(),
            'script' => $script
        ]);
    }
}
