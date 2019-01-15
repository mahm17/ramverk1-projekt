<?php

namespace Anax\View;
$size = 90;
$grav_url = "https://www.gravatar.com/avatar/";
$tags = [];
$counter = 1;

?>
<h1>Welcome to Everything about Slopestyle!</h1>
<p>Welcome to Everything about Slopestyle! On this page you will be able to find everything related to
    slopestyle skiing, may it be either skis or snowboard!</p>
<p>Here you can also find a forum used for asking all sorts of different questions related to anything
    slopestyle or maybe not? Maybe you just want to ask a regular old question? And our
    users will surely be able to help with any problems you might have. For example: How do i
    start skiing? What is slopestyle? You can ask whatever you want!</p>
<div id="container">
    <div id="posts">
        <h2>The latest forum posts:</h2>
        <?php foreach ($items as $item) : ?>
            <h3><a href="forum/question/<?= $item->id ?>"><?= $item->title ?></a></h3>
            <p><i>Published: <time datetime="<?= $item->published ?>" pubdate><?= $item->published ?></time></i></p>
        <?php endforeach; ?>
    </div>
    <div id="tags">
        <h2>The most used tags:</h2>
        <?php foreach ($items as $item) : ?>
            <?php array_push($tags, $item->tag); ?>
        <?php endforeach; ?>
        <?php foreach ($tags as $tag) : ?>
            <?php $exploded = explode(", ", $tag); ?>
            <?php if (!in_array($tag, $exploded)) : ?>
                <?php foreach ($exploded as $piece) : ?>
                    <section>
                        <h3><?= $counter ?>: <a href="tags/tag/<?= $piece ?>"><?= $piece ?></a><h3>
                    </section>
                    <?php $counter++; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <div id="users">
        <h2>The most active users:</h2>
        <?php foreach ($users as $user) : ?>
            <h3><a href="profile/profiles/<?= $user->id ?>"><?= $user->username ?></a></h3>
            <img src="<?php echo $grav_url . md5(strtolower(trim($user->email))) . "?s=" . $size; ?>" alt="" />
            <p>Activity: <?= $user->activity ?></p>
        <?php endforeach; ?>
    </div>
</div>
<?php $counts = array_count_values($tags); ?>
