Developed this app using PHP and Javascript, AJAX, Bootstrap and MySql as database. I developed without any framework because like this was prefered :).

Configurations:
1) Mysql version >=5.5:
    a) Database name:queue_app;
    b) Database user:root;
    c) Database password:ionel123;

All of this modification shoud be made in ../config/database.php

2)PHP version >=5

Description:

  The application was developed for council to queue people at the reception
desk where the receptionist is able to choose the service listed in panel and to take the customer details depending on the customer type:
Citizen: Title, First Name and Last Name;
Organization: Organization name;
Anonymous: there is no required any information;
All fields is required in depending wich type of customer is selected.

Description of choosen this solution:

  In this application used PHP, Mysql for store all information about Services, Customer type, Customer title and queued Customers.
Used Bootstrap for design of application and to be responsive for PC and mobile devices. Used Ajax for insertion of new customer in queue list without refreshing the page and at the same time display instantly the added customer. Used javascript and Jquery for get information from the form and sending it to Ajax to be inserted in database and to hide/show the inputs depending on selected customer type.

Developed by,
Ion Bulboaca
PHP Developer

