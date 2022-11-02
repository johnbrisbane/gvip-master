<?php  if (! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/

$hook['post_controller_constructor'][] = array(
    'class'    => 'VIP_Hooks',
    'function' => 'post_controller_constructor',
    'filename' => 'VIP_Hooks.php',
    'filepath' => 'hooks',
    'params'   => array()
);