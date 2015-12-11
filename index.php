<?php
require_once 'core/init.php';

$user = DB::connect();
if(Session::exists('success')){
    echo Session::flash('success');
}