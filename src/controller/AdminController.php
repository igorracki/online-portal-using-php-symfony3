<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 2016-04-13
 * Time: 11:42
 */

namespace IgorITB\controller;

use IgorITB\Model\Project;
use IgorITB\Model\ProjectHasUser;
use IgorITB\Model\Role;
use IgorITB\Model\User;
use IgorITB\Model\UserHasProject;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AdminController providing and processing actions for admin routes.
 * @package IgorITB\Controller
 */
class AdminController
{
    /**
     * Function to provide action for /addUser route.
     * @param Request $request
     * @param Application $app
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addUserAction(Request $request, Application $app)
    {
        if ($app['session']->get('user') != null) {
            return $app['twig']->render('newUserForm.html.twig', $app['session']->get('user'));
        } else {
            return $app->redirect('/login');
        }
    }

    /**
     * Function to provide action for /newProject route.
     * @param Request $request
     * @param Application $app
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function newProjectAction(Request $request, Application $app)
    {
        if ($app['session']->get('user') != null) {
            // Building an array of variables to be sent to the template.
            $activeUser = $app['session']->get('user');
            $listOfUsers = User::getAll();
            $argsArray = array(
                'id' => $activeUser['id'],
                'name' => $activeUser['name'],
                'username' => $activeUser['username'],
                'type' => $activeUser['type'],
                'listOfUsers' => $listOfUsers
            );
            return $app['twig']->render('addProjectForm.html.twig', $argsArray);
        } else {
            return $app->redirect('/login');
        }
    }

    /**
     * Function to process the /addUser route and add a user to the database.
     * @param Request $request
     * @param Application $app
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function processAddUser(Request $request, Application $app)
    {
        // Building an array of variables to be sent to the template.
        $activeUser = $app['session']->get('user');
        $argsArray = array(
            'id' => $activeUser['id'],
            'name' => $activeUser['name'],
            'username' => $activeUser['username'],
            'type' => $activeUser['type']
        );

        // Storing input from the form.
        $name = filter_input(INPUT_POST, 'name');
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');
        // Hashing the password.
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT, ['cost'=>12]);

        // Creating a new User object.
        $newUser = new User();
        $newUser->setName($name);
        $newUser->setUsername($username);
        $newUser->setPassword($hashedPassword);
        $newUser->setType('user');
        // Inserting the new user object to the database.
        $insertedUser = User::insert($newUser);

        // Checking if the user has been added to the database.
        if ($insertedUser > 0) {
            return $app->redirect('/');
        } else {
            $argsArray['message'] = 'Failed to add user!';
            return $app['twig']->render('newUserForm.html.twig', $argsArray);
        }
    }

    /**
     * Function to process the /newProject route and a new project to the database.
     * @param Request $request
     * @param Application $app
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function processNewProject(Request $request, Application $app)
    {
        // Building an array of variables to be sent to the template.
        $activeUser = $app['session']->get('user');
        $listOfUsers = User::getAll();
        $argsArray = array(
            'id' => $activeUser['id'],
            'name' => $activeUser['name'],
            'username' => $activeUser['username'],
            'type' => $activeUser['type'],
            'listOfUsers' => $listOfUsers
        );

        // Storing input from the form.
        $name = filter_input(INPUT_POST, 'name');
        $leader = filter_input(INPUT_POST, 'leader');
        $secretary = filter_input(INPUT_POST, 'secretary');

        // A temporary array to store the IDs of the leader and the secretary.
        $projectMembers = array(
            'leader' => $leader,
            'secretary' => $secretary
        );

        if ($leader != $secretary) {
            // Creating a new Project object.
            $newProject = new Project();
            $newProject->setName($name);
            $newProject->setLocked(0);

            $newProjectID = Project::insert($newProject);

            // Creating new UserHasProject objects for each User.
            foreach ($projectMembers as $projectMember) {
                $newProjectForUser = new UserHasProject();
                $newProjectForUser->setUserId($projectMember);
                $newProjectForUser->setProjectId($newProjectID);
                // Setting the correct role for each user.
                if ($projectMember === $leader) {
                    $role = Role::searchByColumn('role', 'Project Leader')[0]->getId();
                } elseif ($projectMember === $secretary) {
                    $role = Role::searchByColumn('role', 'Project Secretary')[0]->getId();
                }
                $newProjectForUser->setRoleId($role);

                $newProjectForUserID = UserHasProject::insert($newProjectForUser);
            }
            // Checking if the objects have been added to the database.
            if ($newProjectID > 0 && $newProjectForUserID > 0) {
                return $app->redirect('/');
            } else {
                $argsArray['message'] = 'Could not create the project. Try again.';
                return $app['twig']->render('addProjectForm.html.twig', $argsArray);
            }
        } else {
            $argsArray['message'] = 'Project leader cannot be project secretary!';
            return $app['twig']->render('addProjectForm.html.twig', $argsArray);
        }
    }

    /**
     * Function to process the /projectStatus route and update the project's status.
     * @param Request $request
     * @param Application $app
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function processProjectStatus(Request $request, Application $app)
    {
        // Building an array of variables to be sent to the template.
        $activeUser = $app['session']->get('user');
        $argsArray = array(
            'id' => $activeUser['id'],
            'name' => $activeUser['name'],
            'username' => $activeUser['username'],
            'type' => $activeUser['type'],
        );

        // Storing input from the form.
        $projectID = filter_input(INPUT_POST, 'projectID');
        $status = filter_input(INPUT_POST, 'status');

        // Getting the current project.
        $currentProject = Project::getOneById($projectID);

        // Creating a new Project object, to update the existing Project in the database.
        $updateProject = new Project();
        $updateProject->setId($currentProject->getId());
        $updateProject->setName($currentProject->getName());
        if ($status == 0) {
            $updateProject->setLocked(1);
        } else {
            $updateProject->setLocked(0);
        }
        Project::update($updateProject);

        return $app->redirect('/');
    }
}
