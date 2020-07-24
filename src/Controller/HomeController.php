<?php

namespace App\Controller;

use App\Entity\Message;
use App\Form\MessageType;
use App\Repository\PageRepository;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

        return $this->render("home/index.html.twig", [
            "homePage" => $homePage,
            "projects" => $projects,
        ]);
    }

    /**
     * @Route("/message/new", name="contact")
     */
    public function message(Request $request) : Response
    {
        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($message);
            $entityManager->flush();

            $this->addFlash('success', 'Message has been sent, you will be contacted as soon as possible');
            return $this->redirectToRoute('home');
        }

        return $this->render("home/contact.html.twig", [
            "message" => $message,
            "form" => $form->createView(),
        ]);
    }



}
