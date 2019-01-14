<?php

namespace Anax\Home;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\Forum\Forum;

class HomeController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function indexAction()
    {
        $title = "Home page";
        $forum = new Forum();
        $forum->setDb($this->di->get("dbqb"));

        $page = $this->di->get("page");

        $page->add("home/index", [
            "items" => $forum->findAll(),
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }
}
