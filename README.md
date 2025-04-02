## Project Requirement
Create a Scheduled Task:
    Set up a recurring task that runs every 5 minutes
    Each time it runs, make 5 separate API calls to https://randomuser.me/api/
    This will fetch data for 5 random users, we need to save these users in the database
Database Structure:
    Main User Table: Store user's name and email
    User Details Table: Store user's gender
    Location Table: Store user's city and country information
Create a Public API:
    Create an endpoint that allows filtering users by:
    Gender
    City
    Country
    Allow specifying the number of records to return
    The API should return complete user information including:
    Name
    Email
    Gender
    City
    Country
Optional Enhancement:
    Add the ability to specify which fields should be included in the API response

## Technology Stack
    Laravel (Version 11.0)
    Database: MySQL

## System Requirements:
    PHP version 8.2 or above
    Composer

### Detailed explaination

1. Database Migrations:

    Migrations for the users, user_details, and user_locations tables have been created to store the necessary data.

2. Model Relationships:

    Model files have been updated to define the relationships between User, UserDetails, and Location tables.


3. Scheduled Task: 

    A custom scheduler task was created using the command: php artisan make:command FetchRandomUsers

    The generated file can be found at app/Console/Commands/FetchRandomUsers.php, where the task logic has been implemented.


4. Scheduling the Task:

    As the Kernel.php is deprecated in Laravel 11, the scheduling code has been added in the routes/console.php file to run the scheduled task.


5. Running the Task Manually:

    To run the task manually, use the following command: php artisan fetch:random-users


6. API Endpoint: 
    To fetch user data with filters, you can use the following URL:

        http://localhost:8000/api/users?gender=male&city=Dalmsholte&limit=3

        gender: Filter users by gender (e.g., male, female).
        city: Filter users by city.
        limit: Specify the number of records to return.


    Specific Fields:

        If you only want specific fields to be returned in the response, use the following URL format:
        http://localhost:8000/api/users?fields=name,email

        fields: Specify the fields you want to retrieve (e.g., name,email).

Additional Notes:
Ensure that your .env file has the correct database configuration.

To test the scheduled task, you can either wait for it to run automatically or trigger it manually using the command above.


