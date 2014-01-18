<?php
	
	namespace fr\ludovicbouguerra\crmconnector\interfaces;

	interface CrmConnector{
		
		public function createLead($lead);
		public function updateLead($lead);
		public function getLead();
		public function deleteLead($lead);
		
		
		public function createInvoice($lead);
		public function removeInvoice();
		public function getInvoice($lead);
		
	}