<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 2016-04-13
 * Time: 15:52
 */

namespace IgorITB\model;

use Mattsmithdev\PdoCrud\DatabaseTable;

/**
 * Class UserHasProject representing a Database Table of UserHasProjects.
 * @package IgorITB\Model
 */
class UserHasProject extends DatabaseTable
{
    /**
     * Variable storing the ID.
     * @var int $id
     */
    private $id;
    /**
     * Variable storing the User ID.
     * @var int $userId
     */
    private $userId;
    /**
     * Variable storing the Project ID.
     * @var int $projectId
     */
    private $projectId;
    /**
     * Variable storing the Role ID.
     * @var int $roleId
     */
    private $roleId;

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
     * Getter function for User ID.
     * @return int $userId
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Setter function for User ID.
     * @param int $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
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
     * Getter function for Role ID.
     * @return int $roleId
     */
    public function getRoleId()
    {
        return $this->roleId;
    }

    /**
     * Setter function for Role ID.
     * @param int $roleId
     */
    public function setRoleId($roleId)
    {
        $this->roleId = $roleId;
    }
}
