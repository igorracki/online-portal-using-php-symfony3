<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 2016-04-29
 * Time: 13:50
 */

namespace IgorITB\Test;

use IgorITB\Model\Meeting;

/**
 * Class MeetingTest to test the Meeting object.
 * @package IgorITB\Test
 */
class MeetingTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test object creation.
     */
    public function testCanCreateObject()
    {
        // Arrange
        $meeting = new Meeting();
        // Act

        // Assert
        $this->assertNotNull($meeting);
    }

    /**
     * Test Setter and Getters for ID.
     */
    public function testSetGetId()
    {
        // Arrange
        $meeting = new Meeting();
        $expectedResult = 2;
        $meeting->setId($expectedResult);
        // Act
        $result = $meeting->getId();
        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * Test Setter and Getters for Project ID.
     */
    public function testSetGetProjectId()
    {
        // Arrange
        $meeting = new Meeting();
        $expectedResult = 2;
        $meeting->setProjectId($expectedResult);
        // Act
        $result = $meeting->getProjectId();
        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * Test Setter and Getters for Meeting Chair ID.
     */
    public function testSetGetChairId()
    {
        // Arrange
        $meeting = new Meeting();
        $expectedResult = 2;
        $meeting->setChairId($expectedResult);
        // Act
        $result = $meeting->getChairId();
        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * Test Setter and Getters for Meeting Secretary ID.
     */
    public function testSetGetSecretaryId()
    {
        // Arrange
        $meeting = new Meeting();
        $expectedResult = 2;
        $meeting->setSecretaryId($expectedResult);
        // Act
        $result = $meeting->getSecretaryId();
        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * Test Setter and Getters for Meeting Time.
     */
    public function testSetGetTime()
    {
        // Arrange
        $meeting = new Meeting();
        $expectedResult = 2;
        $meeting->setTime($expectedResult);
        // Act
        $result = $meeting->getTime();
        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * Test Setter and Getters for Meeting Room.
     */
    public function testSetGetRoom()
    {
        // Arrange
        $meeting = new Meeting();
        $expectedResult = "F202";
        $meeting->setRoom($expectedResult);
        // Act
        $result = $meeting->getRoom();
        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * Test Setter and Getters for Agenda Deadline.
     */
    public function testSetGetAgendaDeadline()
    {
        // Arrange
        $meeting = new Meeting();
        $expectedResult = 2;
        $meeting->setAgendaDeadline($expectedResult);
        // Act
        $result = $meeting->getAgendaDeadline();
        // Assert
        $this->assertEquals($expectedResult, $result);
    }
}
