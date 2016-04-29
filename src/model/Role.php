<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 2016-04-13
 * Time: 14:39
 */

namespace IgorITB\model;

use Mattsmithdev\PdoCrud\DatabaseTable;

/**
 * Class Role representing a Database Table of Roles.
 * @package IgorITB\Model
 */
class Role extends DatabaseTable
{
    /**
     * Variable storing the ID of the role.
     * @var int $id
     */
    private $id;
    /**
     * Variable storing the name of the role.
     * @var string $role
     */
    private $role;

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
     * Getter function for role name.
     * @return string $role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Setter function for role name.
     * @param string $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }
}
