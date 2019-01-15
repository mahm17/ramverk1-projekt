<?php

namespace Anax\Forum;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\Forum\HTMLForm\AnswerForm;
use Anax\Forum\HTMLForm\CreatePostForm;
use Anax\Forum\HTMLForm\CommentForm;
use Anax\Forum\HTMLForm\CommentAnswerForm;

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
        $comment = new Comment();
        $anscomment = new AnswerComment();
        $user = new \Anax\User\User();
        $forum->setDb($this->di->get("dbqb"));
        $answer->setDb($this->di->get("dbqb"));
        $user->setDb($this->di->get("dbqb"));
        $comment->setDb($this->di->get("dbqb"));
        $anscomment->setDb($this->di->get("dbqb"));
        $session = $this->di->get("session");
        $login = $session->get("login");

        $page->add("forum/specific", [
            "content" => $forum->findAllWhere("id = ?", $id),
            "answers" => $answer->findAllWhere("questionId = ?", $id),
            "users" => $user->findAllWhere("id = ?", $login),
            "comments" => $comment->findAllWhere("questionId = ?", $id),
            "anscomments" => $anscomment->findAll(),
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

    public function commentAction(int $id) : object
    {
        $page = $this->di->get("page");
        $form = new CommentForm($this->di, $id);
        $form->check();

        $page->add("anax/v2/article/default", [
            "content" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "Create a new comment",
        ]);
    }

    public function anscommentAction(int $id) : object
    {
        $page = $this->di->get("page");
        $form = new CommentAnswerForm($this->di, $id);
        $form->check();

        $page->add("anax/v2/article/default", [
            "content" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "Create a new comment",
        ]);
    }
}
