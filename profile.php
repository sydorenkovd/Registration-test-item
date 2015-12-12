<?php
require_once 'core/init.php';

if(!$username = Input::get('user')){
    Redirect::to('index.php');
} else {
    $user = new User($username);
    if(!$user->exists()){
        Redirect::to(404);
    } else {
        $data = $user->data();
        ?>
        <h1><?= escape($data->username); ?></h1>
       <ul><li><?= "Full name: " . escape($data->name); ?></li></ul>
       <ul><li><?= "Registred: " . escape($data->joined); ?></li></ul>
<?php
    }
}?>