<?php
/**
 * the methods used for users
 */

namespace Itb;


/**
 * methods for User
 * Class UserRepository
 * @package Itb
 */
class UserRepository
{
    /**
     * connection to database
     * UserRepository constructor.
     */
    public function __construct()
    {
        $this->connection = $this->connectToDb();
    }

    /**
     * connect to the database
     * @return null|\PDO
     */
    public function connectToDb()
    {
        // DSN - the Data Source Name - required by the PDO to connect
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;

        // attempt to create a connection to the database
        try {
            $connection = new \PDO($dsn, DB_USER, DB_PASS);
        } catch (\PDOException $e) {
            // deal with connection error
            return null;
        }

        return $connection;
    }

    /**
     * get all users from the database
     * @return array
     */
    public function getAll() {
        // run SQL
        $sql = 'SELECT * FROM users';

        $statement = $this->connection->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_CLASS, '\\Itb\\User');
        $statement->execute();

        $users = $statement->fetchAll(); // array of Product objects

        return $users;
    }


    /**
     * retrieve one user from database using username
     * @param $username
     * @return mixed|null
     */
    public function getOneByUsername($username) {

        $sql = 'SELECT * FROM users WHERE username=:username';
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':username', $username, \PDO::PARAM_STR);
        $statement->setFetchMode(\PDO::FETCH_CLASS,'\\Itb\\User');
        $statement->execute();

        if ($object = $statement->fetch()) {
            return $object;
        } else {
            return null;
        }
    }

    /**
     * get user from database using id
     * @param $id
     * @return mixed|null
     */
    public function getOneById($id)
    {

        $sql = 'SELECT * FROM users WHERE id=:id';
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':id', $id, \PDO::PARAM_INT);
        $statement->setFetchMode(\PDO::FETCH_CLASS,'\\Itb\\User');
        $statement->execute();

        if ($row = $statement->fetch()) {
            return $row;
        } else {
            return null;
        }
    }

    /**
     * update a user and save to database
     * @param User $user
     * @param $password
     * @return bool
     */
    public function updateUser(User $user, $password)
    {
        $id = $user->getId();
        $username = $user->getUsername();
        $hashedPassword = $user->getPassword();
        $role = $user->getRole();
        $userImage= $user->getUserImage();

        $sql = 'UPDATE users SET username=:username, password=:password, hashedPassword=:hashedPassword, role=:role, userImage=:userImage WHERE id=:id';

        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':id', $id, \PDO::PARAM_INT);
        $statement->bindParam(':username', $username, \PDO::PARAM_STR);
        $statement->bindParam(':password', $password, \PDO::PARAM_STR);
        $statement->bindParam(':hashedPassword', $hashedPassword, \PDO::PARAM_STR);
        $statement->bindParam(':role', $role, \PDO::PARAM_INT);
        $statement->bindParam(':userImage', $userImage, \PDO::PARAM_STR);

        $statement->execute();

        $numRowsAffected = $statement->rowCount();

        if($numRowsAffected > 0){
            //if the user that was updated is the user logged in, the session image must be updated
            if ($_SESSION['id']==$id){
                $_SESSION['userImage'] = $userImage;
            }
            $queryWasSuccessful = true;
        } else {
            $queryWasSuccessful = false;
        }

        return $queryWasSuccessful;
    }

    /**
     * save a string for the profile picture for user with $id
     * @param $id
     * @param $userImage
     * @return bool
     */
    public function setProfilePicture($id, $userImage)
    {
        $sql = 'UPDATE users SET userImage=:userImage WHERE id=:id';
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':id', $id, \PDO::PARAM_INT);
        $statement->bindParam(':userImage', $userImage, \PDO::PARAM_STR);

        $statement->execute();

        $numRowsAffected = $statement->rowCount();

        if($numRowsAffected > 0){
            $_SESSION['userImage']=$userImage;
            $queryWasSuccessful = true;
        } else {
            $queryWasSuccessful = false;
        }

        return $queryWasSuccessful;
    }

    /**
     * returns true if we can find a matching username and the hashed password matches password of that user
     * @param $username
     * @param $password
     * @return bool
     */
    public function canFindMatchingUsernameAndPassword($username, $password)
    {
        $userInDataBase = $this->getOneByUsername($username);

        // if no record has this username, return FALSE
        if(null == $userInDataBase){
            return false;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $password= $userInDataBase->getPassword();

        if(password_verify($password, $hashedPassword)){
            //set SESSION id, role and image as user if logging in successfully
            $_SESSION['id']=$userInDataBase->getId();
            $_SESSION['role']= $userInDataBase->getRole();
            $_SESSION['userImage']= $userInDataBase->getUserImage();
        }
        // return whether or not hash of input password matches stored hash
        return password_verify($password, $hashedPassword);
    }

    /**
     * create a new user and save to database
     * @param User $user
     * @param $password
     * @return bool
     */
    public function createNewUser(User $user, $password) {

        $username = $user->getUsername();
        $hashedPassword = $user->getPassword();
        $role = $user->getRole();
        $userImage = $user->getUserImage();

        //INSERT INTO table (name, value) VALUES (:name, :value)
        $sql = 'INSERT into users (username, hashedPassword, password, role, userImage) VALUES (:username, :hashedPassword, :password, :role, :userImage)';

        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':username', $username, \PDO::PARAM_STR);
        $statement->bindParam(':hashedPassword', $hashedPassword, \PDO::PARAM_STR); // there isn't a PARAM_FLOAT ...

        $statement->bindParam(':password', $password, \PDO::PARAM_STR); // there isn't a PARAM_FLOAT ...
        $statement->bindParam(':role', $role, \PDO::PARAM_INT);
        $statement->bindParam(':userImage', $userImage, \PDO::PARAM_STR);

        $statement->execute();

        $numRowsAffected = $statement->rowCount();

        if($numRowsAffected > 0){
            $queryWasSuccessful = true;
        } else {
            $queryWasSuccessful = false;
        }
        return $queryWasSuccessful;
    }

    /**
     * delete a user
     * @param $id
     * @return bool
     */
    public function deleteUser($id)
    {
        $sql = 'DELETE FROM users WHERE id=:id';
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':id', $id, \PDO::PARAM_INT);
        $statement->execute();

        $numRowsAffected = $statement->rowCount();

        if($numRowsAffected > 0){
            $queryWasSuccessful = true;
        } else {
            $queryWasSuccessful = false;
        }
        return $queryWasSuccessful;
    }

}