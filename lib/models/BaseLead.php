<?php

namespace fr\ludovicbouguerra\crmconnector\models;

use fr\ludovicbouguerra\crmconnector\interfaces\Lead;

class BaseLead implements Lead{
	

	private $id;
	private $email;
	
	private $lastName;
	private $fullName;

	/**
	 * Adresse
	 * @var unknown
	 */
	private $street;
	private $street2;
	private $zip;
	
	
	private $title;
	private $subject;

	private $phone;
	private $mobilePhone;
	
	private $webSite;
	
	private $properties;

	public function __construct(){
		$this->properties = array();
	}

	/**
	* Internal Id
	*/
	function getId(){
		return $this->id;
	}

	function getFirstName(){
		return $this->firstName;
	}
	
	function getLastName(){
		return $this->lastName;
	}

	function getFullName(){
		return $this->fullName;
	}

	function getWebSite(){
		return $this->webSite;
	}

	function getPhone(){
		return $this->phone;
	}

	function getMobilePhone(){
		return $this->mobilePhone;
	}

	function getEmail(){
		return $this->email;
	}

	function setId($id){
		$this->id = $id;
	}

	function setFirstName($firstName){
		$this->firstName = $firstName;
	}
	
	function setLastName($lastName){
		$this->lastName = $lastName;
	}

	function setFullName($fullName){
		$this->fullName = $fullName;
	}

	function setWebSite($webSite){
		$this->webSite = $webSite;
	}

	function setPhone($phone){
		$this->phone = $phone;
	}

	function setMobilePhone($mobilePhone){
		$this->mobilePhone = $mobilePhone;
	}

	function setEmail($email){
		$this->email = $email;
	}

	/**
	*	
	*/
	function getProperty($propertyName){
		if (isset($this->properties[$propertyName]))
			return $this->properties[$propertyName];
		else
			return null;
	}

	function setProperty($propertyName, $propertyValue){
		$this->properties[$propertyName] = $propertyValue;
	}
	
	
}