
## Introduction

Jamilx is a PHP framework for building RAD and SaaS applications featuring the MVC format. It is designed to be easy to use, flexible, and extensible, with a focus on developer productivity.

Jamilx uses a prototype-container-service (PCS) pattern for its MVC architecture, where the prototype is the model, the container is the view, and the service is the controller. It also includes many reusable components called actions that any service can access. The framework supports MySQL as a default database, but a developer can use a different database.

## Features

Some of the features of Jamilx include:

-   MVC architecture
-   PCS pattern
-   Reusable components (actions)
-   Command-line tools for code generation and database operations
-   Built-in authentication and authorization
-   User management
-   Multilingual support
-   Error handling and debugging
-   Modular architecture

## Requirements

To use Jamilx, you need to have the following requirements installed on your system:

-   PHP 7.2 or higher
-   Apache or Nginx web server
-   MySQL or MariaDB database

## Download and Installation

You can download Jamilx from Github or install it using Composer. Once you have downloaded the Jamilx folder, place it in your server's public directory, such as `htdocs` or `public_html`. To install Jamilx, open your web browser and navigate to `http://localhost/jamilx/installer`. Follow the on-screen instructions to complete the installation.

## Creating an Application

To create an application or platform on Jamilx, you have three options:

1.  Use the command-line tool: Open CMD and navigate to your Jamilx folder and run the following command: `jamilx CreateApp "App Nickname" "App Name" "App Description"`. The tool will create a boilerplate for you in the `Apps` directory containing your app data.
2.  Self-creation: Go to the `Apps` directory, create a new directory with your app nickname, inside the directory create a PHP file with the app nickname and create a PHP class that extends `JXService` and implements `JXServiceI`, create `conf.json` and fill the necessary fields for the app. Use the demo app for a sample.
3.  GUI: Go to your admin interface, navigate to the "app creation button" and click it. Use the on-screen information to create your app.

## Directory Structure

The Jamilx directory structure is as follows:

-   `Apps`: This directory contains all the applications you create using Jamilx.
-   `Core`: This directory contains the core files of Jamilx.
-   `Vendors`: This directory contains the third-party libraries used by Jamilx.
-   `assets`: This directory contains the public files of your web application, such as CSS, JavaScript, and images.
-   `Containers`: This directory contains the templates used by your web application.

## Configuration

Jamilx has no manual configuration. Once you run the installer, it will set everything for you.

## Usage

To use Jamilx, you can create controllers, models, and views. Controllers are responsible for handling user requests, models are responsible for data storage and retrieval, and views are responsible for displaying the data to the user. You can also create reusable components called actions that any service can access.

## Conclusion

Jamilx is a powerful PHP framework that simplifies web application development. Its MVC architecture, PCS pattern, and reusable components make it easy to build robust and scalable applications. With its built-in authentication and authorization, user management, multilingual support, and modular architecture, Jamilx is an excellent choice for building SaaS