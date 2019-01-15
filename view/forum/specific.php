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
        <p><i>Published: <time datetime="<?= $item->published ?>" pubdate><?= $item->published ?></time></i></p>
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
            <a href="../comment/<?= $item->id ?>">Comment on this post</a>
        </p>
        <p>
            <a href="../answer/<?= $item->id ?>">Answer this post</a>
        </p>
    <?php else : ?>
        <p>You have to be logged in to answer on a post!</p>
    <?php endif; ?>
    <h2>Comments: </h2>
    <?php foreach ($comments as $comment) : ?>
        <div class="comments">
            <?= $filter->doFilter($comment->content, "markdown"); ?>
        </div>
    <?php endforeach; ?>
    <h2>Answers: </h2>
    <?php foreach ($answers as $answer) : ?>
        <div class="answers">
            <?= $filter->doFilter($answer->content, "markdown"); ?>
            <h3>Comments: </h3>
            <?php foreach ($anscomments as $anscomment) : ?>
                <?php if ($answer->id == $anscomment->answerId) : ?>
                    <div class="anscomment">
                        <?= $filter->doFilter($anscomment->content, "markdown"); ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
            <a href="../anscomment/<?=$answer->id ?>">Comment on this answer</a>
        </div>
    <?php endforeach; ?>
</article>
<?php endforeach; ?>
