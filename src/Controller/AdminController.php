<?php

namespace App\Controller;

use App\Entity\Page;
use App\Entity\Project;
use App\Form\PageType;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminController
 * @Route("/admin", name="admin_")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard")
     * @Route("/dashboard/project/new", name="project_new")
     * @Route("/dashboard/project/{project}", name="project_edit")
     * @Route("/dashboard/page/{page}", name="page_edit")
     */
    public function index(
        ProjectRepository $projectRepository,
        ?Project $project,
        ?Request $request,
        ?Page $page
    ) {
        $currentProject = ($project)? $project: null;
        $currentPage = ($page)? $page: null;
        $formCreate = $newProject = null;
        $currentRoute = $request->attributes->get('_route');

        if ($currentRoute == "admin_project_new") {
            $project = new Project();
            $newProject = ['t'];
            $form = $this->createForm(ProjectType::class, $project);
            $form->handleRequest($request);
            $formCreate = $form->createView();

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $repo = explode("/", $project->getGithub());
                $project->setNameRepo(end($repo));
                $entityManager->persist($project);
                $entityManager->flush();

                return $this->redirectToRoute('admin_project_edit', ['project' => $project->getId()]);
            }
        }

        if ($page) {
            $form = $this->createForm(PageType::class, $page);
            $form->handleRequest($request);
            $formCreate = $form->createView();

            if ($form->isSubmitted() && $form->isValid()) {
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('admin_page_edit', ['page' => $page->getId()]);
            }
        }


        if ($project) {
            $form = $this->createForm(ProjectType::class, $project);
            $form->handleRequest($request);
            $formCreate = $form->createView();

            if ($form->isSubmitted() && $form->isValid()) {
                $repo = explode("/", $project->getGithub());
                $project->setNameRepo(end($repo));

                $this->getDoctrine()->getManager()->flush();

                //return new Response("Ok");
                return $this->redirectToRoute('admin_project_edit', ['project' => $project->getId()]);
            }
        }

        return $this->render('admin/index.html.twig', [
            'projects' => $projectRepository->findAll(),
            'currentProject' => $currentProject,
            'newProject' => $newProject,
            'currentPage' => $currentPage,
            'form' => $formCreate,
        ]);
    }

}
