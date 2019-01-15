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

<h1>Here are all the users registered on the page</h1>
<?php foreach ($users as $user) : ?>
    <h3><a href="../profile/profiles/<?= $user->id ?>"><?= $user->username ?></h3>
    <img src="<?php echo $grav_url . md5(strtolower(trim($user->email))) . "?s=" . $size; ?>" alt="" />
<?php endforeach; ?>
