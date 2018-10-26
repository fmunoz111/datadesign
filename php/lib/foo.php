<?php
/**
 * Created by PhpStorm.
 * User: felizmunoz
 * Date: 10/23/18
 * Time: 1:02 PM
 */
namespace fmunoz11\datadesign;
require_once("../Classes/Patient.php");

try {
	$erika = new Patient("8e9d28c7-86f4-4cd2-bb05-2b8b0c0f3e0e",
		"8e9d28c7-86f4-4cd2-bb05-2b8b0c0f3e0e", "erikadaniell01@gmail.com",
		"erikadanielle01", "erika's info will go here");
} catch(\Exception $e) {
	echo $e->getMessage();
}
var_dump($erika);
