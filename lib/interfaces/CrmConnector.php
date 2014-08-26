<?php
	
	namespace fr\ludovicbouguerra\crmconnector\interfaces;

	use fr\ludovicbouguerra\crmconnector\interfaces\Lead;


	interface CrmConnector{
		
		/**
		*
		*/
		public function createLead(Lead $lead);

		/**
		*
		*/
		public function updateLead(Lead $lead);
		
		/**
		* Get a lead by internal ID
		* @return fr\ludovicbouguerra\crmconnector\interfaces\Lead Lead
		*/
		public function getLead($id);

		public function deleteLead(Lead $lead);
		
		
		public function createInvoice($lead);
		public function removeInvoice();
		public function getInvoice($lead);
		
	}