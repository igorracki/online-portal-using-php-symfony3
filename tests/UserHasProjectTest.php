<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 2016-04-29
 * Time: 14:34
 */

namespace IgorITB\Test;

use IgorITB\Model\UserHasProject;

/**
 * Class UserHasProjectTest to test the UserHasProject object.
 * @package IgorITB\Test
 */
class UserHasProjectTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test object creation.
     */
    public function testCanCreateObject()
    {
        // Arrange
        $u = new UserHasProject();
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
        $u = new UserHasProject();
        $expectedResult = 2;
        $u->setId($expectedResult);
        // Act
        $result = $u->getId();
        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * Test Setter and Getter for User ID.
     */
    public function testSetGetUserId()
    {
        // Arrange
        $u = new UserHasProject();
        $expectedResult = 2;
        $u->setUserId($expectedResult);
        // Act
        $result = $u->getUserId();
        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * Test Setter and Getter for Project ID.
     */
    public function testSetGetProjectId()
    {
        // Arrange
        $u = new UserHasProject();
        $expectedResult = 2;
        $u->setProjectId($expectedResult);
        // Act
        $result = $u->getProjectId();
        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * Test Setter and Getter for Role ID.
     */
    public function testSetGetRoleId()
    {
        // Arrange
        $u = new UserHasProject();
        $expectedResult = 2;
        $u->setRoleId($expectedResult);
        // Act
        $result = $u->getRoleId();
        // Assert
        $this->assertEquals($expectedResult, $result);
    }
}
