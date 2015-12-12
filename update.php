<?php
require_once 'core/init.php';

$user = new User();

if(!$user->isLoggedIn()){
        Redirect::to('index.php');
}
if(Input::exists()){
    if(Token::check(Input::get('token')));
    $validate = new Validate();
    $validation = $validate->check($_POST, [
        'name' => [
            'required' => true,
            'min' => 2,
            'max' => 20
        ]
    ]);
    if($validation->passed()){
        try{
            $user->update([
                'name' => Input::get('name')
            ]);
            Session::flash('home', 'Your info has been updated');
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
<form method="post" action="">
    <div class="fields">
        <label for="name">Name</label>
        <input type="text" name="name" value="<?= escape($user->data()->name); ?>">
        <input type="submit" value="update">
        <input type="hidden" name="token" value="<?= Token::generate(); ?>">
    </div>
</form>
