<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 2016-04-28
 * Time: 14:42
 */

namespace IgorITB\model;

use Mattsmithdev\PdoCrud\DatabaseTable;

/**
 * Class Meeting representing a Database Table of Meetings.
 * @package IgorITB\Model
 */
class Meeting extends DatabaseTable
{
    /**
     * Variable to store the Meeting ID.
     * @var int $id
     */
    private $id;
    /**
     * Variable to store the meeting's Project ID.
     * @var int $projectId
     */
    private $projectId;
    /**
     * Variable to store the meeting's Chair ID.
     * @var int $chairId
     */
    private $chairId;
    /**
     * Variable to store the meeting's Secretary ID.
     * @var int $secretaryId
     */
    private $secretaryId;
    /**
     * Variable to store the meeting's Time Stamp.
     * @var int $time
     */
    private $time;
    /**
     * Variable to store the meeting's Room.
     * @var int $room
     */
    private $room;
    /**
     * Variable to store the meeting's Agenda Deadline Time Stamp.
     * @var string $agendaDeadline
     */
    private $agendaDeadline;

    /**
     * Getter function for ID.
     * @return int $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Setter function for ID.
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Getter function for Project ID.
     * @return int $projectId
     */
    public function getProjectId()
    {
        return $this->projectId;
    }

    /**
     * Setter function for Project ID.
     * @param int $projectId
     */
    public function setProjectId($projectId)
    {
        $this->projectId = $projectId;
    }

    /**
     * Getter function for Meeting Chair ID.
     * @return int $chairId
     */
    public function getChairId()
    {
        return $this->chairId;
    }

    /**
     * Setter function for Meeting Chair ID.
     * @param int $chairId
     */
    public function setChairId($chairId)
    {
        $this->chairId = $chairId;
    }

    /**
     * Getter function for Secretary ID.
     * @return int $secretaryId
     */
    public function getSecretaryId()
    {
        return $this->secretaryId;
    }

    /**
     * Setter function for Secretary ID.
     * @param int $secretaryId
     */
    public function setSecretaryId($secretaryId)
    {
        $this->secretaryId = $secretaryId;
    }

    /**
     * Getter function for Meeting Time.
     * @return int $time
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Setter function for Meeting Time.
     * @param int $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }

    /**
     * Getter function for Meeting Room.
     * @return string $room
     */
    public function getRoom()
    {
        return $this->room;
    }

    /**
     * Setter function for Meeting Room.
     * @param string $room
     */
    public function setRoom($room)
    {
        $this->room = $room;
    }

    /**
     * Getter function for Meeting's Agenda Deadline Time.
     * @return int $agendaDeadline
     */
    public function getAgendaDeadline()
    {
        return $this->agendaDeadline;
    }

    /**
     * Setter function for Meeting's Agenda Deadline Time.
     * @param int $agendaDeadline
     */
    public function setAgendaDeadline($agendaDeadline)
    {
        $this->agendaDeadline = $agendaDeadline;
    }
}
