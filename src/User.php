<?php
/**
 * Getters and setters for User
 */

namespace Itb;

/**
 * Parameters needed for User
 * Class User
 * @package Itb
 */
class User
{

    /**
     * user id
     * @var int
     */
    private $id;

    /**
     * the username
     * @var string
     */
    private $username;

    /**
     * the users password
     * @var string
     */
    private $password;

    /**
     * the role of the user - 1 for customer, 2 for admin
    * @var int
    */
    private $role;

    /**
     * a string for the users profile picture
     * @var string
     */
    private $userImage;


    /**
     * get the role of the user
     * @return int
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * set the users role
     * @param int $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * get the users id
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * set the users id
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * get users username
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * set the users username
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * get the users password
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * hash the password before storing ...
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $this->password = $hashedPassword;
    }

    /**
     * get the users image name
     * @return string
     */
    public function getUserImage()
    {
        return $this->userImage;
    }

    /**
     * set the usersImage name
     * @param string $userImage
     */
    public function setUserImage($userImage)
    {
        $this->userImage = $userImage;
    }

}