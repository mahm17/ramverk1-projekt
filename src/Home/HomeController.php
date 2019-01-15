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
        $db = $this->di->get("db");
        $db->connect();
        $sqlPosts = "SELECT * FROM Forum ORDER BY published DESC;";
        $sqlUsers = "SELECT * FROM User ORDER BY activity DESC;";
        $resOne = $db->executeFetchAll($sqlPosts);
        $resTwo = $db->executeFetchAll($sqlUsers);

        $page = $this->di->get("page");

        $page->add("home/index", [
            "items" => $resOne,
            "users" => $resTwo,
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }
}
