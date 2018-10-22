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
	 **/
	private $patientId;
	/**
	 * id of the Profile that belongs to the patient
	 * @var Uuid $patientProfileId
	 **/
	private $patientProfileId;
	/**
	 * email of the Patient used when signing up for the site
	 * @var string $patientEmail
	 **/
	private $patientEmail;
	/**
	 *name given for the Patient on the site that appears when the post to the site.
	 * @var string $patientUsername
	 **/
	private $patientUsername;
	/**
	 *actual textual content that the Patient will post to their account.
	 * @var string $patientInformation
	 **/
	private $patientInformation;
	/**
	 * date and time this Patient post to her account, in a PHP Datetime object
	 * @var \DateTime $patientDate
	 **/
	private $patientDate;

	/**
	 * constructor for this Patient
	 * 
	 */
	/**
	 * constructor for this Tweet
	 *
	 * @param string|Uuid $newPatientId id of this Patient or null if a new Patient
	 * @param string|Uuid $newPatientProfileId id of the Profile that created this Profile
	 * @param string $newPatientEmail string containing actual patient email
	 * @param string $newPatientUsername string containing actual patient username
	 * @param string $newPatientInformation string containing actual patient information
	 * @param \DateTime|string|null $patientDate date and time patient post or null if set to current date and time
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 **/
	public function __construct($newPatientId, $newPatientProfileId, string $newPatientEmail, $newPatientUsername, $newPatientInformation, $newPatientDate = null) {
	try {
		$this->setPatientId($newPatientId);
		$this->setPatientProfileId($newPatientProfileId);
		$this->setPatientEmail($newPatientEmail);
		$this->setPatientUsername($newPatientUsername);
		$this->setPatientInformation($newPatientInformation);
		$this->setPatientDate($newPatientDate);
	}
		//determine what exception type was thrown
	catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
		$exceptionType = get_class($exception);
		throw(new $exceptionType($exception->getMessage(), 0, $exception));
	}
}

/**
 * accessor method for patient id
 *
 * @return Uuid value of patient id
 **/
public function gePatientId() : Uuid {
	return($this->patientId);

	//this outside of class
	//$patient->getPatientId();
}

/**
 * mutator method for patient id
 *
 * @param Uuid|string $newPatientId new value of patient id
 * @throws \RangeException if $newPatientId is not positive
 * @throws \TypeError if $newPatientId is not a uuid or string
 **/
public function setPatientId( $newPatientId) : void {
	try {
		$uuid = self::validateUuid($newPatientId);
	} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {

	}

	// convert and store the patient id
	$this->patientId = $uuid;
}

/**
 * accessor method for patient profile id
 *
 * @return Uuid value of patient profile id
 **/
public function getPatientProfileId() : Uuid{
	return($this->patientProfileId);
}

/**
 * mutator method for patient profile id
 *
 * @param string | Uuid $newPatientProfileId new value of patient profile id
 * @throws \RangeException if $newPatientProfileId is not positive
 * @throws \TypeError if $newPatientProfileId is not an integer
 **/
public function setPatientProfileId( $newPatientProfileId) : void {
	try {
		$uuid = self::validateUuid($newPatientProfileId);
	} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
		$exceptionType = get_class($exception);
		throw(new $exceptionType($exception->getMessage(), 0, $exception));
	}
	// convert and store the profile id
	$this->patientProfileId = $uuid;
}

/**
 * accessor method for patient email
 *
 * @return string value of patient email
 **/
public function getPatientEmail() : string {
	return($this->patientEmail);
}

/**
 * mutator method for patient email
 *
 * @param string $newPatientEmail new value of patient email
 * @throws \InvalidArgumentException if $newPatientEmail is not a string or insecure
 * @throws \RangeException if $newPatientEmail is > 115 characters
 * @throws \TypeError if $newPatientEmail is not a string
 **/
public function setPatientEmail(string $newPatientEmail) : void {
	// verify the patient email is secure
	$newPatientEmail = trim($newPatientEmail);
	$newPatientEmail = filter_var($newPatientEmail, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	if(empty($newPatientEmail) === true) {
		throw(new \InvalidArgumentException("patient email is empty or insecure"));
	}
	// verify the patient email will fit in the database
	if(strlen($newPatientEmail) >= 115) {
		throw(new \RangeException("patient email too large"));
	}

	// store the tweet content
	$this->patientEmail = $newPatientEmail;
}

/**
 * accessor method for patient username
 *
 * @return string value of patient username
 **/
public function getPatientUsername() : string {
	return($this->patientUsername);
}

/**
 * mutator method for patient username
 *
 * @param string $newPatientUsername new value of patient username
 * @throws \InvalidArgumentException if $patient username is not a string or insecure
 * @throws \RangeException if $newPatientUsername is > 115 characters
 * @throws \TypeError if $newPatientUsername is not a string
 **/
public function setPatientUsername(string $newpPatientEmail) : void {
	// verify the patient username is secure
	$newPatientUsername = trim($newPatientUsername);
	$newPatientUsername = filter_var($newPatientUsername, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	if(empty($newPatientUsername) === true) {
		throw(new \InvalidArgumentException("patient username is empty or insecure"));
	}

	// verify the patient username will fit in the database
	if(strlen($newPatientUsername) >= 115) {
		throw(new \RangeException("patient username too large"));
	}

	// store the patient username
	$this->patientusername = $newPatientUsername;
}

/**
 * accessor method for patient information
 *
 * @return string value of patient information
 **/
public function getPatientInformation() : string {
	return($this->patientInformation);
}

/**
 * mutator method for patient information
 *
 * @param string $newPatientInformation new value of patient information
 * @throws \InvalidArgumentException if $newPatientInformation is not a string or insecure
 * @throws \RangeException if $newPatientInformation is > 255 characters
 * @throws \TypeError if $newPatientInformation is not a string
 **/
public function setPatientInformation(string $newPatientInformation) : void {
	// verify the patient information is secure
	$newPatientInformation = trim($newPatientInformation);
	$newPatientInformation = filter_var($newPatientInformation, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	if(empty($newPatientInformation) === true) {
		throw(new \InvalidArgumentException("patient information is empty or insecure"));
	}

	// verify the patient information will fit in the database
	if(strlen($newPatientInformation) >= 255) {
		throw(new \RangeException("patient information too large"));
	}

	// store the patient information
	$this->patientInformation = $newPatientInformation;
}

/**
 * accessor method for tweet date
 *
 * @return \DateTime value of tweet date
 **/
public function getPatientDate() : \DateTime {
	return($this->patientDate);
}

/**
 * mutator method for patient date
 *
 * @param \DateTime|string|null $newPatientDate patient date as a DateTime object or string (or null to load the current time)
 * @throws \InvalidArgumentException if $newPatientDate is not a valid object or string
 * @throws \RangeException if $newPatientDate is a date that does not exist
 **/
public function setPatientDate($newPatientDate = null) : void {
	// base case: if the date is null, use the current date and time
	if($newPatientDate === null) {
		$this->patientDate = new \DateTime();
		return;
	}

	// store the like date using the ValidateDate trait
	try {
		$newPatientDate = self::validateDateTime($newPatientDate);
	} catch(\InvalidArgumentException | \RangeException $exception) {
		$exceptionType = get_class($exception);
		throw(new $exceptionType($exception->getMessage(), 0, $exception));
	}
	$this->patientDate = $newPatientDate;
}
}

