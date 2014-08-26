<?php
	
	namespace fr\ludovicbouguerra\crmconnector\interfaces;

	use fr\ludovicbouguerra\crmconnector\interfaces\Lead;


	interface CrmConnector{
		
		/**
		*	Save or Update Lead
		*/
		public function saveLead(Lead $lead);

		/**
		* Get a lead by internal ID
		* @return fr\ludovicbouguerra\crmconnector\interfaces\Lead Lead
		*/
		public function getLead($id);

		public function deleteLead(Lead $lead);
		
		
		public function createInvoice($invoic);
		public function deleteInvoice($id);
		public function getInvoice($id);
		
	}