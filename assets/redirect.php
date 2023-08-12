<?php 
const HOME = '\\wagginwheels\\';
const DOMAIN = 'http://localhost/';
function redirect($url = '', $statusCode = 303){
    header('Location: ' . HOME . $url , true, $statusCode);
    die();
}
?>