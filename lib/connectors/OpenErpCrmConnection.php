<?php

	namespace fr\ludovicbouguerra\crmconnector\connectors;
	
	use fr\ludovicbouguerra\crmconnector\interfaces\CrmConnector;
	use fr\ludovicbouguerra\crmconnector\interfaces\Lead;
use fr\ludovicbouguerra\crmconnector\exceptions\ConnectionException;
		
	class OpenErpConnection implements CrmConnector{
		
		private $host;
		private $port;
		private $url;
		private $dbName;
		private $userId;
		private $user;
		private $password;
		private $clientId;
		private $connection;
		
		
		protected function getOrInitConnection(){
			if ($this->connection == null){
				$this->connection = new \xmlrpc_client($this->url,$this->host,$this->port);
				$sock = new \xmlrpc_client($this->url."common");
				
				$msg = new \xmlrpcmsg('login');
				$msg->addParam(new \xmlrpcval($this->dbName, "string"));
				$msg->addParam(new \xmlrpcval($this->user, "string"));
				$msg->addParam(new \xmlrpcval($this->password, "string"));
				$resp =  $sock->send($msg);
				$val = $resp->value();
				$this->userId = $val->scalarval();
			}	
			return $this->connection;
		}
		
		protected function initMessage(){
			$message = new \xmlrpcmsg('execute');
			$message->addParam(new \xmlrpcval($this->dbName, "string"));
			$message->addParam(new \xmlrpcval($this->userId, "int"));
			$message->addParam(new \xmlrpcval($this->password, "string"));
			return $message;
		}
			
		public function setPort($port){
			$this->port = $port;
		}
		
		public function setHost($host){
			$this->host = $host;
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
		
		public function createLead($lead){
			
			$arrayVal = array(
					'name'=>new \xmlrpcval('Ludovic Bouguerra', "string") ,
					'vat'=>new \xmlrpcval('BE477472701' , "string")
			);
			
			$message = $this->initMessage();
			$message->addParam(new \xmlrpcval("res.partner", "string"));
			$message->addParam(new \xmlrpcval("create", "string"));
			$message->addParam(new \xmlrpcval($arrayVal, "struct"));
			
			$response = $this->getOrInitConnection()->send($message);

			if ($response->faultCode())
				throw new ConnectionException("Cannot create partner". $response->faultString());
			else
				return $response->value()->scalarval();
		}
		
		public function updateLead($lead){
			
			
		}
		
		public function getLead(){
			
		}
		
		public function deleteLead($lead){
			
		}
		
		public function createInvoice($lead){
			
			
		}
		
		public function removeInvoice(){
			
			
		}
		
		public function getInvoice($lead){
			
			
		}
		
		
	}
