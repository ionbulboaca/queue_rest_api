<?php

defined('APP_NAME') || define('APP_NAME',(getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'Queue App'));

$page = explode('/', substr($_SERVER['REQUEST_URI'], 1), 2);

if(is_file($_SERVER['DOCUMENT_ROOT'] .'/vars.json') === false)
    if(empty($page[0]))
        $path = file_get_contents(dirname(dirname(__FILE__)) . '/vars.json');
    else
        $path = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/'.str_replace("-"," ", $page[0]) .'/vars.json');
else
    $path = file_get_contents($_SERVER['DOCUMENT_ROOT'] .'/vars.json');

$vars = json_decode($path, false, 512, false);

define( 'BASE_URL', siteURL(). $vars->app_root );

function siteURL()
{
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $domainName = $_SERVER['HTTP_HOST'];
    return $protocol.$domainName;
}