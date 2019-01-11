<?php

namespace Anax\View;
$items = isset($items) ? $items : null;
?>

<!DOCTYPE html>
<?php if (!$items) : ?>
    <p>There is nothing here!</p>
    <?php
    return;
endif;
?>
<h1>Questions related to a specific tag</h1>
<?php foreach ($items as $item) : ?>
    <h2><a href="../../forum/question/<?= $item->id ?>"><?= $item->title ?></h2>
<?php endforeach; ?>
