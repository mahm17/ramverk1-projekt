<?php

namespace Anax\View;
/**
* Forum specific page
*/

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());
$items = isset($items) ? $items : null;
$session = $this->di->get("session");
$filter = $this->di->get("textfilter");

?>

<!DOCTYPE html>
<?php if (!$content) : ?>
    <p>There is nothing here!</p>
    <?php
    return;
endif;
?>

<?php foreach ($content as $item) : ?>

<article>
    <header>
        <h1><?= $item->title ?></h1>
    </header>
    <?= $filter->doFilter($item->content, "markdown"); ?>
    <p>Tags: <?= $item->tag ?></p>
    <?php foreach ($users as $info) : ?>
        <p>
            Posted by: <a href="../../profile"><?= $info->username ?></a>
        </p>
    <?php endforeach; ?>
    <?php if ($session->has("login")) : ?>
        <p>
            <a href="../answer/<?= $item->id ?>">Answer this post</a>
        </p>
    <?php else : ?>
        <p>You have to be logged in to answer on a post!</p>
    <?php endif; ?>
    <?php foreach ($answers as $answer) : ?>
        <h2>Answers:</h2>
        <?= $filter->doFilter($answer->content, "markdown"); ?>
    <?php endforeach; ?>
</article>
<?php endforeach; ?>