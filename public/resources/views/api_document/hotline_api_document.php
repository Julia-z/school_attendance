<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>API Documentation</title>
</head>

<body>

	<h1 align="center">Hotline API Documentation</h1>
	<br/>
	<br/>
	All Documents :
    <ul>
    	<li><a href ="old_ufow">Old UFOW API Documentation</a></li>
        <li><a href ="east_gate">East Gate API Documentation</a></li>
        <li><a href ="pip">PIP API Documentation</a></li>
        <li><a href ="hotline">Hotline API Documentation</a></li>
        <li><a href ="zwwtp">ZWWTP API Documentation</a></li>
		<li><a href ="ufow">UFOW API Documentation</a></li>
    </ul>
    <br/>
    <br/>
    <h4>
    	All requests should be made to: http://www.deerail.com/HotlineApi
    </h4>
	<h4>
    	All responses are JSON Object with 3 params
    </h4>
    <ul>
        <li>Response (Boolean with1 for success)</li>
        <li>Data</li>
        <li>Message</li>
    </ul>
    <h4>
    	All API calls should contain four essential parameters:
    </h4>	
    <ul>
        <li>username (This is the name of the user logged into the app</li>
        <li>password (MD5 hash of the password used to log in)</li>
        <li>type (Will be specified later for all calls)</li>
    </ul>
        
    All Methods:
    <ul>
    	<li>Get Methods
        	<ul>
            	<li><a href="#get_users">Get Users</a></li>
				<li><a href="#get_daily_records">Get Daily Records</a></li>
            	<li><a href="#get_buildings_tanks">Get Buildings Tanks</a></li>
			</ul>
            <span>
                <i>N.B.</i>&nbsp;:&nbsp;All Get Calls should contain one extra parameter (timestamp).
                <br/>
                This value will tell the api when last the app received any values, so no values will be returned if nothing changed.
            </span>
        </li>
        <li>Post Methods
        	<ul>
            	<li><a href="#add_record">Add Plant Entrance</a></li>
            	<li><a href="#add_app_id">Add App Id</a></li>
                <li><a href="#verify_record">Verify Record</a></li>
            	<li><a href="#add_user_activity">Add User Activity</a></li>
            </ul>
            <span>
                <i>N.B.</i>&nbsp;:&nbsp;All Post Calls should contain one extra parameter (jsonObject).
                <br/>
                This value will tell the api what values to upload to the database.
            </span>
        </li>
    </ul>
    
    
    <h3>Get Methods</h3>
    <h4 id="get_users">Get Users</h4>
	<p>
    	The call should look like this<br/>
        <code>http://deerail.com/HotlineApi?type=Users&amp;username=xxx&amp;password=xxxxxxxxxxxxxxxxxxxxxx&amp;timestamp=2018-08-08 08:08:08</code>
        <br/>
    	<span>This call return a list of all system_users</span>
    	Each User has the following information : 
        <ul>
        	<li>Id (GUID)</li>
            <li>First_name_ar</li>
            <li>Last_name_ar</li>
            <li>First_name_en</li>
            <li>Last_name_en</li>
            <li>Username</li>
            <li>Password (MD5 hashed)</li>
            <li>Employer_Id</li>
            <li>Role_Id (15 reffers to a driver)</li>
            <li>hotline_app (Boolean, if 1 user can log into the app)</li>
         </ul>
     </p>
     
    <h4 id="get_daily_records">Get Daily Records</h4>
    <p>
    	The call should look like this<br/>
        <code>http://deerail.com/HotlineApi?type=GetDailyLogs&amp;username=xxx&amp;password=xxxxxxxxxxxxxxxxxxxxxx&amp;timestamp=2018-08-08 08:08:08</code>
        <br/>
    	<span>This call return a list of all Records added Daily</span>
        <br/>
    	Each Record has the following information : 
        <ul>
        	<li>complaint_id (GUID)</li>
            <li>timestamp_created</li>
            <li>caller_fname</li>
            <li>caller_lname</li>
            <li>caller_phone</li>
            <li>building
            	<ul>JSON Object containing following fields : 
                	<li>building_id</li>
                    <li>district</li>
                    <li>block</li>
                    <li>building_number</li>
                 </ul>
            </li>
            <li>tank
            	<ul>JSON Object containing following fields : 
                	<li>tank_id</li>
                    <li>district</li>
                    <li>block</li>
                    <li>tank_number</li>
                 </ul>
            </li>
            <li>comment
            	<ul>JSON Object containing following fields : 
                	<li>comment_id</li>
                    <li>content</li>
                 </ul>
            </li>
            <li>complaint_status</li>
            <li>verification_status</li>
            <li>timestamp_verified</li>
            <li>verified_by</li>
        </ul>
     </p>
     
    <h4 id="get_buildings_tanks">Get Buildings Tanks</h4>
	<p>
    	The call should look like this
        <br/>
        <code>http://deerail.com/HotlineApi?type=BuildingsTanks&amp;username=xxx&amp;password=xxxxxxxxxxxxxxxxxxxxxx&amp;timestamp=2018-08-08 08:08:08</code>
        <br/>
        Each Record has the following information : 
        <ul>
        	<li>building_id (GUID)</li>
            <li>district</li>
            <li>block</li>
            <li>building_number</li>
            <li>timestamp</li>
            <li>Tank. A JSON Object with the following fields : 
            	<ul>
                	<li>tank_id</li>
                    <li>district</li>
                    <li>block</li>
                    <li>tank_number</li>
                </ul>
            </li>
        </ul>
     </p>
     
     
    <h3>Post Methods</h3>
    <h4 id="add_record">Add Record</h4>
	<p>
    	The type is : <code>AddRecord</code>
        <br/>
    	The jsonObject should be an array of json Objects.
        <br/>
        Each object is a Hotline Record Log containing : 
        <ul>
        	<li>complaint_id (GUID)</li>
            <li>user_id</li>
            <li>timestamp_created</li>
            <li>caller
            	With Caller a JSON Object containing:
                <ul>
                	<li>fname</li>
                	<li>lname</li>
                	<li>phone</li>
                </ul>
            </li>
            <li>building_id (GUID)</li>
			<li>comment
            	With Comment a JSON Object containing:
                <ul>
                	<li>comment_id</li>
                	<li>timestamp</li>
                	<li>content</li>
                </ul>
            </li>            
        </ul>
    </p>
     
    <h4 id="add_app_id">Add App Id</h4>
	<p>
    	The type is : <code>AddAppId</code>
        <br/>
    	The jsonObject should be an array of json Objects.
        <br/>
        Each obbject is an App Id Log containing : 
        <ul>
        	<li>app_id (GUID)</li>
            <li>device_id</li>
        </ul>
    </p> 
    
    <h4 id="verify_record">Verify Record</h4>
	<p>
    	The type is : <code>VerifyRecord</code>
        <br/>
    	The jsonObject should be an array of json Objects.
        <br/>
        Each object is a Hotline Record Verification Log containing : 
        <ul>
        	<li>complaint_id (GUID)</li>
            <li>verification_status</li>
            <li>timestamp</li>
            <li>verified_by (GUID)</li>
			<li>comment
            	With Comment a JSON Object containing:
                <ul>
                	<li>comment_id</li>
                	<li>timestamp</li>
                	<li>content</li>
                </ul>
            </li>            
        </ul>
    </p>    
    
    <h4 id="add_user_activity">Add User Activity</h4>
	<p>
    	The type is : <code>UserUsage</code>
        <br/>
    	The jsonObject should be an array of json Objects.
        <br/>
        Each obbject is a User Usage Log containing : 
        <ul>
        	<li>Activity_Id (GUID)</li>
            <li>Timestamp (The time of the event)</li>
            <li>User_Id</li>
            <li>Activity_type_Id
            	<ul>Id's are : 
                	<li>1 : Log In</li>
                	<li>2 : Log Out</li> 
                	<li>3 : GPS turned on</li>
                	<li>4 : GPS turned off</li>
                	<li>5 : Automatic time turned on</li> 
                	<li>6 : Automatic time turned off</li>
                </ul>                                                            
            </li>
        </ul>
    </p>      	
	<br/>
    <br/>
    <span><i>N.B.</i>&nbsp;:&nbsp;In all Post methods, if any GUID value is NULL, it should be put in as an empty string</span>  
</body>
</html>