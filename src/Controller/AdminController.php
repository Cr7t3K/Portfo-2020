<?php

namespace App\Controller;

use App\Entity\Page;
use App\Entity\Project;
use App\Entity\Skill;
use App\Entity\Team;
use App\Form\PageType;
use App\Form\ProjectType;
use App\Form\SkillType;
use App\Form\TeamType;
use App\Repository\MessageRepository;
use App\Repository\ProjectRepository;
use App\Repository\SkillRepository;
use App\Repository\TeamRepository;
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
                dump($project);
                $this->getDoctrine()->getManager()->flush();

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


    /**
     * @Route("/dashboard/skills", name="skills")
     * @Route("/dashboard/skills/new", name="skill_new")
     * @Route("/dashboard/skills/{skill}", name="skill_edit")
     */
    public function skills(
        SkillRepository $skillRepository,
        ProjectRepository $projectRepository,
        ?Request $request,
        ?Skill $skill
    ) {
        $currentRoute = $request->attributes->get('_route');

        $currentSkill = ($skill)? $skill:null;
        $formCreate = $newSkill = null;

        if ($currentRoute == "admin_skill_new") {
            $skill = new Skill();
            $form = $this->createForm(SkillType::class, $skill);
            $form->handleRequest($request);
            $formCreate = $form->createView();

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($skill);
                $entityManager->flush();

                return $this->redirectToRoute('admin_skills');
            }
        }

        if ($skill) {
            $form = $this->createForm(SkillType::class, $skill);
            $form->handleRequest($request);
            $formCreate = $form->createView();

            if ($form->isSubmitted() && $form->isValid()) {
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('admin_skills');
            }
        }

        return $this->render('admin/index.html.twig', [
            'projects' => $projectRepository->findAll(),
            'skills' => $skillRepository->findAll(),
            'currentSkill' => $currentSkill,
            'formSkill' => $formCreate,
        ]);

    }

    /**
     * @Route("/dashboard/teams", name="teams")
     * @Route("/dashboard/teams/new", name="team_new")
     * @Route("/dashboard/teams/{team}", name="team_edit")
     */
    public function teams(
        TeamRepository $teamRepository,
        ProjectRepository $projectRepository,
        ?Request $request,
        ?Team $team
    ) {
        $currentRoute = $request->attributes->get('_route');
        dump($currentRoute);

        $currentTeam = ($team)? $team:null;
        $formCreate = $newTeam = null;

        if ($currentRoute == "admin_team_new") {
            $team = new Team();
            $form = $this->createForm(TeamType::class, $team);
            $form->handleRequest($request);
            $formCreate = $form->createView();

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($team);
                $entityManager->flush();

                return $this->redirectToRoute('admin_teams');
            }
        }

        if ($team) {
            $form = $this->createForm(TeamType::class, $team);
            $form->handleRequest($request);
            $formCreate = $form->createView();

            if ($form->isSubmitted() && $form->isValid()) {
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('admin_teams');
            }
        }

        return $this->render('admin/index.html.twig', [
            'projects' => $projectRepository->findAll(),
            'teams' => $teamRepository->findAll(),
            'currentTeam' => $currentTeam,
            'formTeam' => $formCreate,
        ]);

    }

    /**
     * @Route("/dashboard/messages", name="messages")
     */
    public function messages(
        MessageRepository $messageRepository,
        ProjectRepository $projectRepository,
        ?Request $request
    ) {

        return $this->render('admin/index.html.twig', [
            'projects' => $projectRepository->findAll(),
            'messages' => $messageRepository->findAll()
        ]);

    }

}
