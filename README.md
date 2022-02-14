# Tribunal
A small-business CRM with an integrated sales development process

## SETUP
<p>This code currently runs on a personal server. To use the CRM on your computer follow these steps (for Windows):</p>

  - Download and run XAMPP control panel. https://www.apachefriends.org/index.html
  - Open the XAMPP Control Panel and click the “Run” button for the Apache and SQL modules. You now have a live, local server running.
  - Download the source code folder “TribunalCRM” from this repository and place it in C:\xampp\htdocs\
    -  The root folder will now be C:\xampp\htdocs\TribunalCRM
  - Navigate to the folder C:\xampp\phpMyAdmin and open the file config.inc (using a program editor, eg. Visual Studio Code).
  - Set your server “Authentication type and info” as follows (see highlighted sections), then save and close the file.


```
**Authentication type and info**
$cfg['Servers'][$i]['auth_type'] = 'config';
$cfg['Servers'][$i]['user'] = 'root';
$cfg['Servers'][$i]['password'] = '123!@#';
$cfg['Servers'][$i]['extension'] = 'mysqli';
$cfg['Servers'][$i]['AllowNoPassword'] = true;
$cfg['Lang'] = '';
```
  
  - Import the database creation file (TribunalCRM > sql > createdatabase.sql) into phpMyAdmin.
    - Or, navigate to the phpMyAdmin homepage and click “Import”. http://localhost/phpmyadmin/index.php
  - Ensure the database is imported without any errors. phpMyAdmin will let you know after the import completes.
  - Open your preferred browser and visit http://localhost/TribunalCRM/index.php

You should now be able to create, read, update, delete, and link entries from each database table as needed.
Note there are pre-populated test entries. Feel free to delete these and create your own.


## TIPS

**Linking:** The database hierarchy is (1) Companies > (2) Projects > (3) Leads.
  - Leads can be linked up to both Projects and Companies.
  - Projects can be linked up to Companies.
    - **Note:** This link is enforced. Project record creation is done at the Companies level. In other words, you can’t create a Project record without first creating a company record.

**Settings:** To make the most use out of this CRM, first visit the Settings page...
  - Enter the name and contact info for sales, management, and admin personnel who will be using the database.
  - Create a pre-contact lead follow up process. Enter in the Process #, Step #, Time that elapses from step 1 for subsequent steps to become due, etc.
