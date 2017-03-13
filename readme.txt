[Folder Structure]

- css     				
- fonts
- images
- js
- registrar
	- credentials
	- reports
	- schoolmanagement
		- phpinsert (scripts for inserting data to the database)
		- phpscripts (scripts for querying data from the database)
	- studentmanagement
		- phpinsert (scripts for inserting data to the database)
- resources
	- libraries	(client side libraries)
	- templates (reusable templates)
- systemadmin
	- schoolmanagement
- temp

[Note]
pcnhs.sis/resources/config.php contains the configuration of the database connection and base_url

[Instruction]
1. Download and import sql database. Download sql database here: 
2. clone my repo or download zip then extract the zip file to your development server root folder
3. modify config.php, set the proper value for the database connection (default values has been set)
4. access web application by entering this url to your browser "localhost/pcnhs.sis" without quotes
