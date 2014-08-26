<?php

	namespace fr\ludovicbouguerra\crmconnector\connectors;
	
	use fr\ludovicbouguerra\crmconnector\interfaces\CrmConnector;
	use fr\ludovicbouguerra\crmconnector\interfaces\Lead;
	use fr\ludovicbouguerra\crmconnector\exceptions\ConnectionException;
	
	class OpenErpConnection implements CrmConnector{
		

		private $url;
		private $dbName;
		private $userId;
		private $user;
		private $password;
		private $clientId;
		private $connection;
		
		

		/**
		*	Initialise 
		*	@param url        : http://
		*	@param dbName     : Database Name
		*	@param user       : UserName
		*	@param password   : Password
		*/ 
		public function __construct($url, $dbName, $user, $password){
			$this->url = $url;
			$this->dbName = $dbName;
			$this->user = $user;
			$this->password = $password;
			$this->initConnection();
		}
		

		protected function getXmlRpcCommonPath(){
			return $this->url."common";
		}

		protected function getXmlRpcObjectPath(){
			return $this->url."object";
		}

		protected function initConnection(){
			$sock = new \xmlrpc_client($this->getXmlRpcCommonPath());
			
			$msg = new \xmlrpcmsg('login');
			$msg->addParam(new \xmlrpcval($this->dbName, "string"));
			$msg->addParam(new \xmlrpcval($this->user, "string"));
			$msg->addParam(new \xmlrpcval($this->password, "string"));
			$resp =  $sock->send($msg);
			$val = $resp->value();
			$this->userId = $val->scalarval();

			$this->connection = new \xmlrpc_client($this->getXmlRpcObjectPath());
		
		}
		
		protected function initMessage(){
			$message = new \xmlrpcmsg('execute');
			$message->addParam(new \xmlrpcval($this->dbName, "string"));
			$message->addParam(new \xmlrpcval($this->userId, "int"));
			$message->addParam(new \xmlrpcval($this->password, "string"));
			return $message;
		}
			
		
		public function setUrl($url){
			$this->url = $url;
		}
		

		public function setDbName($dbName){
			$this->dbName = $dbName;
		}
		
		public function setUser($user){
			$this->user = $user;
		}
		
		public function setPassword($password){
			$this->password= $password;
		}
		
		public function createLead(Lead $lead){
			
			$arrayVal = array(
					'name'=>new \xmlrpcval('Ludovic Bouguerra', "string") ,
					'vat'=>new \xmlrpcval('BE477472701' , "string")
			);
			
			$message = $this->initMessage();
			
			$message->addParam(new \xmlrpcval("res.partner", "string"));
			$message->addParam(new \xmlrpcval("create", "string"));
			$message->addParam(new \xmlrpcval($arrayVal, "struct"));
			
			$response = $this->connection->send($message);
			
			if ($response->faultCode())
				throw new ConnectionException("Cannot create partner : ". $response->faultString());
			else
				return $response->value()->scalarval();
		}
		
		public function updateLead(Lead $lead){
			
			
		}
		
		public function getLead($id){
			
		}
		
		public function deleteLead(Lead $lead){
			
		}
		
		public function createInvoice($lead){
			
			
		}
		
		public function removeInvoice(){
			
			
		}
		
		public function getInvoice($lead){
			
			
		}
		
		
	}
