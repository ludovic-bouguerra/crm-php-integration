<?php

namespace fr\ludovicbouguerra\crmconnector\connectors;

include "../../vendors/xmlrpc.inc";
include "../../lib/exceptions/ConnectionException.php";
include "../../lib/models/Lead.php";
include "../../lib/interfaces/CrmConnector.php";
include "../../lib/connectors/OpenErpCrmConnection.php";



class OpenErpCrmConnectionTest {

	public function testCreateLead(){
			
	
	}

}

$openErp = new OpenErpConnection("http://localhost:8069/xmlrpc/", "test", "admin", "test");
$openErp->createLead(null);
