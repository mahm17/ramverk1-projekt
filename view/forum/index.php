<?php

namespace Anax\View;

/**
* Forum first page
*/

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());
$items = isset($items) ? $items : null;
$session = $this->di->get("session");
$filter = $this->di->get("textfilter");
// var_dump($session);
?>
<h1>Welcome to the forum</h1>

<?php if (!$items) : ?>
    <p>There are no posts to show.!</p>
    <a href="forum/create">Create a new post.</a>
    <?php
    return;
endif;
?>
<article>
    <?php foreach ($items as $item) : ?>
        <section>
            <header class="questionheader">
                <h2><a href="forum/question/<?= $item->id ?>"><?= $item->title ?></a></h2>
            </header>
        </section>
    <?php endforeach; ?>
    <?php if ($session->has("login")) : ?>
        <p>
            <a href="forum/create">Create a new post</a>
        </p>
    <?php else : ?>
        <p>You have to be logged in to create a new post</p>
    <?php endif; ?>
</article>
