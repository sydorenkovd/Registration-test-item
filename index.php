<?php
require_once 'core/init.php';

$user = DB::connect();
if(Session::exists('home')){
    echo "<p><b>" . Session::flash('home') . "</b></p>";
}
$user = new User();
if($user->isLoggedIn()){
    ?>
    <p>Hello, <a href="profile.php?user=<?= escape($user->data()->username); ?>"><?= $user->data()->username?></a></p>
<ul>
    <li>You can <a href="logout.php">log out</a> here!</li>
    <li>You can <a href="update.php">update</a> your profile here!</li>
    <li>You can <a href="changepassword.php">change password</a> here!</li>
</ul>
<?php
    if($user->hasPermission('admin')){
echo 'You are  an admin';
    }
} else {
    echo "<p>You need to <a href='login.php'>log in</a> or <a href='register.php'>register</a>!" . "</p>";
}
 ?>