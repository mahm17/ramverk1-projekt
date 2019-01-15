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

<?php foreach ($users as $user) : ?>
    <h1><?= $user->username ?></h1>
    <img src="<?php echo $grav_url . md5(strtolower(trim($user->email))) . "?s=" . $size; ?>" alt="" />
<?php endforeach; ?>
<h3>Questions asked: </h3>
<?php if (empty($questions)) : ?>
    <p>This user hasen't posted any questions yet.</p>
<?php else : ?>
    <?php foreach ($questions as $question) : ?>
        <p>
            <a href="../../forum/question/<?= $question->id ?>"><?= $question->title ?></a>
        </p>
    <?php endforeach; ?>
<?php endif; ?>
<h3>Answers posted: </h3>
<?php if (empty($answers)) : ?>
    <p>This user hasn't posted any answers yet.</p>
<?php else : ?>
    <?php foreach ($answers as $answer) : ?>
        <p>
            <a href="../../forum/question/<?= $answer->questionId ?>"><?= $answer->content ?></a>
        </p>
    <?php endforeach; ?>
<?php endif; ?>
<?php if (empty($comments)) : ?>
    <h3>Comments this user have posted: </h3>
    <p>This user have not posted any comments yet.</p>
<?php else : ?>
    <h3>Comments you have posted: </h3>
    <?php foreach ($comments as $comment) : ?>
        <p>
            <a href="../../forum/question/<?= $answer->questionId ?>"><?= $comment->content ?></a>
        </p>
    <?php endforeach; ?>
<?php endif; ?>
<h3>Comments on answers you have posted: </h3>
<?php foreach ($anscomments as $anscomment) : ?>
    <p>
        <a href="../../forum/question/<?= $answer->questionId ?>"><?= $anscomment->content ?></a>
    </p>
<?php endforeach; ?>
