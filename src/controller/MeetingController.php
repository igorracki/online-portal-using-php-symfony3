<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 2016-04-28
 * Time: 14:59
 */

namespace IgorITB\controller;

use IgorITB\Model\Meeting;
use IgorITB\Model\Project;
use IgorITB\Model\Role;
use IgorITB\Model\User;
use IgorITB\Model\UserHasMeeting;
use IgorITB\Model\UserHasProject;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class MeetingController providing and processing actions for meeting routes.
 * @package IgorITB\Controller
 */
class MeetingController
{
    /**
     * Function to provide action for /newMeeting/projectID route.
     * @param Request $request
     * @param Application $app
     * @param $projectID
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function newMeetingAction(Request $request, Application $app, $projectID)
    {
        if ($app['session']->get('user') != null) {
            $activeUser = $app['session']->get('user');

            $users = User::getAll();
            $project = Project::getOneById($projectID);
            $currentDateAndTime = new \DateTime();

            // Building an array of variables to be sent to the template.
            $argsArray = array(
                'id' => $activeUser['id'],
                'name' => $activeUser['name'],
                'username' => $activeUser['username'],
                'type' => $activeUser['type'],
                'users' => $users,
                'project' => $project,
                'currentDate' => $currentDateAndTime->format('Y-m-d')
            );
            return $app['twig']->render('newMeetingForm.html.twig', $argsArray);
        } else {
            return $app->redirect('/');
        }
    }

    /**
     * Function to provide action for /showMeeting/meetingID/projectID route.
     * @param Request $request
     * @param Application $app
     * @param $meetingID
     * @param $projectID
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function showMeetingAction(Request $request, Application $app, $meetingID, $projectID)
    {
        if ($app['session']->get('user') != null) {
            $activeUser = $app['session']->get('user');

            $currentMeeting = Meeting::getOneById($meetingID);
            $currentUserHasMeetings = UserHasMeeting::searchByColumn('meetingId', $meetingID);
            $usersInProject = UserHasProject::searchByColumn('projectId', $projectID);
            $dateFormat = 'H:i - d/m/Y';
            $attendance = 'Pending';
            $projectMembers = count($usersInProject);
            $usersAttending = 0;
            $meeting = array();

            // Creating an array with the meeting's details.
            $meeting['id'] = $currentMeeting->getId();
            $meeting['chair'] = User::getOneById($currentMeeting->getChairId())->getName();
            $meeting['secretary'] = User::getOneById($currentMeeting->getSecretaryId())->getName();
            // Reading the timestamp.
            $meetingTime = new \DateTime();
            $meetingTime->setTimestamp($currentMeeting->getTime());
            $meeting['time'] = $meetingTime->format($dateFormat);

            $meeting['room'] = $currentMeeting->getRoom();
            // Reading the timestamp.
            $agendaTime = new \DateTime();
            $agendaTime->setTimestamp($currentMeeting->getAgendaDeadline());
            $meeting['agendaDeadline'] = $agendaTime->format($dateFormat);

            // Checking the attendances.
            foreach ($currentUserHasMeetings as $currentUserHasMeeting) {
                if ($currentUserHasMeeting->getUserId() == $activeUser['id']) {
                    $attendance = $currentUserHasMeeting->getAttendance();
                }
                if ($currentUserHasMeeting->getAttendance() == 'Yes') {
                    $usersAttending++;
                }
            }

            $attendancePercentage = ($usersAttending / $projectMembers) * 100;

            // Building an array of variables to be sent to the template.
            $argsArray = array(
                'id' => $activeUser['id'],
                'name' => $activeUser['name'],
                'username' => $activeUser['username'],
                'type' => $activeUser['type'],
                'meeting' => $meeting,
                'project' => Project::getOneById($projectID),
                'attendance' => $attendance,
                'attendancePercentage' => $attendancePercentage
            );
            return $app['twig']->render('showMeeting.html.twig', $argsArray);
        } else {
            return $app->redirect('/');
        }
    }

    /**
     * Function to process the /newMeeting route and add a meeting to the database.
     * @param Request $request
     * @param Application $app
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function processNewMeeting(Request $request, Application $app)
    {
        if ($app['session']->get('user') != null) {
            $activeUser = $app['session']->get('user');

            // Building an array of variables to be sent to the template.
            $argsArray = array(
                'id' => $activeUser['id'],
                'name' => $activeUser['name'],
                'username' => $activeUser['username'],
                'type' => $activeUser['type']
            );

            // Storing input from the form.
            $meetingChairID = filter_input(INPUT_POST, 'chair');
            $meetingSecretaryID = filter_input(INPUT_POST, 'secretary');
            $meetingDate = filter_input(INPUT_POST, 'meetingDate');
            $meetingTime = filter_input(INPUT_POST, 'meetingTime');
            $room = filter_input(INPUT_POST, 'room');
            $agendaDate = filter_input(INPUT_POST, 'agendaDate');
            $agendaTime = filter_input(INPUT_POST, 'agendaTime');
            $projectID = filter_input(INPUT_POST, 'projectID');

            $usersInProject = UserHasProject::searchByColumn('projectId', $projectID);
            $leaderRoleID = Role::searchByColumn('role', 'Project Leader');
            $secretaryRoleID = Role::searchByColumn('role', 'Project Secretary');

            // Create meeting time stamp
            $dateTimeFormat = 'Y-m-d H:i';
            $meetingTime = \DateTime::createFromFormat($dateTimeFormat, $meetingDate . ' ' . $meetingTime);
            $agendaDeadline = \DateTime::createFromFormat($dateTimeFormat, $agendaDate . ' ' . $agendaTime);

            $processInsert = true;
            $currentDateAndTime = new \DateTime();

            // Getting the default meeting chair.
            if ($meetingChairID == 0) {
                foreach ($usersInProject as $userInProject) {
                    if ($userInProject->getRoleId() === $leaderRoleID[0]->getId()) {
                        $meetingChairID = $userInProject->getUserId();
                    }
                }
            }
            // Getting the default meeting secretary.
            if ($meetingSecretaryID == 0) {
                foreach ($usersInProject as $userInProject) {
                    if ($userInProject->getRoleId() === $secretaryRoleID[0]->getId()) {
                        $meetingSecretaryID = $userInProject->getUserId();
                    }
                }
            }
            if ($meetingSecretaryID == $meetingChairID) {
                $processInsert = false;
            }

            // Create a new meeting and add it to the database.
            if ($processInsert) {
                $newMeeting = new Meeting();
                $newMeeting->setProjectId($projectID);
                $newMeeting->setChairId($meetingChairID);
                $newMeeting->setSecretaryId($meetingSecretaryID);
                $newMeeting->setTime($meetingTime->getTimestamp());
                $newMeeting->setRoom($room);
                $newMeeting->setAgendaDeadline($agendaDeadline->getTimestamp());
                $newMeetingID = Meeting::insert($newMeeting);

                if ($newMeetingID > 0) {
                    return $app->redirect('/project/'.$projectID);
                } else {
                    $argsArray['users'] = User::getAll();
                    $argsArray['project'] = Project::getOneById($projectID);
                    $argsArray['currentDate'] = $currentDateAndTime->format('Y-m-d');
                    $argsArray['message'] = 'Could not create the meeting.';
                    return $app['twig']->render('newMeetingForm.html.twig', $argsArray);
                }
            } else {
                $argsArray['users'] = User::getAll();
                $argsArray['project'] = Project::getOneById($projectID);
                $argsArray['currentDate'] = $currentDateAndTime->format('Y-m-d');
                $argsArray['message'] = 'Meeting Chair cannot be Meeting Secretary!';
                return $app['twig']->render('newMeetingForm.html.twig', $argsArray);
            }
        } else {
            return $app->redirect('/');
        }
    }

    /**
     * Function to process the /changeAttendance route and update attendance status for a user.
     * @param Request $request
     * @param Application $app
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function processChangeAttendance(Request $request, Application $app)
    {
        if ($app['session']->get('user') != null) {
            $activeUser = $app['session']->get('user');
            // Building an array of variables to be sent to the template.
            $argsArray = array(
                'id' => $activeUser['id'],
                'name' => $activeUser['name'],
                'username' => $activeUser['username'],
                'type' => $activeUser['type']
            );

            // Storing input from the form.
            $userID = filter_input(INPUT_POST, 'userID');
            $meetingID = filter_input(INPUT_POST, 'meetingID');
            $projectID = filter_input(INPUT_POST, 'projectID');
            $attendance = filter_input(INPUT_POST, 'attendance');

            $userHasMeetings = UserHasMeeting::searchByColumn('meetingId', $meetingID);
            $update = false;
            $updateUser = null;

            // Checking if that user already signed up for a meeting.
            foreach ($userHasMeetings as $userHasMeeting) {
                if ($userHasMeeting->getUserId() == $userID) {
                    $update = true;
                    $updateUser = $userHasMeeting;
                }
            }

            // Updating or creating a new record of the user's attendance.
            if ($update) {
                $usersMeeting = new UserHasMeeting();
                $usersMeeting->setId($userHasMeeting->getId());
                $usersMeeting->setMeetingId($userHasMeeting->getMeetingId());
                $usersMeeting->setUserId($userHasMeeting->getUserId());
                $usersMeeting->setAttendance($attendance);
                UserHasMeeting::update($usersMeeting);
            } else {
                $usersMeeting = new UserHasMeeting();
                $usersMeeting->setMeetingId($meetingID);
                $usersMeeting->setUserId($userID);
                $usersMeeting->setAttendance($attendance);
                $usersMeetingID = UserHasMeeting::insert($usersMeeting);
            }
            return $app->redirect('/showMeeting/'.$meetingID.'/'.$projectID);
        } else {
            return $app->redirect('/');
        }
    }
}
