<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 2016-04-29
 * Time: 14:30
 */

namespace IgorITB\Test;

use IgorITB\Model\UserHasMeeting;

/**
 * Class UserHasMeetingTest to test the UserHasMeeting object.
 * @package IgorITB\Test
 */
class UserHasMeetingTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test object creation.
     */
    public function testCanCreateObject()
    {
        // Arrange
        $u = new UserHasMeeting();
        // Act

        // Assert
        $this->assertNotNull($u);
    }

    /**
     * Test Setter and Getter for ID.
     */
    public function testSetGetId()
    {
        // Arrange
        $u = new UserHasMeeting();
        $expectedResult = 2;
        $u->setId($expectedResult);
        // Act
        $result = $u->getId();
        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * Test Setter and Getter for Meeting ID.
     */
    public function testSetGetMeetingId()
    {
        // Arrange
        $u = new UserHasMeeting();
        $expectedResult = 2;
        $u->setMeetingId($expectedResult);
        // Act
        $result = $u->getMeetingId();
        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * Test Setter and Getter for User ID.
     */
    public function testSetGetUserId()
    {
        // Arrange
        $u = new UserHasMeeting();
        $expectedResult = 2;
        $u->setUserId($expectedResult);
        // Act
        $result = $u->getUserId();
        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * Test Setter and Getter for Attendance.
     */
    public function testSetGetAttendance()
    {
        // Arrange
        $u = new UserHasMeeting();
        $expectedResult = "Yes";
        $u->setAttendance($expectedResult);
        // Act
        $result = $u->getAttendance();
        // Assert
        $this->assertEquals($expectedResult, $result);
    }
}
