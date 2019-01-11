<?php

namespace Anax\Profile;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class ProfileController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function indexAction()
    {
        $title = "Your profile";
        $user = new \Anax\User\User();
        $forum = new \Anax\Forum\Forum();
        $answer = new \Anax\Forum\Answer();
        $user->setDb($this->di->get("dbqb"));
        $forum->setDb($this->di->get("dbqb"));
        $answer->setDb($this->di->get("dbqb"));
        $session = $this->di->get("session");
        $loginId = $session->get("login");

        $page = $this->di->get("page");

        $page->add("profile/index", [
            "items" => $user->findAllWhere("id = ?", $loginId),
            "posts" => $forum->findAllWhere("user = ?", $loginId),
            "answers" => $answer->findAllWhere("user = ?", $loginId),
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }
}
