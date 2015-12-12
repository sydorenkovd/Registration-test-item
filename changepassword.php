<?php
require_once 'core/init.php';
$user = new User();
if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}
if(Input::exists()) {
    if (Token::check(Input::get('token'))) ;
    $validate = new Validate();
    $validation = $validate->check($_POST, [
        'password_current' => [
            'required' => true,
            'min' => 6
        ],
        'password_new_again' => [
            'required' => true,
            'matches' => 'password_new'
        ],
        'password_new' => [
            'required' => true,
            'min' => 6
        ],
    ]);
    if($validation->passed()){
        try{
            $user->update([
                'password' => Hash::make(Input::get('password_new'))
            ]);
            Session::flash('home', 'Your password has been updated');
            Redirect::to('index.php');
        } catch(Exception $e ){
            die($e->getMessage());
        }
    } else {
        foreach($validation->errors() as $error){
            echo $error . "<br>";
        }
    }
}
?>
<form action="" method="post">
    <div class="field">
        <label for="password_current">Current password: </label>
        <input type="password" name="password_current" id="password_current">
    </div>
    <div class="field">
        <label for="password_new">Enter new password: </label>
        <input type="password" name="password_new" id="password_new">
    </div>
    <div class="field">
        <label for="password_new_again">Enter new password again: </label>
        <input type="password" name="password_new_again" id="password_new_again">
    </div>
    <input type="submit" value="change">
    <input type="hidden" name="token" value="<?= Token::generate(); ?>">
</form>
