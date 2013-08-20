<?php

/**
 * 
 * ********************* IMPORTANT READ ME READ ME READ ME ****************************
 *
 * YOU MUST SUBSTITUTE YOUR OWN USERNAME, PASSWORD, AND ENDPOINT INTO THIS EXAMPLE! 
 * 
 * ********************* IMPORTANT READ ME READ ME READ ME ****************************
 *
 */

header('Content-Type: text/plain');

$endpoint = 'http://engineering.dev-academickeys.com/api/server.php';

$username = 'peopleadmin';
$password = 'oZ1zFSDOXsFpzxva';

$xml = '<?xml version="1.0" encoding="UTF-8" ?>
<API>
	<Session>
		<APIUsername><![CDATA[' . $username . ']]></APIUsername>
		<APIKey><![CDATA[' . $password . ']]></APIKey>
		<APITicket><![CDATA[ ]]></APITicket>
	</Session>
	<Request type="JobAdd">
		<Job>
			<APIIdentifier><![CDATA[' . mt_rand() . ']]></APIIdentifier>
			
			<Discipline><![CDATA[Engineering]]></Discipline>
			<Organization><![CDATA[SUNY Institute of Technology]]></Organization>
			<OrganizationDescription><![CDATA[ ]]></OrganizationDescription>
			<Department><![CDATA[Engineering, Science and Mathematics]]></Department>
			<DepartmentDescription><![CDATA[ ]]></DepartmentDescription>
			<Title><![CDATA[TEST JOB BY KEITH - YOU CAN DELETE ME]]></Title>
			<Description><![CDATA[bla bla bla description goes here]]></Description>
			<EOAAPolicy><![CDATA[ ]]></EOAAPolicy>
			<Location>
				<City><![CDATA[Utica]]></City>
				<State><![CDATA[NY]]></State>
				<Country><![CDATA[US]]></Country>
			</Location>
			<Contact>
				<Organization><![CDATA[SUNY Institute of Technology]]></Organization>
				<Department><![CDATA[Engineering, Science and Mathematics]]></Department>
				<Name><![CDATA[Anthony F. Panebianco]]></Name>
			</Contact>
			<PositionStartDescription><![CDATA[October 30, 2012]]></PositionStartDescription>
			<PositionDeadlineDescription><![CDATA[February 27, 2013]]></PositionDeadlineDescription>
			<ApplyUrl><![CDATA[http://www.Click2Apply.net/zzwq4hy]]></ApplyUrl>
			
			
			
			
			
			
			
			<!-- THIS IS THE ONLY SECTION THAT REQUIRES CHANGES FOR YOU, PLEASE READ THE COMMENTS BELOW -->
			
			
			
			
			<!-- IF THE PERSON HAS AN EXISTING CONTRACT/PACKAGE WITH US, SEND US THIS: -->
			<!--<ContractRef>
				<ContractID><![CDATA[25030]]></ContractID>
				<PONumber><![CDATA[ ]]></PONumber>
			</ContractRef>-->
			
			<!-- HOWEVER, IF THE PERSON *DOES NOT* HAVE AN EXISTING CONTRACT/PACKAGE WITH US, SEND US THIS INSTEAD: -->
			<ContractRef>
				<PostingOptionID>81</PostingOptionID>
				<PONumber><![CDATA[ ]]></PONumber>
			</ContractRef>
			
			
			
			
			
			<FieldList>
				<Field><![CDATA[Mechanical Engineering]]></Field>
			</FieldList>
			<CategoryList>
				<Category><![CDATA[Associate Professor]]></Category>
			</CategoryList>
			<UpsellList>
				<UpsellID><![CDATA[ ]]></UpsellID>
			</UpsellList>
			<TrackingUrl><![CDATA[https://rs.careerliaison.com/pixel/zzwq4hy]]></TrackingUrl>
			<TrackingScript><![CDATA[ ]]></TrackingScript>
			<ExpireDate><![CDATA[ ]]></ExpireDate>
			<Notes><![CDATA[ ]]></Notes>
		</Job>
	</Request>
</API>';
	
// create a new cURL resource
$ch = curl_init();

// set URL and other appropriate options
curl_setopt($ch, CURLOPT_URL, $endpoint);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// grab URL and pass it to the browser
$return = curl_exec($ch);

// get info from CURL
$info = curl_getinfo($ch);

// close cURL resource, and free up system resources
curl_close($ch);

print('{{' . $return . '}}');
print("\n\n\n\n\n");

if ($info['http_code'] == 200)
{
	// parse XML 
	$XML = simplexml_load_string($return);
	
	$attrs = $XML->Response->attributes();
	
	if (!empty($attrs['status']) and 
		$attrs['status'] == 'Error')
	{
		print('AN ERROR OCCURED [' . $attrs['code'] . ': ' . $attrs['message'] . ']');
	}
	else
	{
		print('JOB ID IS: ' . $XML->Response->Job->JobID . "\n\n");
		print('JOB LINK: ' . $XML->Response->Job->Permalink . "\n\n");
		print('JOB WILL EXPIRE: ' . date('r', strtotime($XML->Response->Job->ExpireDate)) . "\n\n");
	}
}
else
{
	print('Something went really, really wrong...');
}

print("\n\n\n\n");
