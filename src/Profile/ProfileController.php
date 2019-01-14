<?php

namespace Anax\Profile;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\User\HTMLForm\EditUserForm;

class ProfileController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function indexAction()
    {
        $title = "Your profile";
        $user = new \Anax\User\User();
        $forum = new \Anax\Forum\Forum();
        $answer = new \Anax\Forum\Answer();
        $comments = new \Anax\Forum\Comment();
        $anscomments = new \Anax\Forum\AnswerComment();
        $user->setDb($this->di->get("dbqb"));
        $forum->setDb($this->di->get("dbqb"));
        $answer->setDb($this->di->get("dbqb"));
        $comments->setDb($this->di->get("dbqb"));
        $anscomments->setDb($this->di->get("dbqb"));
        $session = $this->di->get("session");
        $loginId = $session->get("login");

        $page = $this->di->get("page");

        $page->add("profile/index", [
            "items" => $user->findAllWhere("id = ?", $loginId),
            "posts" => $forum->findAllWhere("user = ?", $loginId),
            "answers" => $answer->findAllWhere("user = ?", $loginId),
            "comments" => $comments->findAllWhere("user = ?", $loginId),
            "anscomments" => $anscomments->findAllWhere("user = ?", $loginId),
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }

    public function allAction()
    {
        $title = "All users";
        $user = new \Anax\User\User();
        $user->setDb($this->di->get("dbqb"));

        $page = $this->di->get("page");

        $page->add("profile/all", [
            "users" => $user->findAll(),
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }

    public function profilesAction(int $id)
    {
        $title = "Specific user";
        $user = new \Anax\User\User();
        $forum = new \Anax\Forum\Forum();
        $answer = new \Anax\Forum\Answer();
        $comments = new \Anax\Forum\Comment();
        $anscomments = new \Anax\Forum\AnswerComment();

        $user->setDb($this->di->get("dbqb"));
        $forum->setDb($this->di->get("dbqb"));
        $answer->setDb($this->di->get("dbqb"));
        $comments->setDb($this->di->get("dbqb"));
        $anscomments->setDb($this->di->get("dbqb"));

        $page = $this->di->get("page");

        $page->add("profile/specific", [
            "users" => $user->findAllWhere("id = ?", $id),
            "questions" => $forum->findAllWhere("user = ?", $id),
            "answers" => $answer->findAllWhere("user = ?", $id),
            "comments" => $comments->findAllWhere("user = ?", $id),
            "anscomments" => $anscomments->findAllWhere("user = ?", $id),
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }

    public function editAction(int $id)
    {
        $title = "Edit user";
        $page = $this->di->get("page");
        $form = new EditUserForm($this->di, $id);
        $form->check();

        $page->add("anax/v2/article/default", [
            "content" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }
}
