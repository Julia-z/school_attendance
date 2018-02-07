<!doctype html>
<html>
<head>
<style>
.red{
	color:red;
}
</style>
<meta charset="utf-8">
<title>API Documentation</title>
</head>

<body>

	<h1 align="center">UFOW API Documentation</h1>
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
    	All requests should be made to: http://www.deerail.com/UFOW
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
                <li><a href="#get_trucks">Get Trucks</a></li>
            	<li><a href="#get_destinations">Get Destinations</a></li>
                <li><a href="#get_daily_logs">Get Daily Logs</a></li>
			</ul>
            <span>
                <i>N.B.</i>&nbsp;:&nbsp;All Get Calls should contain one extra parameter (timestamp).
                <br/>
                This value will tell the api when last the app received any values, so no values will be returned if nothing changed.
            </span>
        </li>
        <li>Post Methods
        	<ul>
            	<li><a href="#add_empty_tank">Add Empty Tank</a></li>
                <li><a href="#add_pip">Add PIP Entrance</a></li>
                <li><a href="#add_plant_entrance">Add Plant Entrance</a></li>
                <li><a href="#add_plant_exit">Add Plant Exit</a></li>
                <li><a href="#add_camp_entrance">Add Camp Entrnace</a></li>
                <li><a href="#add_camp_exit">Add Camp Exit</a></li>
            	<li><a href="#add_is_full">Add is Full Log</a></li>
                <li><a href="#add_location_log">Add Location Log</a></li>
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
        <code>http://deerail.com/UFOW?type=Users&amp;username=xxx&amp;password=xxxxxxxxxxxxxxxxxxxxxx&amp;timestamp=2018-08-08 08:08:08</code>
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
            <li>Role_Id (15 reffers to a driver)</li>
            <li>ufow_app (Boolean, if 1 user can log into the app)</li>
         </ul>
     </p>
    
    <h4 id="get_trucks">Get Trucks</h4>
	<p>
    	The call should look like this<br/>
        <code>http://deerail.com/UFOW?type=Trucks&amp;username=xxx&amp;password=xxxxxxxxxxxxxxxxxxxxxx&amp;timestamp=2018-08-08 08:08:08</code>
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
            <li>frequency</li>
            <li>timestamp</li>
         </ul>
    </p> 
    
    <h4 id="get_destinations">Get Destinations</h4>
	<p>
    	The call should look like this<br/>
        <code>http://deerail.com/UFOW?type=Destinations&amp;username=xxx&amp;password=xxxxxxxxxxxxxxxxxxxxxx&amp;timestamp=2018-08-08 08:08:08</code>
        <br/>
    	<span>This call return a list of all Destinations</span>
    	<ul>
        	<li>NewUpdatedData</li>
            <li>DeletedData</li>
        </ul>
        Each entry Record has the following information : 
        <ul>
        	<li>destination_id (GUID)</li>
            <li>destination_ar</li>
            <li>destination_en</li>
            <li>timestamp</li>
        </ul>
     </p>
     
    <h4 id="get_daily_logs">Get Daily Logs</h4>
	<p>
    	The call should look like this<br/>
        <code>http://deerail.com/UFOW?type=GetDailyLogs&amp;username=xxx&amp;password=xxxxxxxxxxxxxxxxxxxxxx&amp;timestamp=2018-08-08 08:08:08&amp;Truck=xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx</code>
        <br/>
        <i>N.B.</i> : This call has Truck, with Truck the Id of the truck for which we are looking for the logs.
        Each Log has the following information : 
        <ul>
        	<li>event_id (GUID)</li>
            <li>event_type_id
            	This values can be : 
                <ul>
                	<li>1 : Camp Entrnace</li>
                    <li>5 : PIP Plant Inspection Point</li>
                    <li>6 : Plant Entrance</li>
                    <li>7 : Plant Exit</li>                      
           			<li>9 : Truck is Full</li>
                </ul> 
            </li>
            <li>timestamp</li>     
            <li>driver_user_id</li>     
            <li>truck_id</li>     
            <li>cfw_user_id</li>     
            <li>destination (boolean. 1 for Akaider and 0 for Zaatari)</li>     
         </ul>
     </p>
     
     
    <h3>Post Methods</h3>
    <h4 id="add_empty_tank">Add Empty Tank</h4>
	<p>
    	The type is : <code>EmptyingTank</code>
        <br/>
    	The jsonObject should be an array of json Objects.
        <br/>
        Each object is a Tank Emptying Log containing : 
        <ul>
        	<li>event_id (GUID)</li>
            <li>timestamp</li>
            <li>cfw_user_id (GUID)</li>
            <li>driver_user_id (GUID)</li>
            <li>truck_id (GUID)</li>   
            <li>tank_id (GUID)</li>            
            <li>task_id (GUID)</li>
            <li>measurement1_black</li>
            <li>measurement1_color</li>
            <li>measurement2_black</li>
            <li>measurement2_color</li>
            <li>data_edited</li>
			<li>status</li>    
            <li>comment
            	With Comment a JSON Object containing the following parameters : 
                <ul>
                	<li>comment_id (GUID)</li>
                    <li>content</li>
                    <li>timestamp</li>
                </ul>
            </li>
            <li class="red">longitude</li>    
            <li class="red">longitude</li>    
        </ul>
        <span class="red"><i>N.B.</i> : The red params are only needed if status is not 0</span>
    </p>
    
    <h4 id="add_pip">Add PIP Entrnace</h4>
	<p>
    	The type is : <code>PIPEntrance</code>
        <br/>
    	The jsonObject should be an array of json Objects.
        <br/>
        Each object is a PIP Entrnace Log containing : 
        <ul>
        	<li>event_id (GUID)</li>
            <li>timestamp</li>
            <li>driver_user_id (GUID)</li>
            <li>truck_id (GUID)</li>   
            <li>cfw_user_id (GUID)</li>            
            <li>destination (0 for the Zaaari; 1 for Akaider)</li>
            <li>voucher_number</li>
        </ul>
    </p>
    
    <h4 id="add_plant_entrance">Add Plant Entrance</h4>
	<p>
    	The type is : <code>PlantEntrance</code>
        <br/>
    	The jsonObject should be an array of json Objects.
        <br/>
        Each object is a Plant Entrnace Log containing : 
        <ul>
        	<li>event_id (GUID)</li>
            <li>timestamp</li>
            <li>driver_user_id (GUID)</li>
            <li>truck_id (GUID)</li>   
			<li>cfw_user_id (GUID)</li>
        </ul>
    </p>
    
    <h4 id="add_plant_exit">Add Plant Exit</h4>
	<p>
    	The type is : <code>PlantExit</code>
        <br/>
    	The jsonObject should be an array of json Objects.
        <br/>
        Each object is a Plant Exit Log containing : 
        <ul>
        	<li>event_id (GUID)</li>
            <li>timestamp</li>
            <li>driver_user_id (GUID)</li>
            <li>truck_id (GUID)</li>   
			<li>cfw_user_id (GUID)</li>
        </ul>
    </p>
    
    <h4 id="add_camp_entrance">Add Camp Entrance</h4>
	<p>
    	The type is : <code>CampEntrnce</code>
        <br/>
    	The jsonObject should be an array of json Objects.
        <br/>
        Each object is a Camp Entrance Log containing : 
        <ul>
        	<li>event_id (GUID)</li>
            <li>timestamp</li>
            <li>driver_user_id (GUID)</li>
            <li>truck_id (GUID)</li>   
			<li>cfw_user_id (GUID)</li>
        </ul>
    </p>
    
    <h4 id="add_camp_exit">Add Camp Exit</h4>
	<p>
    	The type is : <code>CampExit</code>
        <br/>
    	The jsonObject should be an array of json Objects.
        <br/>
        Each object is a Camp Exit Log containing : 
        <ul>
        	<li>event_id (GUID)</li>
            <li>timestamp</li>
            <li>driver_user_id (GUID)</li>
            <li>truck_id (GUID)</li>   
			<li>cfw_user_id (GUID)</li>
            <li>destination_id (GUID)</li>
        </ul>
    </p>
    
    <h4 id="add_is_full">Add is Full Log</h4>
	<p>
    	The type is : <code>IsFullLog</code>
        <br/>
    	The jsonObject should be an array of json Objects.
        <br/>
        Each object is a Truck Full Log containing : 
        <ul>
        	<li>event_id (GUID)</li>
            <li>timestamp</li>
            <li>driver_user_id (GUID)</li>
            <li>truck_id (GUID)</li>   
			<li>cfw_user_id (GUID)</li>
        </ul>
    </p>
    
    <h4 id="add_location_log">Add Location Log</h4>
	<p>
    	The type is : <code>LocationLog</code>
        <br/>
    	The jsonObject should be an array of json Objects.
        <br/>
        Each object is a Location Log containing : 
        <ul>
        	<li>log_id (GUID)</li>
            <li>timestamp</li>
            <li>driver_user_id (GUID)</li>
            <li>truck_id (GUID)</li>   
			<li>cfw_user_id (GUID)</li>
            <li>latitude</li>
            <li>longitude</li>
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