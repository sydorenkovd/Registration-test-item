<?php
require_once 'core/init.php';

$user = DB::connect()->query("SELECT * FROM users");
if(!$user->count()){
echo 'No user';
} else {
    foreach($user->results() as $user): ?>
        <ul>
        <li> <?= $user->name . "<br>";?></li>
        </ul>

<? endforeach; } ?>