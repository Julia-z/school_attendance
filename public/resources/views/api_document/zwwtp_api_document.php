<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>API Documentation</title>
</head>

<body>

	<h1 align="center">ZWWTP API Documentation</h1>
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
    	All requests should be made to: http://www.deerail.com/ZWWTPApi
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
				<li><a href="#get_z_remaining_trucks">Get Remaining Trucks</a></li>
            	<li><a href="#get_destinations">Get Destinations</a></li>
                <li><a href="#get_trucks">Get Trucks</a></li>
                <li><a href="#get_tanks">Get Tanks</a></li>
			</ul>
            <span>
                <i>N.B.</i>&nbsp;:&nbsp;All Get Calls should contain one extra parameter (timestamp).
                <br/>
                This value will tell the api when last the app received any values, so no values will be returned if nothing changed.
            </span>
        </li>
        <li>Post Methods
        	<ul>
            	<li><a href="#add_plant_entrnace">Add Plant Entrance</a></li>
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
        <code>http://deerail.com/ZWWTPApi?type=Users&amp;username=xxx&amp;password=xxxxxxxxxxxxxxxxxxxxxx&amp;timestamp=2018-08-08 08:08:08</code>
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
            <li>zwwtp_app (Boolean, if 1 user can log into the app)</li>
         </ul>
     </p>
     
    <h4 id="get_z_remaining_trucks">Get Remaining Trucks</h4>
    <p>
    	The call should look like this<br/>
        <code>http://deerail.com/ZWWTPApi?type=GetPlantRemainingTrucks&amp;username=xxx&amp;password=xxxxxxxxxxxxxxxxxxxxxx&amp;timestamp=2018-08-08 08:08:08</code>
        <br/>
    	<span>This call return a list of all Trucks in and out of the plant before 5 A.M.</span>
        <br/>
    	Each Record has the following information : 
        <ul>
        	<li>Event_Id (GUID)</li>
            <li>Timestamp</li>
            <li>Time_user</li>
            <li>Driver_user_Id</li>
            <li>Driver_fname_arabic</li>
            <li>Driver_lname_arabic</li>
            <li>Controller_user_Id</li>
            <li>Controller_fname_arabic</li>
            <li>Controller_lname_arabic</li>
            <li>Cfw_user_Id</li>
            <li>Truck_Id</li>
            <li>Truck_number</li>
            <li>Truck_volume</li>
            <li>Tank_Id</li>
            <li>Payment_voucher_number</li>
            <li>Comment_Id</li>
            <li>Comment_content</li>
            <li>Data_edited</li>
            <li>Exit_record
            	With Exit_record a JSON Object containing the following parameters :
                <ul>
                	<li>Event_Id (GUID)</li>
                    <li>Timestamp</li>
                    <li>Time_user</li>
                    <li>Driver_user_Id</li>
                    <li>Driver_fname_arabic</li>
                    <li>Driver_lname_arabic</li>
                    <li>Controller_user_Id</li>
                    <li>Controller_fname_arabic</li>
                    <li>Controller_lname_arabic</li>
                    <li>Cfw_user_Id</li>
                    <li>Destination</li>
                    <li>Destination_ar</li>
                    <li>Destination_ar_short</li>
                    <li>Truck_Id</li>
                    <li>Truck_number</li>
                    <li>Truck_volume</li>
                    <li>Tank_Id</li>
                    <li>Payment_voucher_number</li>
                    <li>Comment_Id</li>
                    <li>Comment_content</li>
                    <li>Data_edited</li>
                    <li>Entrance_Id</li>
                </ul>
            </li>
        </ul>
     </p>
     
    <h4 id="get_destinations">Get Destinations</h4>
	<p>
    	The call should look like this<br/>
        <code>http://deerail.com/ZWWTPApi?type=Destinations&amp;username=xxx&amp;password=xxxxxxxxxxxxxxxxxxxxxx&amp;timestamp=2018-08-08 08:08:08</code>
        <br/>
    	<span>This call return a list of all Destinations</span>
    	<ul>
        	<li>NewUpdatedData</li>
            <li>DeletedData</li>
        </ul>
        Each entry Record has the following information : 
        <ul>
        	<li>Destination_Id (GUID)</li>
            <li>Destination_ar</li>
            <li>Destination_en</li>
            <li>Ar_short</li>
        </ul>
     </p>
    
    <h4 id="get_trucks">Get Trucks</h4>
	<p>
    	The call should look like this<br/>
        <code>http://deerail.com/ZWWTPApi?type=Trucks&amp;username=xxx&amp;password=xxxxxxxxxxxxxxxxxxxxxx&amp;timestamp=2018-08-08 08:08:08</code>
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
     
    <h4 id="get_tanks">Get Tanks</h4>
	<p>
    	The call should look like this<br/>
        <code>http://deerail.com/ZWWTPApi?type=Tanks&amp;username=xxx&amp;password=xxxxxxxxxxxxxxxxxxxxxx&amp;Comment=[xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx]</code>
        <br/>
        <span>This call return a list of all trucks divided into 2</span>
    	<ul>
        	<li>NewUpdatedData</li>
            <li>DeletedData</li>
        </ul>
        Each Tank has the following information : 
        <ul>
        	<li>Tank_Id(GUID)</li>
            <li>Tank_name</li>
            <li>Inside (boolean)</li>     
         </ul>
     </p>
     
     
    <h3>Post Methods</h3>
    <h4 id="add_plant_entrnace">Add Plant Entrance</h4>
	<p>
    	The type is : <code>PlantEntrance</code>
        <br/>
    	The jsonObject should be an array of json Objects.
        <br/>
        Each object is a Camp Entrance Log containing : 
        <ul>
        	<li>Event_Id (GUID)</li>
            <li>Timestamp</li>
            <li>Time_user</li>
            <li>Driver_user_Id (GUID)</li>
            <li>Controller_user_Id (GUID)</li>
            <li>Tank_Id (GUID)</li>   
            <li>Truck_Id (GUID)</li>            
            <li>Truck_volume</li>
            <li>Payment_voucher_number</li>
			<li>Data_edited</li>    
            <li>Comment
            	With Comment a JSON Object containing the following parameters : 
                <ul>
                	<li>Comment_Id (GUID)</li>
                    <li>Content</li>
                    <li>User_Id_by (GUID)</li>
                    <li>User_Id_about (GUID)</li>
                </ul>
            </li>
            <li>Exit_record
            	With Exit_record a JSON Object containing the following parameters : 
                <ul>
                	<li>Event_Id (GUID)</li>
                    <li>Entrance_Id (GUID)</li>
                    <li>Timestamp</li>
                    <li>Time_user</li>
                    <li>Driver_user_Id (GUID)</li>
                    <li>Controller_user_Id (GUID)</li>
                    <li>Tank_Id (GUID)</li>   
                    <li>Truck_Id (GUID)</li>            
                    <li>Truck_volume</li>
                    <li>Payment_voucher_number</li>
                    <li>Data_edited</li>    
                    <li>Destination</li>  
                    <li>Comment
                        With Comment a JSON Object containing the following parameters : 
                        <ul>
                            <li>Comment_Id (GUID)</li>
                            <li>Content</li>
                            <li>User_Id_by (GUID)</li>
                            <li>User_Id_about (GUID)</li>
                        </ul>
                    </li>  
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