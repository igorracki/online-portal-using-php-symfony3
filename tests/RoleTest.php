<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 2016-04-29
 * Time: 14:22
 */

namespace IgorITB\Test;

use IgorITB\Model\Role;

/**
 * Class RoleTest to test the Role object.
 * @package IgorITB\Test
 */
class RoleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test object creation.
     */
    public function testCanCreateObject()
    {
        // Arrange
        $role = new Role();
        // Act

        // Assert
        $this->assertNotNull($role);
    }

    /**
     * Test Setter and Getter for ID.
     */
    public function testSetGetId()
    {
        // Arrange
        $role = new Role();
        $expectedResult = 2;
        $role->setId($expectedResult);
        // Act
        $result = $role->getId();
        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * Test Setter and Getter for Role.
     */
    public function testSetGetRole()
    {
        // Arrange
        $role = new Role();
        $expectedResult = "Leader";
        $role->setRole($expectedResult);
        // Act
        $result = $role->getRole();
        // Assert
        $this->assertEquals($expectedResult, $result);
    }
}
