<?php
require_once __DIR__ . '/../app/setup.php';
require_once __DIR__ . '/../app/dbConnect.php';

$app->get('/', 'IgorITB\Controller\MainController::indexAction');
$app->get('/login', 'IgorITB\Controller\LoginController::loginAction');
$app->get('/logout', 'IgorITB\Controller\LoginController::logoutAction');
$app->get('/addUser', 'IgorITB\Controller\AdminController::addUserAction');
$app->get('/newProject', 'IgorITB\Controller\AdminController::newProjectAction');
$app->get('/project/{projectId}', 'IgorITB\Controller\MainController::showProjectAction');
$app->get('/newRole/{projectID}', 'IgorITB\Controller\LeaderController::newRoleAction');
$app->get('/addMember/{projectID}', 'IgorITB\Controller\LeaderController::addMemberAction');
$app->get('/newMeeting/{projectID}', 'IgorITB\Controller\MeetingController::newMeetingAction');
$app->get('/showMeeting/{meetingID}/{projectID}', 'IgorITB\Controller\MeetingController::showMeetingAction');

$app->post('/login', 'IgorITB\Controller\LoginController::processLogin');
$app->post('/addUser', 'IgorITB\Controller\AdminController::processAddUser');
$app->post('/newProject', 'IgorITB\Controller\AdminController::processNewProject');
$app->post('/projectStatus', 'IgorITB\Controller\AdminController::processProjectStatus');
$app->post('/newRole', 'IgorITB\Controller\LeaderController::processNewRole');
$app->post('/addMember', 'IgorITB\Controller\LeaderController::processAddMember');
$app->post('/newMeeting', 'IgorITB\Controller\MeetingController::processNewMeeting');
$app->post('/changeAttendance', 'IgorITB\Controller\MeetingController::processChangeAttendance');

$app['debug'] = true;
$app->run();


// Handle errors
/*
$app->error(function (\Exception $e, $code) use ($app){
    $errorController = new \IgorITB\MainController();
    return $errorController->errorAction($app, $code);
});
*/
