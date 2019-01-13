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
<?php else: ?>
    <?php foreach ($answers as $answer) : ?>
        <p>
            <a href="../../forum/question/<?= $answer->question_id ?>"><?= $answer->content ?></a>
        </p>
    <?php endforeach; ?>
<?php endif; ?>
