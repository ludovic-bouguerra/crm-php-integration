<?php

namespace fr\ludovicbouguerra\crmconnector\exceptions;

class ConnectionException extends \Exception{
	
	public function __construct($message){
		parent::__construct($message);
	}
	
	
}