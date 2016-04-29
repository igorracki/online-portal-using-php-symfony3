<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 2016-04-12
 * Time: 15:36
 */

namespace IgorITB\model;

use Mattsmithdev\PdoCrud\DatabaseTable;

/**
 * Class User representing a Database Table of Users.
 * @package IgorITB\Model
 */
class User extends DatabaseTable
{
    /**
     * Variable to store the user's ID.
     * @var int $id
     */
    private $id;
    /**
     * Variable to store the user's name.
     * @var string $name
     */
    private $name;
    /**
     * Variable to store the user's username for login.
     * @var string $username
     */
    private $username;
    /**
     * Variable to store the user's password for login.
     * @var string $password
     */
    private $password;

    /**
     * Variable to store the type of user.
     * @var string $type
     */
    private $type;

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
     * Getter function for name.
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Setter function for name.
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Getter function for username.
     * @return string $username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Setter function for username.
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Getter function for password.
     * @return string $password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Setter function for password.
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Getter function for type.
     * @return string $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Setter function for type.
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }
}
