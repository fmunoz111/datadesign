<?php
/**
 * Created by PhpStorm.
 * User: felizmunoz
 * Date: 10/21/18
 * Time: 2:25 PM
 */

/**
 *PSR-4 Compliant Autoloader
 *
 *This will dynamically load calsses by resolving the prefix and class name. T This is the mothod that frameworkds
 * such as Laravel and Composer automatically resolve class names and load them.  To use it, simiply set the
 * configurable parameters inside the closure.  This example is taken form PHP-FIG, referenced below.
 *
 * @see http://www.php-fig.org/psr-4/examples/ PSR-4
 * Example Autoloader
 **/
spl_autoload_register(function($class) {
	/**
	 * CONFIGURABLE PARAMETERS
	 * prefix: the prefix for all the classes (i.e., the namespace)
	 * baseDir: the base directory for all classes (default = current directory)
	 **/
	$prefix = "fmunoz11\\datadesign";
	$baseDir = __DIR__;

	// does the class use the namespace prefix?
	$len = strlen($prefix);
	if (strncmp($prefix, $class, $len) !== 0) {
		// no, move to the next registered autoloader
		return;
	}
	// get the relative class name
	$className = substr($class, $len);

	// replace the namespace prefix iwth the base directory, replace namespace
	//seperators with directory separators in the relative class name, append
	// with .php
	$file = $baseDir . str_replace("\\", "/", $className) . "php";

	// if the file exists, require it
	if(file_exists($file)) {
		require_once($file);
	}
});