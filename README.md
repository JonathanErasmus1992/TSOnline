# Toystore

Group Members will send their changes and updates to files to team leader first
This is to avoid corrupting or overriding of the repository
After work has been integrated successfully with master, team leader will push the changes to github.

When connecting to TSBackend-

Start up WampServer or server you are using.

Open up your phpMyAdmin and create a database with no tables called toystore.

Or if the DB toystore already exists delete/drop all tables in it.

After that step open up application.properties on TSBackend:
	Change the DB URL to match your localhost for wamp/xamp.
	And make sure that the database name after the URL matches the name you gave the DB in phpMyAdmin.
	Change the Username and Password to match the Username and Password of your phpMyAdmin.

	
Once that is all done close all files and make sure that all dependencies are completed and that there is no errors.


Open up and run each of the Tests in the Test repository directory:
	This should automatically create all the tables needed for the TSBackend automatically.
	To verify this open the DB toystore on phpMyAdmin and the tables will be all be there.

	
After you have verified that the tables have been successfully created open up your terminal in your IDE and enter the command mvn spring-boot:run.
