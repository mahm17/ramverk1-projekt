<?php

namespace Anax\Forum\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Anax\Forum\Forum;

/**
 * Example of FormModel implementation.
 */
class CreatePostForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Psr\Container\ContainerInterface $di a service container
     */
    public function __construct(ContainerInterface $di)
    {
        parent::__construct($di);
        $user = $this->di->get("session")->get("login");
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Create a forum post",
            ],
            [
                "title" => [
                    "type"        => "text",
                ],

                "content" => [
                    "type"        => "textarea",
                    "placeholder" => "Write the post in markdown to change how it looks.",
                ],

                "tag" => [
                    "type"        => "text",
                ],

                "user" => [
                    "type" => "text",
                    "value" => $user,
                    "readonly" => "readonly",
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Skapa inlägg",
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
     * @return User
     */
    public function getItemDetails($id) : object
    {
        $user = new \Anax\User\User();
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
        $login = $this->di->get("session")->get("login");
        $poster = $this->getItemDetails($login);
        $title = $this->form->value("title");
        $content = $this->form->value("content");
        $tag = $this->form->value("tag");
        $user = $this->form->value("user");

        $forum = new Forum();
        $forum->setDb($this->di->get("dbqb"));
        $forum->title = $title;
        $forum->content = $content;
        $forum->tag = $tag;
        $forum->user = $user;
        $poster->username = $poster->username;
        $poster->activity += 1;
        $poster->save();
        $forum->save();

        $this->form->addOutput("Post was created.");
        return true;
    }

    public function callbackSuccess()
    {
        $this->di->get("response")->redirect("forum")->send();
    }
}
