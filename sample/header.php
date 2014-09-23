<?php
/* 
 * header.php
 * The purpose of this file is to be included at the beginning
 * of every PHP file (except classes, which go in the library
 * directory). That will ensure that pages within the site work
 * consistently. To include it, the preferred method would be:
 *
 *  require_once('header.php');
 * 
 *  -or-
 *
 *  require_once('../header.php');
 *
 * The second example above is how to include this file from a file
 * in a sub-directory. ".." represents the parent directory and can
 * be used repeatedly (i.e. '../../../header.php').
 */ 
 
define('APP_ROOT', __DIR__);					// Required before loading the framework.
require_once('../framework.php');				// Load the framework.

// Include our private data (not part of the public code, assuming it is in .gitignore).
require_once(INTERNAL_DIR.DS.'Internal.php');
						  
$db = new DatabaseHelper(   Internal::DB_HOST,      Internal::DB_USERNAME, 
							Internal::DB_PASSWORD,  Internal::DB_DATABASE,
							LOG_DIR.DS.'db_log.txt');

// Logging mechanism for developers. Similar to Android's logging mechanism.
$log = new Log(LOG_DIR.DS.'dev_log.txt');
