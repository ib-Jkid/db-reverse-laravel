# DB REVERSE SCRIPT  8-)



+ A light weight php CLI tool for reverse engineering existing databases to laravel migrations, models, seeders

### Usage

+ Clone this repo
+ Run Composer install
+ Run the script via terminal 
+ Type **help** on the terminal to display the full command list and thier functions

    #### Start CLI

    > php index.php

    #### Create Migration For Users table: 

    > create migrations users

    #### Create All Migrations

    > create migrations

    #### create Seeders for Users Table

    > create seeders users

    #### Expected output

    > Creating : 2020_09_21_61920_create_migrations_table.php

    > Created :2020_09_21_61920_create_migrations_table.php

    > Creating : 2020_09_21_61921_create_test_table.php

    > Created :2020_09_21_61921_create_test_table.php

    #### Display Help

    > help

    #### Output

    |              Commands               |                    Description                        |
    |-------------------------------------|-------------------------------------------------------|
    | connect                             | Connects to a new database                            | 
    | create seeders <table-name>         | Create database seeder for <table-name> table         |
    | create models <table-name>          | Create database models for <table-name> table         |
    | create migrations <table-name>      | Create database migrations for <table-name> table     |
    | create migrations                   | Create migrations file for all tables                 |
    | create seeders                      | Create seeders for all tables                         |
    | create models                       | Create models for all tables                          |
    | generate crud controllers           | Create controllers with read,updated,delete functions |
    | status                              | Show connection status                                |
    | help                                | Show this message                                     |

    #### Connection Status Check

    >status 

    #### Output

    |     Variable       |         Status              
    | ------------------ | ---------------------- |
    |    Connected       | connected  
    |    Database Name   | lumen       
    |    Username        | username     
    |    Port            | 80     
    |    Driver          | mysql       
    |    Host            | localhost                



### Requirement

+ PHP > 7.3
