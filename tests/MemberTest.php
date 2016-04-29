<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 2016-04-29
 * Time: 14:13
 */

namespace IgorITB\Test;

use IgorITB\Model\Member;

/**
 * Class MemberTest to test the Member object.
 * @package IgorITB\Test
 */
class MemberTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test object creation.
     */
    public function testCanCreateObject()
    {
        // Arrange
        $member = new Member();
        // Act

        // Assert
        $this->assertNotNull($member);
    }

    /**
     * Test Setter and Getters for Member Name.
     */
    public function testSetGetMemberName()
    {
        // Arrange
        $member = new Member();
        $expectedResult = "Igor";
        $member->setMemberName($expectedResult);
        // Act
        $result = $member->getMemberName();
        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * Test Setter and Getters for Member Role.
     */
    public function testSetGetMemberRole()
    {
        // Arrange
        $member = new Member();
        $expectedResult = "Leader";
        $member->setMemberRole($expectedResult);
        // Act
        $result = $member->getMemberRole();
        // Assert
        $this->assertEquals($expectedResult, $result);
    }
}
