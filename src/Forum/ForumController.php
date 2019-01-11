<?php

namespace Anax\Forum;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\Forum\HTMLForm\AnswerForm;
use Anax\Forum\HTMLForm\CreatePostForm;


class ForumController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function indexAction()
    {
        $title = "The forum";
        $forum = new Forum();
        $forum->setDb($this->di->get("dbqb"));

        $page = $this->di->get("page");

        $page->add("forum/index", [
            "items" => $forum->findAll(),
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }

    public function createAction() : object
    {
        $page = $this->di->get("page");
        $form = new CreatePostForm($this->di);
        $form->check();

        $page->add("anax/v2/article/default", [
            "content" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "Create a new post",
        ]);
    }

    public function questionAction(int $id) : object
    {
        $page = $this->di->get("page");
        $forum = new Forum();
        $answer = new Answer();
        $forum->setDb($this->di->get("dbqb"));
        $answer->setDb($this->di->get("dbqb"));

        $page->add("forum/specific", [
            "content" => $forum->findAllWhere("id = ?", $id),
            "answers" => $answer->findAllWhere("question_id = ?", $id),
        ]);

        return $page->render([
            "title" => "Question",
        ]);
    }

    public function answerAction(int $id) : object
    {
        $page = $this->di->get("page");
        $form = new AnswerForm($this->di, $id);
        $form->check();

        $page->add("anax/v2/article/default", [
            "content" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "Create a new answer",
        ]);
    }
}
