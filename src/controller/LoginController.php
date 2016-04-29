<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 2016-04-12
 * Time: 16:14
 */

namespace IgorITB\controller;

use IgorITB\Model\User;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class LoginController providing and processing actions for login routes.
 * @package IgorITB\Controller
 */
class LoginController
{
    /**
     * Function to provide action for /login route.
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function loginAction(Request $request, Application $app)
    {
        // Building an array of variables to be sent to the template.
        $argsArray = array();
        $templateName = 'login';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * Function to process the /login route.
     * @param Request $request
     * @param Application $app
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function processLogin(Request $request, Application $app)
    {
        // Storing input from the form.
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');

        $loginSuccessful = false;

        // Searching through the users and comparing the data.
        $listOfUsers = User::searchByColumn('username', $username);
        foreach ($listOfUsers as $user) {
            if ($user->getUsername() === $username && password_verify($password, $user->getPassword())) {
                // Building an array of variables to be sent to the template.
                $app['session']->set('user', array(
                    'id' => $user->getId(),
                    'name' => $user->getName(),
                    'username' => $user->getUsername(),
                    'type' => $user->getType()
                ));
                $loginSuccessful = true;
            }
        }

        if ($loginSuccessful) {
            return $app->redirect('/');
        } else {
            $argsArray = array(
                'errorMessage' => 'Username or password is incorrect!'
            );
            return $app['twig']->render('login.html.twig', $argsArray);
        }
    }

    /**
     * Function to provide action for /logout route.
     * @param Request $request
     * @param Application $app
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function logoutAction(Request $request, Application $app)
    {
        if ($app['session']->get('user') != null) {
            $app['session']->set('user', null);
        }
        return $app->redirect('/');
    }
}
