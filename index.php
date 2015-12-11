<?php
require_once 'core/init.php';

$user = DB::connect()->get('users', ['username', '=', 'Bob']);
if(!$user->count()){
echo 'No user';
} else {
    echo 'Ok';
}