<?php

namespace fr\ludovicbouguerra\crmconnector\connectors;

include "../../vendors/xmlrpc-3.0.0.beta/lib/xmlrpc.inc";
include "../../lib/exceptions/ConnectionException.php";
include "../../lib/models/Lead.php";
include "../../lib/interfaces/CrmConnector.php";
include "../../lib/connectors/OpenErpCrmConnection.php";



class OpenErpCrmConnectionTest {

	public function testCreateLead(){
			
	
	}

}

$openErp = new OpenErpConnection();
$openErp->setHost("localhost");
$openErp->setPort(8069);
$openErp->setUrl("http://localhost:8069/xmlrpc/");
$openErp->setDbName("kalyzee");
$openErp->setUser("admin");
$openErp->setPassword("test");
$openErp->createLead(null);
