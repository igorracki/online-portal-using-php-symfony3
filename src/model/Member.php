<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 2016-04-16
 * Time: 15:41
 */

namespace IgorITB\model;

/**
 * Class Member used to temporarily store project members.
 * @package IgorITB\Model
 */
class Member
{
    /**
     * Variable storing the member's name.
     * @var string $memberName
     */
    private $memberName;
    /**
     * Variable storing the member's role.
     * @var string $memberRole
     */
    private $memberRole;

    /**
     * Getter function for the Member's Name.
     * @return string $memberName
     */
    public function getMemberName()
    {
        return $this->memberName;
    }

    /**
     * Setter function for the Member's Name.
     * @param string $memberName
     */
    public function setMemberName($memberName)
    {
        $this->memberName = $memberName;
    }

    /**
     * Getter function for the Member's Role.
     * @return string $memberRole
     */
    public function getMemberRole()
    {
        return $this->memberRole;
    }

    /**
     * Setter function for the Member's Role.
     * @param string $memberRole
     */
    public function setMemberRole($memberRole)
    {
        $this->memberRole = $memberRole;
    }
}
