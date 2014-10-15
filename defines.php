<?php
// Shorthand for PHP's constants
define('DS',            DIRECTORY_SEPARATOR);
define('NL',            PHP_EOL);				// New Line

// No trailing slash on directories!
// These are the absolute file paths (e.g. "/home/username/public_html/filename.ext")
define('FRAMEWORK_ROOT', __DIR__);
define('FRAMEWORK_LIBS', __DIR__.DS.'lib');
define('FRAMEWORK_LOGS', __DIR__.DS.'log');

// The originating PHP page, relative to the web-facing root, such as /app/index.php.
define('PARENT_SCRIPT', htmlspecialchars($_SERVER['SCRIPT_NAME']));

// These are grouped here because of a dependency on the autoload implementation. It searches the app's libraries too.
define('INC_DIR', 	   APP_ROOT.DS.'inc');
define('LIB_DIR',      APP_ROOT.DS.'lib');
define('LOG_DIR',      APP_ROOT.DS.'log');
define('INTERNAL_DIR', APP_ROOT.DS.'internal');
