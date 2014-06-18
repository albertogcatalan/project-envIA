<?php

/*
 * General
 */

$_config['domain'] = $_SERVER['HTTP_HOST'];

$_config['http_mode'] = "http://";
$_config['environment'] = "develop";
$_config['template_cache'] = false;

/*
 * Database
 */
 
$_config['ddbb']['hostname'] = 'localhost';
$_config['ddbb']['username'] = 'root';
$_config['ddbb']['password'] = 'root';
$_config['ddbb']['database'] = 'envdb';

/*
 * COOKIE
 */
 
$_config['cookie_name'] = "envIAdata";
$_config['cookie_domain'] = $_config['domain'];
$_config['cookie_path'] = "/";

/*
 * Global variables DO NOT TOUCH
 */
$_user = '';

