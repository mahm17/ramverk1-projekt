<?php

namespace Anax\View;

/**
* Forum first page
*/

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());
$items = isset($items) ? $items : null;
// var_dump($items);
// $session = $this->di->get("session");
?>

<?php if (!$items) : ?>
    <p>There are no tags too show!</p>
    <?php
    return;
endif;
?>
<article>
    <header>
        <h1>All tags</h1>
    </header>
    <?php foreach ($items as $item) : ?>
        <?php $tags = explode(", ", $item->tag); ?>
        <section>
            <?php foreach ($tags as $tag) : ?>
                <a href="tags/tag/<?= $item->tag ?>"><?= $tag ?></a>
            <?php endforeach; ?>
        </section>
    <?php endforeach; ?>
</article>
