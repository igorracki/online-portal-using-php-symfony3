<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 2016-04-29
 * Time: 14:17
 */

namespace IgorITB\Test;

use IgorITB\Model\Project;

/**
 * Class ProjectTest to test the Project object.
 * @package IgorITB\Test
 */
class ProjectTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test object creation.
     */
    public function testCanCreateObject()
    {
        // Arrange
        $project = new Project();
        // Act

        // Assert
        $this->assertNotNull($project);
    }

    /**
     * Test Setter and Getter for ID.
     */
    public function testSetGetId()
    {
        // Arrange
        $project = new Project();
        $expectedResult = 2;
        $project->setId($expectedResult);
        // Act
        $result = $project->getId();
        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * Test Setter and Getter for Name.
     */
    public function testSetGetName()
    {
        // Arrange
        $project = new Project();
        $expectedResult = "Igor";
        $project->setName($expectedResult);
        // Act
        $result = $project->getName();
        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * Test Setter and Getter for Locked Project variable.
     */
    public function testSetGetLocked()
    {
        // Arrange
        $project = new Project();
        $expectedResult = 1;
        $project->setLocked($expectedResult);
        // Act
        $result = $project->getLocked();
        // Assert
        $this->assertEquals($expectedResult, $result);
    }
}
