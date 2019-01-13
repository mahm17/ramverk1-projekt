<?php

namespace Anax\User\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Anax\User\User;

/**
 * Example of FormModel implementation.
 */
class UserLoginForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Psr\Container\ContainerInterface $di a service container
     */
    public function __construct(ContainerInterface $di)
    {
        parent::__construct($di);
        $session = $this->di->get("session");
            $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Login"
            ],
            [
                "username" => [
                    "type"        => "text",
                    //"description" => "Here you can place a description.",
                    "placeholder" => "Username",
                ],

                "password" => [
                    "type"        => "password",
                    //"description" => "Here you can place a description.",
                    "placeholder" => "Password",
                ],
                "submit" => [
                    "type" => "submit",
                    "value" => "Login",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }



    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return boolean true if okey, false if something went wrong.
     */
    public function callbackSubmit()
    {
        // Get values from the submitted form
        $username       = $this->form->value("username");
        $password      = $this->form->value("password");

        // Try to login
        // $db = $this->di->get("dbqb");
        // $db->connect();
        // $user = $db->select("password")
        //            ->from("User")
        //            ->where("acronym = ?")
        //            ->execute([$acronym])
        //            ->fetch();
        //
        // // $user is false if user is not found
        // if (!$user || !password_verify($password, $user->password)) {
        //    $this->form->rememberValues();
        //    $this->form->addOutput("User or password did not match.");
        //    return false;
        // }

        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        $res = $user->verifyPassword($username, $password);
        $session = $this->di->get("session");
        $session->set("login", $user->id);

        if (!$res) {
           $this->form->rememberValues();
           $this->form->addOutput("User or password did not match.");
           return false;
        }
        $this->form->addOutput("User " . $user->username . " logged in.");
        return true;
    }

    // public function callbackLogout()
    // {
    //     $session = $this->di->get("session");
    //     $session->destroy();
    //     $this->di->get("response")->redirect("login");
    // }
}