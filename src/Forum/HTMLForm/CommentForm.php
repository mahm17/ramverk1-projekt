<?php

namespace Anax\Forum\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Anax\Forum\Answer;
use Anax\Forum\Forum;
use Anax\Forum\Comment;

/**
 * Example of FormModel implementation.
 */
class CommentForm extends FormModel
{
    /**
     * Constructor injects with DI container and the id to update.
     *
     * @param Psr\Container\ContainerInterface $di a service container
     * @param integer             $id to update
     */
    public function __construct(ContainerInterface $di, $id)
    {
        parent::__construct($di);
        $forum = $this->getItemDetails($id);
        $session = $this->di->get("session");
        $user = $session->get("login");
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Post a comment",
            ],
            [
                "comment" => [
                    "type" => "textarea",
                    "placeholder" => "Write the comment in markdown to change how it looks.",
                ],

                "question" => [
                    "type" => "text",
                    "value" => $forum->id,
                    "readonly" => "readonly",
                ],

                "user" => [
                    "type" => "text",
                    "value" => $user,
                    "readonly" => "readonly",
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Answer",
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
     * @return Forum
     */
    public function getItemDetails($id) : object
    {
        $forum = new Forum();
        $forum->setDb($this->di->get("dbqb"));
        $forum->find("id", $id);
        return $forum;
    }



    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return bool true if okey, false if something went wrong.
     */
    public function callbackSubmit()
    {
        // Get values from the submitted form
        $content = $this->form->value("comment");
        $question = $this->form->value("question");
        $user = $this->form->value("user");
        $comment = new Comment();
        $comment->setDb($this->di->get("dbqb"));
        $comment->content = $content;
        $comment->questionId = $question;
        $comment->user = $user;
        $comment->save();
        $this->form->addOutput("The comment has been published.");
        return true;
    }

    public function callbackSuccess()
    {
        $this->di->get("response")->redirect("forum")->send();
    }
}
