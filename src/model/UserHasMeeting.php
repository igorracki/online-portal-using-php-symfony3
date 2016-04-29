<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 2016-04-28
 * Time: 18:16
 */

namespace IgorITB\model;

use Mattsmithdev\PdoCrud\DatabaseTable;

/**
 * Class UserHasMeeting representing a Database Table of UserHasMeetings.
 * @package IgorITB\Model
 */
class UserHasMeeting extends DatabaseTable
{
    /**
     * Variable storing the ID.
     * @var int $id
     */
    private $id;
    /**
     * Variable storing the Meeting ID.
     * @var int $meetingId
     */
    private $meetingId;
    /**
     * Variable storing the User ID.
     * @var int $userId
     */
    private $userId;
    /**
     * Variable storing the User's attendance.
     * @var string $attendance
     */
    private $attendance;

    /**
     * Getter function for the ID.
     * @return int $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Setter function for the ID.
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Getter function for the Meeting ID.
     * @return int $meetingId
     */
    public function getMeetingId()
    {
        return $this->meetingId;
    }

    /**
     * Setter function for the Meeting ID.
     * @param int $meetingId
     */
    public function setMeetingId($meetingId)
    {
        $this->meetingId = $meetingId;
    }

    /**
     * Getter function for the User ID.
     * @return int $userId
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Setter function for the User ID.
     * @param int $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * Getter function for the User's Attendance.
     * @return string $attendance
     */
    public function getAttendance()
    {
        return $this->attendance;
    }

    /**
     * Setter function for the User's Attendance.
     * @param string $attendance
     */
    public function setAttendance($attendance)
    {
        $this->attendance = $attendance;
    }
}
