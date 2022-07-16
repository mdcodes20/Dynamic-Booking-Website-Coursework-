* I want to start by saying that, I know there are a lot of unnecessary files and they are not organised professionally and the reason is that I am a novice in 
programming, I am stil Learning. * 

#How to get the System working:

---- Download and Install Xampp
---- Run the xampp control panel and start Apache and MYSQL
---- Now Go to your browser and type the url "localhost/phpmyadmin"
---- Download the s2000701.sql 
---- Go back to your database tab on the browser you just created on and create a new Database with the name "s2000701" by clicking on "new"
---- Click on that new database you just created and go to "import" & than "Choose file" and than choose the "s2000701.sql"
---- Now we have our Database sorted. Next is the files.
---- find the folder "xampp" on the drive you downloaded xampp than Open it and go to " htdocs" and than there, Create three a new folder called "mywoodworker"
---- Open that folder you just created and create three more folders names "css", "services" & "pictures".
---- Download all the remaining files I have given and select the following " decking.php", "fence_repairs.php", "flat_pack_building.php", "hardwood.php", 
     "lock_replacement.php", "shelving.php", "sillicon_sealing.php" and put them in the "services" folder.
---- Select all the CSS files and put them in the "css" folder
---- Selct all the pictures and put them in the "pictures" folder
---- Everything is done now! Now you can just go to your browser and type in the url "localhost/mywoodworker/main_page.php". this will take you to the main page and
     from there you can navigate around the website. If you wish to login than you could use the Database and take a customer's login detail however the password is 
     hashed so you can't fint the password but I have some logins:
     - Customers:
       - username = md,    password = 123  ( I recommend using this one as it has a lot of data to play around with )
       - username = Huzaifa,  password = Huzaifa@2022
       - username = ahmed,  password = 123
     - Staff:
       - username = jack, password = 123 
---- After logging in as a Customer/Staff, You can freely do anything you like, Experiment with it. Hope you like :)




#What the project is about and how it was made

This project was done for my A level computer science. They asked me to do any kind of Advanced level project and I choose to go with an Appointment system for the 
business called "My woodworker". They used to take appointments from their customers via Phone calls/messeges/emails but it was not convinient enough so I decided to
work with them and create them an Appointment System which has a lot of advantages over the old system. There are two logins for both customer and staff and both have
different level of access to the website. 

A Customer can:
-------- View information about the business, its history, Staff members and details about services on the main page 
-------- They can Sign up 
-------- Can Login 
-------- Book, Remove, Update an Appointment. They can view its receipt and produce a downloadable pdf version of the reciept and they can also pay for the booking 
         through the website as well.
-------- There's an animated table showing all the appointment details to the customers and they can view the table in variety ways
-------- For the betterment of the business and to analyse the customers expectations from the business, I have also added a review system where a Customer can send 
         reviews to the business.
-------- Customers can also check details that they have put of themselves and they can change those details if they wish to.
-------- They can logout as well 

Staff in the website:
-------- Can Login
-------- Book, Confirm, Update, Cancel an appointment for a Customer, In this case, Customer doesn't have to do anything on their own. 
-------- Can cehck for all the confirmed and cancelled bookings.
-------- Can search for specific appoointments by its ID or the city it will be done at
-------- View all the Customers, Change their details
-------- View all the reviews, A Chart showing the reviews, all the Services, all the payments made

The main purpose of this system was that it could make an Appointment system for Customers which would make it easier for the staff easier to handle their business and
from the reactions of the staff, I can confidentially say that, I was successfull enough to impress the staff.


