<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 2016-04-16
 * Time: 16:48
 */

namespace IgorITB\controller;

use IgorITB\Model\Project;
use IgorITB\Model\Role;
use IgorITB\Model\User;
use IgorITB\Model\UserHasProject;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class LeaderController providing and processing actions for project leader routes.
 * @package IgorITB\Controller
 */
class LeaderController
{
    /**
     * Function to provide action for /newRole/projectID route.
     * @param Request $request
     * @param Application $app
     * @param $projectID
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function newRoleAction(Request $request, Application $app, $projectID)
    {
        if ($app['session']->get('user') != null) {
            // Building an array of variables to be sent to the template.
            $activeUser = $app['session']->get('user');
            $argsArray = array(
                'id' => $activeUser['id'],
                'name' => $activeUser['name'],
                'username' => $activeUser['username'],
                'type' => $activeUser['type'],
                'projectID' => $projectID
            );
            return $app['twig']->render('newRoleForm.html.twig', $argsArray);
        } else {
            return $app->redirect('/');
        }
    }

    /**
     * Function to provide action for /addMember/projectID route.
     * @param Request $request
     * @param Application $app
     * @param $projectID
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addMemberAction(Request $request, Application $app, $projectID)
    {
        if ($app['session']->get('user') != null) {
            // Building an array of variables to be sent to the template.
            $activeUser = $app['session']->get('user');
            $project = Project::getOneById($projectID);
            $users = User::getAll();
            $roles = Role::getAll();

            $argsArray = array(
                'id' => $activeUser['id'],
                'name' => $activeUser['name'],
                'username' => $activeUser['username'],
                'type' => $activeUser['type'],
                'project' => $project,
                'users' => $users,
                'roles' => $roles
            );

            return $app['twig']->render('addMemberForm.html.twig', $argsArray);
        } else {
            return $app->redirect('/');
        }
    }

    /**
     * Function to process the /addMember route and add a member to the database.
     * @param Request $request
     * @param Application $app
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function processAddMember(Request $request, Application $app)
    {
        if ($app['session']->get('user') != null) {
            // Building an array of variables to be sent to the template.
            $activeUser = $app['session']->get('user');
            $argsArray = array(
                'id' => $activeUser['id'],
                'name' => $activeUser['name'],
                'username' => $activeUser['username'],
                'type' => $activeUser['type']
            );

            // Storing input from the form.
            $projectID = filter_input(INPUT_POST, 'projectID');
            $userID = filter_input(INPUT_POST, 'user');
            $roleID = filter_input(INPUT_POST, 'role');
            $processInsert = true;

            // Checking if the user is already a member of this project.
            $usersInProject = UserHasProject::searchByColumn('projectId', $projectID);
            foreach ($usersInProject as $userInProject) {
                if ($userInProject->getUserId() === $userID) {
                    $argsArray['message'] = User::getOneById($userID)->getName() . ' is already a member of this project!';
                    $processInsert = false;
                }
            }

            // If the user isn't a member, add a new member.
            if ($processInsert) {
                $newMember = new UserHasProject();
                $newMember->setProjectId($projectID);
                $newMember->setUserId($userID);
                $newMember->setRoleId($roleID);
                $newMemberID = UserHasProject::insert($newMember);

                if ($newMemberID > 0) {
                    return $app->redirect('/project/'.$projectID);
                } else {
                    $argsArray['project'] = Project::getOneById($projectID);
                    $argsArray['users'] = User::getAll();
                    $argsArray['roles'] = Role::getAll();
                    $argsArray['message'] = 'Failed to add new member!';
                    return $app['twig']->render('addMemberForm.html.twig', $argsArray);
                }
            } else {
                $argsArray['project'] = Project::getOneById($projectID);
                $argsArray['users'] = User::getAll();
                $argsArray['roles'] = Role::getAll();
                return $app['twig']->render('addMemberForm.html.twig', $argsArray);
            }
        } else {
            return $app->redirect('/');
        }
    }

    /**
     * Function to process the /newRole route and add a role to the database.
     * @param Request $request
     * @param Application $app
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function processNewRole(Request $request, Application $app)
    {
        if ($app['session']->get('user') != null) {
            // Building an array of variables to be sent to the template.
            $activeUser = $app['session']->get('user');
            $argsArray = array(
                'id' => $activeUser['id'],
                'name' => $activeUser['name'],
                'username' => $activeUser['username'],
                'type' => $activeUser['type']
            );
            // Storing input from the form.
            $roleName = filter_input(INPUT_POST, 'roleName');
            $currentProjectID = filter_input(INPUT_POST, 'projectID');

            // Creating a new role and adding it to the database.
            $role = new Role();
            $role->setRole($roleName);
            $newRoleID = Role::insert($role);

            if ($newRoleID > 0) {
                return $app->redirect('/project/' . $currentProjectID);
            } else {
                $argsArray['message'] = 'Failed to add new role!';
                return $app['twig']->redner('newRoleForm.html.twig', $argsArray);
            }
        } else {
            return $app->redirect('/');
        }
    }
}
