<?php
namespace Anax\User;

use Anax\DatabaseActiveRecord\ActiveRecordModel;

class User extends ActiveRecordModel
{
    /**
    * @var string $tableName name of the database table.
    */
    protected $tableName = "User";

    /**
    * Columns in the table.
    *
    * @var integer $id primary key auto incremented.
    */
    public $id;
    public $username;
    public $password;
    public $created;
    public $updated;
    public $activity;

    /**
     * A database driven model.
     */
    /**
    * Set the password.
    *
    * @param string $password the password to use.
    *
    * @return void
    */
    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    /**
    * Verify the acronym and the password, if successful the object contains
    * all details from the database row.
    *
    * @param string $acronym  acronym to check.
    * @param string $password the password to use.
    *
    * @return boolean true if acronym and password matches, else false.
    */
    public function verifyPassword($username, $password)
    {
        $this->find("username", $username);
        return password_verify($password, $this->password);
    }
}
