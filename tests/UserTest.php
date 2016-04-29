<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 2016-04-29
 * Time: 14:26
 */

namespace IgorITB\Test;

use IgorITB\Model\User;

/**
 * Class UserTest to test the User object.
 * @package IgorITB\Test
 */
class UserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test object creation.
     */
    public function testCanCreateObject()
    {
        // Arrange
        $user = new User();
        // Act

        // Assert
        $this->assertNotNull($user);
    }

    /**
     * Test Setter and Getter for ID.
     */
    public function testSetGetId()
    {
        // Arrange
        $user = new User();
        $expectedResult = 2;
        $user->setId($expectedResult);
        // Act
        $result = $user->getId();
        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * Test Setter and Getter for Name.
     */
    public function testSetGetName()
    {
        // Arrange
        $user = new User();
        $expectedResult = "Igor";
        $user->setName($expectedResult);
        // Act
        $result = $user->getName();
        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * Test Setter and Getter for Username.
     */
    public function testSetGetUsername()
    {
        // Arrange
        $user = new User();
        $expectedResult = "Igor";
        $user->setUsername($expectedResult);
        // Act
        $result = $user->getUsername();
        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * Test Setter and Getter for Password.
     */
    public function testSetGetPassword()
    {
        // Arrange
        $user = new User();
        $expectedResult = "1234";
        $user->setPassword($expectedResult);
        // Act
        $result = $user->getPassword();
        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * Test Setter and Getter for Type.
     */
    public function testSetGetType()
    {
        // Arrange
        $user = new User();
        $expectedResult = "user";
        $user->setType($expectedResult);
        // Act
        $result = $user->getType();
        // Assert
        $this->assertEquals($expectedResult, $result);
    }
}
