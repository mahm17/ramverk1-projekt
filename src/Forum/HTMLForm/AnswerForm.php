<?php

namespace Anax\Forum\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Anax\Forum\Answer;
use Anax\Forum\Forum;

/**
 * Example of FormModel implementation.
 */
class AnswerForm extends FormModel
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
                "legend" => "Answer post nr: $forum->id",
            ],
            [
                "answer" => [
                    "type" => "textarea",
                    "placeholder" => "Write the answer in markdown to change how it looks.",
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
        $content = $this->form->value("answer");
        $question = $this->form->value("question");
        $user = $this->form->value("user");
        $answer = new Answer();
        $answer->setDb($this->di->get("dbqb"));
        $answer->content = $content;
        $answer->question_id = $question;
        $answer->user = $user;
        $answer->save();
        $this->form->addOutput("The answer has been published.");
        return true;
        var_dump($answer);
    }

}
