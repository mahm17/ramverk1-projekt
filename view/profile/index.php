<?php

namespace Anax\View;
/**
* Profile specific page
*/

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());
$items = isset($items) ? $items : null;
var_dump($answers);
// $session = $this->di->get("session");

?>

<!DOCTYPE html>
<h1>Your profile</h1>
<?php foreach ($items as $item) : ?>
    <p>Your are logged in as <?= $item->acronym ?>.</p>
<?php endforeach; ?>
<?php if (empty($posts)) : ?>
    <p>You have not made any posts yet.</p>
<?php else : ?>
    <h3>Questions you have asked: </h3>
    <?php foreach ($posts as $post) : ?>
        <p>
            <a href="forum/question/<?= $post->id ?>"><?= $post->title ?></a>
        </p>
    <?php endforeach; ?>
<?php endif; ?>
<?php if (empty($answers)) : ?>
    <p>You have not posted any answers yet.</p>
<?php else : ?>
    <h3>Answers you have posted: </h3>
    <?php foreach ($answers as $answer) : ?>
        <a href="forum/question/<?= $answer->id ?>"><?= $answer->content ?></a>
    <?php endforeach; ?>
<?php endif; ?>
