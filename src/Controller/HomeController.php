<?php

namespace App\Controller;

use App\Repository\PageRepository;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(PageRepository $pageRepository, ProjectRepository $projectRepository) : Response
    {
        $homePage = $pageRepository->findOneBy(["name" => "index"]);
        $projects = $projectRepository->findAll();
        dump($projects);

        return $this->render("home/index.html.twig", [
            "homePage" => $homePage,
            "projects" => $projects,
        ]);
    }

}
