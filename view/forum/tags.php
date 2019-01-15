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
$tags = [];
$counter = 1;
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
    <p>Here you can see all tags used in the articles.</p>
    <?php foreach ($items as $item) : ?>
        <?php array_push($tags, $item->tag); ?>
    <?php endforeach; ?>
    <?php foreach ($tags as $tag) : ?>
        <?php $exploded = explode(", ", $tag); ?>
        <?php if (in_array($tag, $exploded)) : ?>
            <?php foreach ($exploded as $piece) : ?>
                <section>
                    <?= $counter ?>: <a href="tags/tag/<?= $piece ?>"><?= $piece ?></a>
                </section>
                <?php $counter++ ?>
            <?php endforeach; ?>
        <?php else : ?>
            <?php foreach ($exploded as $piece) : ?>
                <section>
                    <?= $counter ?>: <a href="tags/tag/<?= $piece ?>"><?= $piece ?></a>
                </section>
                <?php $counter++ ?>
            <?php endforeach; ?>
        <?php endif; ?>
    <?php endforeach; ?>
</article>
