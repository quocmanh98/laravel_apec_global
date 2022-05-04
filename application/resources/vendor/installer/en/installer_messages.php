<?php

use Illuminate\Routing\Route;

return [

    /*
     *
     * Shared translations.
     *
     */
    'title' => 'Laravel Backend Installer',
    'next' => 'Next Step',
    'back' => 'Previous',
    'finish' => 'Install',
    'forms' => [
        'errorTitle' => 'The Following errors occurred:',
    ],

    /*
     *
     * Home page translations.
     *
     */
    'welcome' => [
        'title'   => 'Laravel Backend Installer',
        'message' => 'Easy Installation and Setup Wizard.',
        'body' => [

            'message1' => 'Welcome to Laravel. Before getting started, we need some information on the database. You will need to know the following items before proceeding.',
            'requirements' => [
                'db_driver' => 'Database driver',
                'db_host' => 'Database host',
                'db_name' => 'Database name',
                'db_username' => 'Database username',
                'db_password' => 'Database password',
            ],
            'message2' => 'In all likelihood, these items were supplied to you by your Web Host. If you don’t have this information, then you will need to contact them before you can continue. If you’re all ready…',
        ],
        'next'    => "Let's Go",
    ],

    /*
     *
     * Requirements page translations.
     *
     */
    'requirements' => [
        'templateTitle' => 'Server Requirements',
        'title' => 'Server Requirements',
        'next'    => 'Check Permissions',
        'current' => 'Check Again'
    ],

    /*
     *
     * Permissions page translations.
     *
     */
    'permissions' => [
        'templateTitle' => 'Permissions',
        'title' => 'Permissions',
        'next' => 'Configure Environment',
        'current' => 'Check Again'
    ],
    /*
     *
     * database page translations.
     *
     */
    'database' => [
        'templateTitle' => 'Below you should enter your database connection details. If you’re not sure about these, contact your host.',
        'title' => 'Database Connection',
        'form' => [
            'db_connection_failed' => 'Could not connect to the database.',
            'db_connection_label' => 'Database Connection',
            'db_connection_info' => 'Please specify the database driver type for this connection.',
            'db_connection_label_mysql' => 'mysql',
            'db_connection_label_pgsql' => 'pgsql',
            'db_host_label' => 'Database Host',
            'db_host_info' => 'You should be able to get this info from your web host, if localhost doesn’t work.',
            'db_host_placeholder' => 'Database Host',
            'db_port_label' => 'Database Port',
            'db_port_info' => 'Your database portname.',
            'db_port_placeholder' => 'Database Port',
            'db_name_label' => 'Database Name',
            'db_name_info' => 'The name of the database you want to use with Laravel app.',
            'db_name_placeholder' => 'Database Name',
            'db_username_label' => 'Database User Name',
            'db_username_info' => 'Your database username.',
            'db_username_placeholder' => 'Database User Name',
            'db_password_label' => 'Database Password',
            'db_password_info' => 'Your database password.',
            'db_password_placeholder' => 'Database Password',
        ],
        'error' => [
            'connection' => "<strong>Database Connection Fails!</strong> Check you database information.",
            'database_not_empty' => "Database [:name] not empty! Please remove all of table manually"
        ],
        'next' => "Save",
        'success' => 'Your .env file settings have been saved.',
        'errors' => 'Unable to save the .env file, Please create it manually.',
    ],

    /*
     *
     * Migration and seed.
     *
     */
    'migration' => [
        'title'   => 'Laravel Migration & Seeding ',
        'message' => 'Laravel -> Migration & Seeding ',
        'body' => 'All right! You’ve made it through this part of the installation. Laravel app can now communicate with your database. If you are ready, time now to…',
        'next'    => "Run the installation",
    ],

    /*
     *
     * admin page translations.
     *
     */
    'admin' => [
        'templateTitle' => 'Information needed',
        'body' => 'Please provide the following information. Don’t worry, you can always change these settings later.',
        'title' => 'Admin Setup',
        'next' => 'Save',

        'form' => [
            'app_name_label' => 'App Name',
            'admin_name_label' => 'Full Name',
            'admin_email_label' => 'Email',
            'admin_password_label' => 'Password',

            'admin_name_info' => 'Fullname can have only alphanumeric characters, spaces, underscores, hyphens, periods.',
            'admin_email_info' => 'Double-check your email address before continuing.',
            'admin_password_info' => ' <strong>Important:</strong> You will need this password to log in. Please store it in a secure location.',
        ],

        "error" => [
            'create_user_account' => "You can not avoid it."
        ]

    ],

    'install' => 'Install',

    /*
     *
     * Installed Log translations.
     *
     */
    'installed' => [
        'success_log_message' => 'Laravel Backend Installer successfully INSTALLED on ',
    ],

    /*
     *
     * Final page translations.
     *
     */
    'final' => [
        'title' => 'Installation Finished',
        'status' => 'Success!',
        'templateTitle' => 'Application has been successfully installed.',
        'finished' => 'Application has been successfully installed.',
        'migration' => 'Migration &amp; Seed Console Output:',
        'console' => 'Application Console Output:',
        'log' => 'Installation Log Entry:',
        'chosen_password' => 'Your chosen password',
        'next' => 'Login',


    ],

];
