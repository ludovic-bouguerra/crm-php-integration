<?php

	namespace fr\ludovicbouguerra\crmconnector\interfaces;

	interface Lead{

		/**
		* Internal Id
		*/
		function getId();

		function getFirstName();
		
		function getLastName();

		function getFullName();

		function getWebSite();

		function getPhone();

		function getMobilePhone();

		function getEmail();

		function setId($id);

		function setFirstName($firstName);
		
		function setLastName($lastName);

		function setFullName($fullName);

		function setWebSite($website);

		function setPhone($phone);

		function setMobilePhone($mobilePhone);

		function setEmail($email);

		/**
		*	
		*/
		function getProperty($propertyName);
		function setProperty($propertyName, $propertyValue);
	}