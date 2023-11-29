jobs-api_php
============

PHP code examples for the AcademicKeys.com job posting API.

## Endpoints 

* Production: `https://www.academickeys.com/api/server/v1`
* Development: 

## Authentication 

You will be provided with a username and password. The username and password are specified in the XML payloads.

## Adding job postings 

```text
POST /api/server/v1
Content-Type: text/xml 
```
```xml
<?xml version="1.0" encoding="UTF-8" ?>
<API>
	<Session>
		<APIUsername><![CDATA[API username]]></APIUsername>
		<APIKey><![CDATA[API password]]></APIKey>
	</Session>
	<Request type="JobAdd">
		<Job>
			<APIIdentifier><![CDATA[your job ID number goes here]]></APIIdentifier>
			
			<Discipline><![CDATA[Engineering]]></Discipline>
			<Organization><![CDATA[SUNY Institute of Technology]]></Organization>
			<OrganizationDescription><![CDATA[ ]]></OrganizationDescription>
			<Department><![CDATA[Engineering, Science and Mathematics]]></Department>
			<DepartmentDescription><![CDATA[ ]]></DepartmentDescription>
			<Title><![CDATA[Title of the job]]></Title>
			<Description><![CDATA[A description of the job goes here. HTML may be used.]]></Description>
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
			<PositionStartDescription><!-- position start date here --></PositionStartDescription>
			<PositionDeadlineDescription><!-- application deadline date here --></PositionDeadlineDescription>
			<ApplyUrl>https://link-to-job-application-here.com/path/to/application</ApplyUrl>
			
			<!-- IF THE PERSON HAS AN EXISTING CONTRACT/PACKAGE WITH US, SEND US THIS: -->
			<ContractRef>
				<ContractID>25030</ContractID>
				<PONumber><!-- optional --></PONumber>
			</ContractRef>
			
			<!-- HOWEVER, IF THE PERSON *DOES NOT* HAVE AN EXISTING CONTRACT/PACKAGE WITH US, SEND US THIS INSTEAD: -->
			<!--
			<ContractRef>
				<PostingOptionID>81</PostingOptionID>
				<PONumber><![CDATA[ ]]></PONumber>
			</ContractRef>
			-->
			
			<FieldList>
				<Field><![CDATA[Mechanical Engineering]]></Field>
                <!-- This may repeat N times -->
			</FieldList>
			<CategoryList>
				<Category><![CDATA[Associate Professor]]></Category>
                <!-- This may repeat N times -->
			</CategoryList>
			<TrackingUrl><!-- optional --></TrackingUrl>
			<ExpireDate><!-- date in YYYY-MM-DD format --></ExpireDate>
			<Notes><!-- optional --></Notes>
		</Job>
	</Request>
</API>
```

### Notes about example_xml/job_add.xml

* In `job_add.xml`, please pay special attention to the `[ContractRef]` section. You can do ONE of TWO things here: 
   * You can provide a `ContractID` value - this is for a university that has an unlimited posting package with us, or has a 10-job package or something with us. e.g. anything that's not just a one-off posting. 
   * You can provide a `PostingOptionID` value - this is for one-off postings, and I will send you a valid list of options and prices. You can also fetch them using a `PostingOptionSearch` command. 
* In `job_add.xml`, please also note the `[ContractRef]` option `[PONumber]`. You should put your PO # here so we can invoice you later.
* In `job_add.xml`, there is a `[TrackingUrl]` tag. If you have a tracking pixel/image you use, send it to us here (e.g. http://your-domain.com/path/to/tracking/pixel.gif)
* If you have a unique tracking tag/string that must be embedded in the job description/on the job description page, specify that in the `[TrackingTag]` tag. 
* Please send *your job #* or other unique identifier for the job in the `[APIIdentifier]` tag.
* From a response to `job_add.xml`, you will get back a `[JobID]` tag from us. This is our unique JobID value. You should store this in your system.
* From a response to `job_add.xml`, you will get back a `[Permalink]` tag from us. This is a link to the job on our website that you can give to your client.

### Modifying an existing job posting 

```text
POST /api/server/v1
Content-Type: text/xml
```
```xml
<?xml version="1.0" encoding="UTF-8" ?>
<API>
	<Session>
		<APIUsername>your username</APIUsername>
		<APIKey>your password</APIKey>
	</Session>
	<Request type="JobModify">                                                  <!-- Notice that this changed to "JobModify" -->
		<Job>
			<JobID></JobID>                                                     <!-- This is OUR JobID that was returned from "JobAdd", required -->
			
			<!-- This is one of: Administration, Agriculture, Business, Community Colleges, Curriculum & Education, Dentistry, Engineering, Fine Arts, Health Sciences, Humanities, Law, Medicine, Pharmacy, Sciences, Social Sciences, Staff & Non-Managerial Professionals, Veterinary Medicine -->
			<Discipline>Engineering</Discipline>                                <!-- Required -->
			
			<Organization></Organization>                                       <!-- The university name, required -->
			<OrganizationDescription></OrganizationDescription>
			<Department></Department>                                           <!-- The department name, required -->
			<DepartmentDescription></DepartmentDescription>
			<Title></Title>                                                     <!-- The job title, required -->
			<Description></Description>
			<EOAAPolicy></EOAAPolicy>
			<Location>
				<City></City>
				<State></State>
				<Country></Country>
			</Location>
			<Contact>
				<Organization></Organization>
				<Department></Department>
				<Name></Name>
			</Contact>
			<PositionStartDescription></PositionStartDescription>               <!-- e.g. "October 30, 2012", "Immediately", etc. -->
			<PositionDeadlineDescription></PositionDeadlineDescription>         <!-- e.g. "October 30, 2012", "Open until filled", etc. -->
			<ApplyUrl></ApplyUrl>
			<AcceptEmail></AcceptEmail>
			
			<ContractRef>                                                       <!-- Required -->
				
				<!-- If Berkeley College purchased an unlimited posting package, you will always pass a single static ContractID value here -->
				<ContractID>25030</ContractID>
			
				<!-- If they DO NOT purchase an unlimited posting package, I will provide you with a list of valid posting options -->
				<PostingOptionID>81</PostingOptionID>
				
				<PONumber></PONumber>                                           <!-- If there is a PO/IO # you can pass that here, optional -->
			</ContractRef>
			
			<FieldList>
				<Field>Mechanical Engineering</Field>                           <!-- This field may repeat -->
			</FieldList>
			
			<CategoryList>
				<Category>Associate Professor</Category>                        <!-- This field may repeat -->
			</CategoryList>
			
			<TrackingUrl></TrackingUrl>                                         <!-- For tracking pixels/images -->
			<TrackingScript></TrackingScript>                                   <!-- For tracking JavaScript code -->
			<ExpireDate></ExpireDate>
			<Notes></Notes>
		</Job>
	</Request>
</API>
```

### Deleting job postings

```text
POST /api/server/v1
Content-Type: text/xml 
```
```xml 
<?xml version="1.0" encoding="UTF-8" ?>
<API>
	<Session>
		<APIUsername>API username</APIUsername>
		<APIKey>API password</APIKey>
	</Session>
	<Request type="JobDelete">
		<Job>
			<JobID>27591</JobID>	<!-- This is the Academic Keys JobID value -->
		</Job>
	</Request>
</API>
```