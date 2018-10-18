<?php
/**
 * Created by PhpStorm.
 * User: felizmunoz
 * Date: 10/18/18
 * Time: 9:48 AM
 */

require_once(dirname(__Dir__, 2) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;

/**
 * Person who is signed up on ThriveMo
 *
 * this Patient is part of a large network where they can schedule appointments, make payments, and submit prior patient paperwork all online
 */
class Patient {
	/**
	 * id for this Patient; this is the primary key
	 * @var Uuid $patientID
	 */
	private $patientId;
	/**
	 * id of the Profile that belongs to the patient
	 *@var Uuid $patientProfileId
	 */
	private $patientProfileId;
	/**
	 * email of the Patient used when signing up for the site
	 * @var
	 */
	private $patientEmail
	/**
	 *
	 *
	 */
	private $patientUsername
	/**
	 *
	 */
	private $patientInformation
	/**
	 * date and time this Patient post to her account, in a PHP Datetime object
	 * @var \DateTime $patientDate
	 */
	private $patientDate
}