<?php
require_once 'core/init.php';
if(Input::exists()){
    if(Token::check(Input::get('token'))){
        $validate = new Validate();
        $validation = $validate->check($_POST, [
           'username' => ['required' => true,
           'min' => 2,
           'max' => 20
           ],
            'password' => ['required' => true,
            'min' => 6
            ]
        ]);
        if($validate->passed()){
            $user = new User();
            $login = $user->login(Input::get('username'), Input::get('password'));
            if($login){
                echo 'Success';
            } else {
                echo "Sorry, login failed";
                print_r($login);
            }
        } else {
            foreach($validation->errors() as $error){
                echo $error . "<br>";
            }
        }
    }
}
?>

<form action="" method="post">
<div class="field">
    <label for="username">Username</label>
    <input type="text" name="username" id="username">
</div>
    <div class="field">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
    </div>
    <input type="hidden" name="token" value="<?= Token::generate();?>">
    <input type="submit" value="Log in">
</form>