<?php
require_once 'core/init.php';

$user = DB::connect();
if(Session::exists('home')){
    echo "<p><b>" . Session::flash('home') . "</b></p>";
}
echo Session::get(Config::get('session/session_name'));