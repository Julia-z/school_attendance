<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>API Documentation</title>
</head>

<body>

	<h1 align="center">Old UFOW API Documentation</h1>
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
    	All requests should be made to: http://www.deerail.com/Api
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
				<li><a href="#get_tanks">Get Tanks</a></li>
            	<li><a href="#get_trucks">Get Trucks</a></li>
			</ul>
            <span>
                <i>N.B.</i>&nbsp;:&nbsp;All Get Calls should contain one extra parameter (timestamp).
                <br/>
                This value will tell the api when last the app received any values, so no values will be returned if nothing changed.
            </span>
        </li>
        <li>Post Methods
        	<ul>
            	<li><a href="#add_location_log">Add Location Log</a></li>
				<li><a href="#add_measurement">Add Measurement</a></li>
            	<li><a href="#add_empty_measurement">Add Empty Measurement</a></li>
            	<li><a href="#add_is_full">Add is Full</a></li>
                <li><a href="#add_comment">Add Comment</a></li>
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
        <code>http://deerail.com/Api?type=Users&amp;username=xxx&amp;password=xxxxxxxxxxxxxxxxxxxxxx&amp;timestamp=2018-08-08 08:08:08</code>
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
            <li>ufow_app (Boolean, if 1 user can log into the app)</li>
         </ul>
     </p>
     
    <h4 id="get_tanks">Get Tanks</h4>
	<p>
    	The call should look like this<br/>
        <code>http://deerail.com/Api?type=Tanks&amp;username=xxx&amp;password=xxxxxxxxxxxxxxxxxxxxxx&amp;timestamp=2018-08-08 08:08:08</code>
        <br/>
    	<span>This call return a list of all tanks divided into 2</span>
    	<ul>
        	<li>NewUpdatedData</li>
            <li>DeletedData</li>
        </ul>
        Each tank has the following information : 
        <ul>
        	<li>Tank_Id (GUID)</li>
            <li>Tank_longitude</li>
            <li>Tank_latitude</li>
            <li>District</li>
            <li>Block</li>
            <li>Tank_number</li>
            <li>Tank_type</li>
            <li>Timestamp</li>
         </ul>
     </p>
     
    <h4 id="get_trucks">Get Trucks</h4>
	<p>
    	The call should look like this<br/>
        <code>http://deerail.com/Api?type=Trucks&amp;username=xxx&amp;password=xxxxxxxxxxxxxxxxxxxxxx&amp;timestamp=2018-08-08 08:08:08</code>
        <br/>
    	<span>This call return a list of all trucks divided into 2</span>
    	<ul>
        	<li>NewUpdatedData</li>
            <li>DeletedData</li>
        </ul>
        Each tank has the following information : 
        <ul>
        	<li>Truck_Id (GUID)</li>
            <li>Truck_number</li>
            <li>Employer_Id</li>
            <li>Green_plate_number</li>
            <li>Yellow_plate_number</li>
            <li>Year_of_make</li>
            <li>Truck_total_capacity</li>
            <li>Hose_length</li>
         </ul>
     </p>
     
     
    <h3>Post Methods</h3>
    <h4 id="add_location_log">Add Location Log</h4>
	<p>
    	The type is : <code>LocationLog</code>
        <br/>
    	The jsonObject should be an array of json Objects.
        <br/>
        Each obbject is a location Log containing : 
        <ul>
        	<li>Log_Id (GUID)</li>
            <li>Timestamp (The time at which the truck was at the location)</li>
            <li>Truck_Id (GUID)</li>
            <li>Driver_user_Id (GUID)</li>
            <li>Cfw_user_Id (GUID)</li>
            <li>Latitude</li>
            <li>Longitude</li>
        </ul>
     </p>
     
    <h4 id="add_measurement">Add Measurement</h4>
	<p>
    	The type is : <code>MeasurementLog</code>
        <br/>
    	The jsonObject should be an array of json Objects.
        <br/>
        Each obbject is a measurement Log containing : 
        <ul>
        	<li>Event_Id (GUID)</li>
            <li>Timestamp (The time of the measuremnt)</li>
            <li>Cfw_user_Id (GUID)</li>
            <li>Task_Id (GUID)</li>
            <li>Tank_Id (GUID)</li>
            <li>Measurement1_black</li>
            <li>Measurement2_black</li>
			<li>Measurement1_color</li>
            <li>Measurement2_color</li>
			<li>Latitude</li>
            <li>Longitude</li>
 			<li>Comment_Id (GUID, make sure to upload the comment before uploading the event)</li>
        </ul>
    </p>
 
    <h4 id="add_empty_measurement">Add Empty Measurement</h4>
	<p>
    	The type is : <code>MeasurementEmptyingLog</code>
        <br/>
    	The jsonObject should be an array of json Objects.
        <br/>
        Each obbject is a measurement emptying Log containing : 
        <ul>
        	<li>Event_Id (GUID)</li>
            <li>Timestamp (The time of the measuremnt)</li>
            <li>Driver_user_Id (GUID)</li>
            <li>Cfw_user_Id (GUID)</li>
            <li>Task_Id (GUID)</li>
			<li>Truck_Id (GUID)</li>
            <li>Tank_Id (GUID)</li>
            <li>Measurement1_black</li>
            <li>Measurement2_black</li>
			<li>Measurement1_color</li>
            <li>Measurement2_color</li>
			<li>Latitude</li>
            <li>Longitude</li>
 			<li>Comment_Id (GUID, make sure to upload the comment before uploading the event)</li>
        </ul>
    </p>
     
    <h4 id="add_is_full">Add Is Full</h4>
	<p>
    	The type is : <code>IsFullLog</code>
        <br/>
    	The jsonObject should be an array of json Objects.
        <br/>
        Each obbject is an event containing : 
        <ul>
        	<li>Event_Id (GUID)</li>
            <li>Timestamp (The time of the event)</li>
            <li>Driver_user_Id (GUID)</li>
            <li>Cfw_user_Id (GUID)</li>
            <li>Controller_user_Id (GUID)</li>
			<li>Truck_Id (GUID)</li>
            <li>Tank_Id (GUID)</li>
        </ul>
    </p>  
     
    <h4 id="add_comment">Add Comment</h4>
	<p>
    	The type is : <code>CommentLog</code>
        <br/>
    	The jsonObject should be an array of json Objects.
        <br/>
        Each obbject is a Comment Log containing : 
        <ul>
        	<li>Comment_Id (GUID)</li>
            <li>Timestamp (The time of the event)</li>
            <li>Content</li>
            <li>User_Id_by (GUID)</li>
            <li>User_Id_about (GUID)</li>
			<li>Tank_Id_about (GUID)</li>
        </ul>
    </p>        	
	<br/>
    <br/>
    <span><i>N.B.</i>&nbsp;:&nbsp;In all Post methods, if any GUID value is NULL, it should be put in as an empty string</span>      	
</body>
</html>
