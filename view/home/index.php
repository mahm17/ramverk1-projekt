<?php

namespace Anax\View;
$size = 90;
$grav_url = "https://www.gravatar.com/avatar/";
// var_dump($items[1]);
?>
<h1>Welcome to Everything about Slopestyle!</h1>
<p>Welcome to Everything about Slopestyle! On this page you will be able to find everything related to
    slopestyle skiing, may it be either skis or snowboard!</p>
<p>Here you can also find a forum used for asking all sorts of different questions related to anything
    slopestyle or maybe not? Maybe you just want to ask a regular old question? And our
    users will surely be able to help with any problems you might have. For example: How do i
    start skiing? What is slopestyle? You can ask whatever you want!</p>
<div id="posts">
    <h2>The latest forum posts:</h2>
    <?php foreach ($items as $item) : ?>
        <h3><a href="forum/question/<?= $item->id ?>"><?= $item->title ?></a></h3>
        <p><i>Published: <time datetime="<?= $item->published ?>" pubdate><?= $item->published ?></time></i></p>
    <?php endforeach; ?>
</div>
<div id="users">
    <h2>The most active users:</h2>
    <?php foreach ($users as $user) : ?>
        <div class="users">
            <h3><a href="profile/profiles/<?= $user->id ?>"><?= $user->username ?></a></h3>
            <img src="<?php echo $grav_url . md5(strtolower(trim($user->email))) . "?s=" . $size; ?>" alt="" />
            <p>Activity: <?= $user->activity ?></p>
        </div>
    <?php endforeach; ?>
</div>
