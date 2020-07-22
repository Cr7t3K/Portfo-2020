<?php

namespace App\Controller;

use App\Repository\PageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(PageRepository $pageRepository) : Response
    {
        $homePage = $pageRepository->findOneBy(["name" => "index"]);
        dump($homePage);
        return $this->render("home/index.html.twig", [
            "homePage" => $homePage
        ]);
    }

}
