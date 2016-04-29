<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 2016-04-07
 * Time: 14:39
 */

namespace IgorITB\controller;

use IgorITB\Model\Meeting;
use IgorITB\Model\Member;
use IgorITB\Model\Project;
use IgorITB\Model\Role;
use IgorITB\Model\User;
use IgorITB\Model\UserHasProject;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class MainController providing and processing actions for main routes.
 * @package IgorITB\Controller
 */
class MainController
{
    /**
     * Function to provide action for / (index) route.
     * @param Request $request
     * @param Application $app
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function indexAction(Request $request, Application $app)
    {
        if ($app['session']->get('user') != null) {
            $activeUser = $app['session']->get('user');
            $allProjects = array();

            // Display the projects.
            if ($activeUser['name'] == 'Admin') {
                $allProjects = Project::getAll();
            } else {
                $userInProjects = UserHasProject::searchByColumn('userId', $activeUser['id']);
                foreach ($userInProjects as $userInProject) {
                    array_push($allProjects, Project::getOneById($userInProject->getProjectId()));
                }
            }

            // Building an array of variables to be sent to the template.
            $argsArray = array(
                'id' => $activeUser['id'],
                'name' => $activeUser['name'],
                'username' => $activeUser['username'],
                'type' => $activeUser['type'],
                'allProjects' => $allProjects
            );
            return $app['twig']->render('index.html.twig', $argsArray);
        } else {
            return $app->redirect('/login');
        }
    }

    /**
     * Function to provide action for /project/projectID route.
     * @param Request $request
     * @param Application $app
     * @param $projectId
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function showProjectAction(Request $request, Application $app, $projectId)
    {
        if ($app['session']->get('user') != null) {
            $activeUser = $app['session']->get('user');
            $isLeader = false;

            $project = Project::getOneById($projectId);
            $usersInProject = UserHasProject::searchByColumn('projectId', $projectId);
            $meetingsForProject = Meeting::searchByColumn('projectId', $projectId);
            $meetings = array();
            $members = array();

            // Creating an array of project members.
            foreach ($usersInProject as $userInProject) {
                $currentUser = User::getOneById($userInProject->getUserId());
                $currentRole = Role::getOneById($userInProject->getRoleId());
                $currentMember = new Member();
                $currentMember->setMemberName($currentUser->getName());
                $currentMember->setMemberRole($currentRole->getRole());

                array_push($members, $currentMember);
            }

            // Checking if the logged in user is the project's leader.
            $leaderRole = Role::searchByColumn('role', 'Project Leader');
            $userInCurrentProject = UserHasProject::searchByColumn('projectId', $projectId);
            foreach ($userInCurrentProject as $userInProject) {
                if ($userInProject->getUserId() == $activeUser['id'] && $userInProject->getRoleId() == $leaderRole[0]->getId()) {
                    $isLeader = true;
                }
            }

            // Creating a list of project's meetings.
            $dateFormat = 'H:i - d/m/Y';
            foreach ($meetingsForProject as $meetingForProject) {
                $meeting = array();
                $meeting['id'] = $meetingForProject->getId();
                $meeting['chair'] = User::getOneById($meetingForProject->getChairId())->getName();
                $meeting['secretary'] = User::getOneById($meetingForProject->getSecretaryId())->getName();
                // Reading the timestamp.
                $meetingTime = new \DateTime();
                $meetingTime->setTimestamp($meetingForProject->getTime());
                $meeting['time'] = $meetingTime->format($dateFormat);

                $meeting['room'] = $meetingForProject->getRoom();
                // Reading the timestamp.
                $agendaTime = new \DateTime();
                $agendaTime->setTimestamp($meetingForProject->getAgendaDeadline());
                $meeting['agendaDeadline'] = $agendaTime->format($dateFormat);

                array_push($meetings, $meeting);
            }

            // Building an array of variables to be sent to the template.
            $argsArray = array(
                'id' => $activeUser['id'],
                'name' => $activeUser['name'],
                'username' => $activeUser['username'],
                'type' => $activeUser['type'],
                'project' => $project,
                'members' => $members,
                'meetings' => $meetings,
                'isLeader' => $isLeader
            );
            return $app['twig']->render('showProject.html.twig', $argsArray);
        } else {
            return $app->redirect('/login');
        }
    }
}
