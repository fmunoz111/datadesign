<?php
/**
 * Created by PhpStorm.
 * User: felizmunoz
 * Date: 10/18/18
 * Time: 9:48 AM
 */

namespace fmunoz11\datadesign;
require_once("autoload.php");
require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");
use Ramsey\Uuid\Uuid;

/**
 * Person who is signed up on ThriveMo
 *
 * this Patient is part of a large network where they can schedule appointments, make payments, and submit prior patient paperwork all online
 * @author Feliz Munoz <fmunoz11@cnm.edu>
 * @version 3.0.0
 **/

class Patient {
	use ValidateUuid;
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
	 * constructor for this Patient
	 *
	 * @param string|Uuid $newPatientId id of this Patient or null if a new Patient
	 * @param string|Uuid $newPatientProfileId id of the Profile that created this Profile
	 * @param string $newPatientEmail string containing actual patient email
	 * @param string $newPatientUsername string containing actual patient username
	 * @param string $newPatientInformation string containing actual patient information
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 **/
	public function __construct($newPatientId, $newPatientProfileId, string $newPatientEmail, $newPatientUsername, $newPatientInformation= null) {
	try {
		$this->setPatientId($newPatientId);
		$this->setPatientProfileId($newPatientProfileId);
		$this->setPatientEmail($newPatientEmail);
		$this->setPatientUsername($newPatientUsername);
		$this->setPatientInformation($newPatientInformation);
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
public function getPatientId() : Uuid {
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
		$newPatientId = self::ValidateUuid($newPatientId);
	} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
		$exceptionType = get_class($exception);
		throw(new $exceptionType($exception->getMessage(), 0, $exception));
	}

	// convert and store the patient id
	$this->patientId = $newPatientId;
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
 * @param | Uuid $newPatientProfileId new value of patient profile id
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
public function setPatientUsername(string $newPatientUsername) : void {
	// verify the patient username is secure
	$newPatientUsername = trim( $newPatientUsername);
	$newPatientUsername = filter_var($newPatientUsername, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	if(empty($newPatientUsername) === true) {
		throw(new \InvalidArgumentException("patient username is empty or insecure"));
	}

	// verify the patient username will fit in the database
	if(strlen($newPatientUsername) >= 115) {
		throw(new \RangeException("patient username too large"));
	}

	// store the patient username
	$this->patientUsername = $newPatientUsername;
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


public function insert(\PDO $pdo) : void {

	// create query template
	$query = "INSERT INTO patient(patientId, patientProfileId, patientEmail, patientUsername, patientInformation) VALUES(:patientId, :patientProfileId, :patientEmail, :patientUsername, :patientInformation)";
	$statement = $pdo->prepare($query);
	}

	/**
	 * deletes this Patient from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo) : void {

		// create query template
		$query = "DELETE FROM patient WHERE patientId = :patientId";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holder in the template
		$parameters = ["patientId" => $this->patientId->getBytes()];
		$statement->execute($parameters);
	}

	/**
	 * updates this Patient in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo) : void {

		// create query template
		$query = "UPDATE patient SET patientProfileId = :patientProfileId, patientEmail =
 		:patientEmail, patientUsername = :patientUsername, patientInformation = :patientInformation WHERE patientId = :patientId";
		$statement = $pdo->prepare($query);
	}

	/**
	 * gets the Patient by patientId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $patientId patient id to search for
	 * @return Patient|null Patient found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when a variable are not the correct data type
	 **/
	public static function getPatientByPatientId(\PDO $pdo, $patientId) : ?Patient {
		// sanitize the patientId before searching
		try {
			$patientId = self::validateUuid($patientId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		// create query template
		$query = "SELECT patientId, patientProfileId, patientEmail, patientUsername, patientInformation FROM patient WHERE patientId = :patientId";
		$statement = $pdo->prepare($query);

		// bind the patient id to the place holder in the template
		$parameters = ["patientId" => $patientId->getBytes()];
		$statement->execute($parameters);

		// grab the patient from mySQL
		try {
			$patient = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$patient = new Tweet($row["patientId"], $row["patientProfileId"], $row["patientEmail"], $row["patientUsername"], $row["patientInformation"]);
			}
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($patient);
	}

	/**
	 * gets the patient by profile id
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $patientProfileId profile id to search by
	 * @return \SplFixedArray SplFixedArray of Patients found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getPatientByPatientProfileId(\PDO $pdo, $patientProfileId) : \SplFixedArray {

		try {
			$patientProfileId = self::validateUuid($patientProfileId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}

		// create query template
		$query = "SELECT patientId, patientProfileId, patientEmail, patientUsername, patientInformation FROM patient WHERE patientProfileId = :patientProfileId";
		$statement = $pdo->prepare($query);
		// bind the patient profile id to the place holder in the template
		$parameters = ["patientProfileId" => $patientProfileId->getBytes()];
		$statement->execute($parameters);
		// build an array of patients
		$patients = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$patient = new Patient($row["patientId"], $row["patientProfileId"], $row["patientEmail"], $row["patientUsername"], $row["patientInformation"]);
				$patients[$patients->key()] = $patient;
				$patients->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($patients);
	}
	/**
	 * gets the patient by email
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $tweetEmail patient email to search for
	 * @return \SplFixedArray SplFixedArray of Patients found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getPatientByPatientEmail(\PDO $pdo, string $patientEmail) : \SplFixedArray {
		// sanitize the description before searching
		$patientEmail = trim($patientEmail);
		$patientEmail = filter_var($patientEmail, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($tweetContent) === true) {
			throw(new \PDOException("patient email is invalid"));
		}
		// escape any mySQL wild cards
		$patientEmail = str_replace("_", "\\_", str_replace("%", "\\%", $patientEmail));

		// create query template
		$query = "SELECT patientId, patientProfileId, patientEmail, patientUsername, patientInformation FROM patient WHERE patientEmail LIKE :patientEmail";
		$statement = $pdo->prepare($query);
		// bind the patient email to the place holder in the template
		$patientEmail = "%patientEmail%";
		$parameters = ["patientEmail" => $patientEmail];
		$statement->execute($parameters);

		// build an array of patients
		$patients = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$patient = new Patient($row["patientId"], $row["patientProfileId"], $row["patientEmail"], $row["patientUsername"], $row["patientInformation"]);
				$patients[$patients->key()] = $patient;
				$patients->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($patients);
	}
	/**
	 * gets the Patient by patientUsername
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $patientUsername username to search by
	 * @return \SplFixedArray SplFixedArray of Patients found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getPatientByPatientUsername(\PDO $pdo, $patientUsername) : \SplFixedArray {

		try {
			$patientUsername = self::validateUuid($patientUsername);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}

		// create query template
		$query = "SELECT patientId, patientProfileId, patientEmail, patientUsername, patientInformation FROM patient WHERE patientUsername = :patientUsername";
		$statement = $pdo->prepare($query);
		// bind the patient username to the place holder in the template
		$parameters = ["patientUsername" => $patientUsername->getBytes()];
		$statement->execute($parameters);
		// build an array of patients
		$patients = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$patient = new Patient($row["patientId"], $row["patientProfileId"], $row["patientEmail"], $row["patientUsername"], $row["patientInformation"]);
				$patient[$patients->key()] = $patient;
				$patients->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($patients);
	}
	/**
	 * gets the Patient by patient information
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $patientInformation patient information to search by
	 * @return \SplFixedArray SplFixedArray of Patients found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getPatientByPatientInformation(\PDO $pdo, $patientInformation) : \SplFixedArray {

		try {
			$patientInformation = self::validateUuid($patientInformation);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}

		// create query template
		$query = "SELECT patientId, patientProfileId, patientEmail, patientUsername, patientInformation FROM patient WHERE patientInformation = :patientInformation";
		$statement = $pdo->prepare($query);
		// bind the patient information to the place holder in the template
		$parameters = ["patientInformation" => $patientInformation->getBytes()];
		$statement->execute($parameters);
		// build an array of patients
		$patients = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$patient = new Patient($row["patientId"], $row["patientProfileId"], $row["patientEmail"], $row["patientUsername"], $row["patientInformation"]);
				$patients[$patients->key()] = $patient;
				$patients->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($patients);
	}
	/**
	 * gets all Patients
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of Patients found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getAllPatients(\PDO $pdo) : \SPLFixedArray {
		// create query template
		$query = "SELECT patientId, patientProfileId, patientEmail, patientUsername, patientInformation FROM patient";
		$statement = $pdo->prepare($query);
		$statement->execute();

		// build an array of patients
		$patients = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$patient = new Patient($row["patientId"], $row["patientProfileId"], $row["patientEmail"], $row["patientUsername"], $row["patientInformation"]);
				$patients[$patients->key()] = $patient;
				$patient->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($patients);
	}

	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() : array {
		$fields = get_object_vars($this);

		$fields["patientId"] = $this->patientId->toString();
		$fields["patientProfileId"] = $this->patientProfileId->toString();

	}
}
