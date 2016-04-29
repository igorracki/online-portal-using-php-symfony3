<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 2016-04-12
 * Time: 15:42
 */

namespace IgorITB\model;

use Mattsmithdev\PdoCrud\DatabaseTable;

/**
 * Class Project representing a Database Table of Projects.
 * @package IgorITB\Model
 */
class Project extends DatabaseTable
{
    /**
     * Variable to store the project's id.
     * @var int $id
     */
    private $id;
    /**
     * Variable to store the project's name.
     * @var string $name
     */
    private $name;
    /**
     * Variable to store if the project is locked.
     * @var int $locked
     */
    private $locked;

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
     * Getter function for locked.
     * @return int $locked
     */
    public function getLocked()
    {
        return $this->locked;
    }

    /**
     * Setter function for locked.
     * @param int $locked
     */
    public function setLocked($locked)
    {
        $this->locked = $locked;
    }
}
