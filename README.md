# Landmark Fullstack Assessment
Landmark Fullstack Assessment

# Note: The env file was intentionally added to this repository to facilitate ease of testing


# Setting Up and Running the Laravel Website

This document provides step-by-step instructions for setting up and running the Laravel website on your system. Please follow the instructions carefully to ensure smooth installation.

## Prerequisites

Before proceeding, please ensure that you have the following software and access privileges installed on your system:

- **Modern Web Browser**: Ensure you have a modern web browser installed, such as Google Chrome, Mozilla Firefox, Microsoft Edge, or Safari.

- **Command Shell with Admin Privileges**: You need access to a command shell (Terminal on macOS/Linux or Command Prompt on Windows) with administrative privileges to execute commands and install dependencies.

- **PHP (>= 7.4)**: Install PHP version 7.4 or later. You can download it from the official PHP website: [php.net](https://www.php.net/downloads.php).

- **Composer**: Install Composer, a dependency manager for PHP. You can download it from the official Composer website: [getcomposer.org](https://getcomposer.org/download/).

- **MySQL or Compatible Database Server**: Install MySQL or another compatible database server for storing application data. You can download MySQL from the official MySQL website: [mysql.com](https://dev.mysql.com/downloads/mysql/).

- **Git**: Install Git for version control. You can download it from the official Git website: [git-scm.com](https://git-scm.com/downloads).

Ensure you have administrative privileges to install software and execute commands on your system.

## Installation Steps

### Clone the Repository

Open your terminal or command prompt and run the following command to clone the GitHub repository:
github.com/jibolashittubolu/landmarkFullstackAssessment.git

### Install Dependencies

Navigate to the project directory using the terminal or command prompt:
cd <project-directory> && composer install

### Start SQL server or Download Xammp(optional) and Run SQL server

### Run Migrations and Seeders
php artisan migrate 


### Serve the Application
In the terminal execute the following command:
php artisan serve


### Accessing the Website

Open your web browser and navigate to `http://localhost:8000` to access the Laravel website.


### Admin Interface
To login as admin, first access the website via `http://localhost:8000`. The login button is at the top navbar, then create a normal user account, then log in to the sql server interface via xammp or sql server workbench, then access the posv2 database, then the user table of the posv2 database. Change the userType to value '1'. The default is 0. 

### Buyer Interface
To login as a buyer, first access the website via `http://localhost:8000`. The login button is at the top navbar, then create a normal user account, then log in to the application to browse and make your purchase. 

## Testing

Once the website is running, you can test its functionality according to the requirements provided.

## Additional Notes
If you run into any issues, monitor the error messages and attempt resolving them or contact me at jibolashittubolu@gmail.com if the issue persists.


