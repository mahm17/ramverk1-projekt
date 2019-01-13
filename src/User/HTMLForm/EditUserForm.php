<?php

namespace Anax\User\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Anax\User\User;

class EditUserForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Psr\Container\ContainerInterface $di a service container
     * @param integer             $id to update
     */
    public function __construct(ContainerInterface $di, $id)
    {
        parent::__construct($di);
        $user = $this->getItemDetails($id);
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Edit exsiting user",
            ],
            [
                "id" => [
                    "type"        => "text",
                    "validation" => ["not_empty"],
                    "readonly" => "readonly",
                    "value" => $user->id,
                ],

                "username" => [
                    "type"        => "text",
                    "validation" => ["not_empty"],
                    "value" => $user->username,
                ],

                "password" => [
                    "type"        => "password",
                    "validation" => ["not_empty"],
                ],

                "password-again" => [
                    "type"        => "password",
                    "validation" => [
                        "match" => "password"
                    ],
                ],

                "email" => [
                    "type"        => "email",
                    "validation" => ["not_empty"],
                    "value" => $user->email,
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Create user",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }

    /**
     * Get details on item to load form with.
     *
     * @param integer $id get details on item with id.
     *
     * @return Book
     */
    public function getItemDetails($id) : object
    {
        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        $user->find("id", $id);
        return $user;
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
        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        $username      = $this->form->value("username");
        $password      = $this->form->value("password");
        $passwordAgain = $this->form->value("password-again");
        $email = $this->form->value("email");

        // Check password matches
        if ($password !== $passwordAgain ) {
            $this->form->rememberValues();
            $this->form->addOutput("Password did not match.");
            return false;
        }

        $user->find("id", $this->form->value("id"));
        $user->username  = $this->form->value("username");
        $user->password = $this->form->value("password");
        $user->email = $this->form->value("email");
        $user->save();
        $this->form->addOutput("User was updated.");
        return true;

    }
}
