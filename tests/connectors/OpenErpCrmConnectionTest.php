<?php

namespace fr\ludovicbouguerra\crmconnector\connectors;

use fr\ludovicbouguerra\crmconnector\models\BaseLead;

include "../../vendors/xmlrpc.inc";
include "../../lib/exceptions/ConnectionException.php";
include "../../lib/interfaces/Identifiable.php";
include "../../lib/interfaces/Lead.php";
include "../../lib/models/BaseLead.php";
include "../../lib/interfaces/CrmConnector.php";
include "../../lib/connectors/OpenErpCrmConnection.php";



class OpenErpCrmConnectionTest {

	public function testCreateLead(){
			
	
	}

}

$openErp = new OpenErpConnection("http://localhost:8069/xmlrpc/", "test", "admin", "test");
//$leadSample = new BaseLead();
//$leadSample->setFullName("Ludovic BouIR");

//$openErp->saveLead($leadSample);
//echo $leadSample->getId();

$openErp->deleteLeadById(106);