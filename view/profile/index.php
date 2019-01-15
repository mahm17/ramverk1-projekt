<?php

namespace Anax\View;

/**
* Profile specific page
*/

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());
$items = isset($items) ? $items : null;
$size = 90;
$grav_url = "https://www.gravatar.com/avatar/";

// $session = $this->di->get("session");

?>

<!DOCTYPE html>
<h1>Your profile</h1>
<?php foreach ($items as $item) : ?>
    <img src="<?php echo $grav_url . md5(strtolower(trim($item->email))) . "?s=" . $size; ?>" alt="" />
    <p>Your are logged in as <?= $item->username ?>.</p>
    <a href="profile/edit/<?= $item->id ?>">Edit user</a>
    <p>Activity: <?= $item->activity ?>
<?php endforeach; ?>
<h3>Questions you have asked: </h3>
<?php if (empty($posts)) : ?>
    <p>You have not made any posts yet.</p>
<?php else : ?>
    <?php foreach ($posts as $post) : ?>
        <p>
            <a href="forum/question/<?= $post->id ?>"><?= $post->title ?></a>
        </p>
    <?php endforeach; ?>
<?php endif; ?>
<h3>Answers you have posted: </h3>
<?php if (empty($answers)) : ?>
    <p>You have not posted any answers yet.</p>
<?php else : ?>
    <?php foreach ($answers as $answer) : ?>
        <p>
            <a href="forum/question/<?= $answer->questionId ?>"><?= $answer->content ?></a>
        </p>
    <?php endforeach; ?>
<?php endif; ?>
<h3>Comments you have posted: </h3>
<?php if (empty($comments)) : ?>
    <p>You have not posted any comments yet.</p>
<?php else : ?>
    <?php foreach ($comments as $comment) : ?>
        <p>
            <a href="forum/question/<?= $answer->questionId ?>"><?= $comment->content ?></a>
        </p>
    <?php endforeach; ?>
<?php endif; ?>
<h3>Comments on answers you have posted: </h3>
<?php if (empty($anscomments)) : ?>
    <p>You have not made any comments on answers yet.</p>
<?php else : ?>
    <?php foreach ($anscomments as $anscomment) : ?>
        <p>
            <a href="forum/question/<?= $answer->questionId ?>"><?= $anscomment->content ?></a>
        </p>
    <?php endforeach; ?>
<?php endif; ?>
