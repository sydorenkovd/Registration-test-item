<?php
require_once 'core/init.php';

$user = DB::connect()->update('users', 1, [
    'password' => 'newpassword',
    'name' => 'John Doe'
]);
if($user){
    echo "OK";
} else {
    echo "false";
}
