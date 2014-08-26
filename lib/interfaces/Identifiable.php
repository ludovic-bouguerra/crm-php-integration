<?php

	namespace fr\ludovicbouguerra\crmconnector\interfaces;

	interface Identifiable{


		/**
		* Internal Id
		*/
		function getId();

		/**
		*		
		*/
		function setId($id);
	}