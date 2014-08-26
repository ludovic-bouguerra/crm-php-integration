<?php

	namespace fr\ludovicbouguerra\crmconnector\connectors;
	
	use fr\ludovicbouguerra\crmconnector\interfaces\CrmConnector;
	use fr\ludovicbouguerra\crmconnector\interfaces\Lead;
	use fr\ludovicbouguerra\crmconnector\exceptions\ConnectionException;
	use fr\ludovicbouguerra\crmconnector\interfaces\Identifiable;

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
			if ($resp->errno != 0){
				throw new ConnectionException($resp->errstr);
			}
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
			
		protected function execute($model, $action, $params){
			$message = $this->initMessage();
			
			$message->addParam(new \xmlrpcval($model, "string"));
			$message->addParam(new \xmlrpcval($action, "string"));
			foreach ($params as $param){
				$message->addParam($param);	
			}
			$response = $this->connection->send($message);
			
			if ($response->faultCode())
				throw new ConnectionException($response->faultString());
			else
				return $response;
		}
		
		protected function executeDelete($model, $id){
			$arrayIds = array(new \xmlrpcval($id, "int"));
			$this->execute($model, "unlink", array(new \xmlrpcval($arrayIds, "array")));
		}

		protected function executeCreate($model, $array, Identifiable $identifiable){
			$response = $this->execute($model, "create", array(new \xmlrpcval($array, "struct")));
			$identifiable->setId($response->value()->scalarval());

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
		
		public function saveLead(Lead $lead){
						
			$arrayVal = array(
					'name'=>new \xmlrpcval($lead->getFullName(), "string") ,
			);
			
			$response = $this->executeCreate("res.partner", $arrayVal, $lead);
		}
		
		
		public function getLead($id){
			
		}
		
		public function deleteLead(Lead $lead){
			$this->deleteLeadById($lead->getId());
		}

		public function deleteLeadById($id){
			$this->executeDelete("res.partner", $id);
		}
		
		public function createInvoice($lead){
			
			
		}
		
		public function deleteInvoice($id){
			
			
		}
		
		public function getInvoice($lead){
			
			
		}
		
		
	}
