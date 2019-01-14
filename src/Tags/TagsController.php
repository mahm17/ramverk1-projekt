<?php

namespace Anax\Tags;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class TagsController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function indexAction()
    {
        $title = "All tags";
        $forum = new \Anax\Forum\Forum();
        $forum->setDb($this->di->get("dbqb"));

        $page = $this->di->get("page");

        $page->add("forum/tags", [
            "items" => $forum->findAll(),
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }

    public function tagAction(string $tag)
    {
        $title = "Tag";
        $forum = new \Anax\Forum\Forum();
        $forum->setDb($this->di->get("dbqb"));

        $page = $this->di->get("page");

        $page->add("forum/specificTag", [
            "items" => $forum->findWhere("tag = ?", $tag),
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }
}
