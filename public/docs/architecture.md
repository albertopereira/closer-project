Architecture
=======
Author: Alberto Pereira

Date: 25/02/2017

Version: 0.1.0

Summary
--------

This documents details the technological architecture of the application. 

What is CLOSER
---------

The CLOSER project seeks to enhance the inclusiveness of budgetary policies, increasing the participation of citizens, and to test the incorporation, in local news agencies practices, of the monitoring of public policies, by designing, evaluating and making publicly available a platform for translating municipal budgets into distinct visual news objects.
Hence, it provides a framework for building budget "objects", divided in expenses, revenues, and funds and reserves, and visualizations of that data, that can be incorporated, through snippets, in news agencies websites.

Overview
-----------------

### Summary

The architecture of CLOSER is composed of:

 - A backend module to manage the budgets
 - An API module for serving the visualization objects
 - A client module that will consume the API

### Backend module

The backend module is be the main entry point for the management of the budgets. Through it, a user can create, edit or delete budgets; generate *views* for visualization (snapshots of specific details of a budget); create the snippets for inclusion in a external website.

### API module

The API module is comprised of several endpoints that will serve the managed data of a specific budget/view.

### Client module

The client module generates either a complete visualization or a view of a budget of a specific municipality through the years, including all its categories (revenues, expenses, funds and reserves, etc). As it consumes the data from the API, it can be housed in any other server.


Technologies
------------

CLOSER is an application built over [Laravel](https://laravel.com), a modern PHP framework, for the backend, and [VueJS](https://vuejs.org/), a javascript framework, for the client module. Being decoupled and serving an API service, other technologies can be used to create new clients, or new versions of the official client, enhancing the versatility of the application, and providing a needed flexibility for a long lifecycle.
 

Request Lifecycle
---------

### Summary

The laravel application lifecycle for CLOSER can be represented by the following diagram:

![enter image description here](http://albertopereira.com/images/laravel_lifecycle.png)

### Service Providers

#### Summary
A Service Provider can be considered a parallel, and closed, piece of software, that is included (registered or *injected*), in a Laravel application, at boot level. Any service it provides can be accessed throughout the application. This means that it is not included in the core of the application, being considered an external service. 
Any service provider created in the scope of this project will have its own package repository. Nevertheless, any service provider used is listed in this section.

#### Providers

| Name | Description | URL |
|:--------|:--------------|:------|
| **Baum** | Baum is an implementation of the Nested Set pattern for Laravel 5's Eloquent ORM. | http://etrepat.com/baum/ |

Structure
---------

The following diagram represents the overall structure of the application.

![enter image description here](http://albertopereira.com/images/overall_diagram.png)

A response from the application can be accessed in one of three ways:

1. through snippets, that access the API for the data of a specific view, and can be included in a third party website;
2. through the client, that accesses the API for the data and creates visual objects for that data in its own page;
3. through the administration views, that allow operations over the data.


Data Models
--------------

### Diagram

The data models can be represented by:

![enter image description here](http://albertopereira.com/images/er.png)

### Model relationships

The relationships have the following rules:

1- A User can create many budgets;
2- A Budget is comprised of many years;
3- A Year has data for several types of budget;

> e.g.: revenues, expenses, etc

4- The data for a specific type of budget has a specific level in a data hierarchy, represented by which data parent it has.

> e.g.: the budget data for a School can be contained (be the child) in the budget data for all schools of a broader category Education (the parent).

### Model fields

The `Budgets` table has the following definitions for its fields:

| Table | Field | Definition |
|:------|:------|:-----------|
| Budgets | organization_name  | The name of the organization for which the budget applies. |
| Budgets | organization_url | The url of the organization for which the budget applies. |
| Budgets | organization_email | The email of the organization for which the budget applies. |
| Budgets | agency_name | The name of the agency/organization presenting the budget. |
| Budgets | agency_url | The url of the agency/organization presenting the budget. |
| Budgets | agency_email | The email of the agency/organization presenting the budget. |
| Budgets | country | The country of the organization for which the budget applies. |
| Budgets | state | The state of the organization for which the budget applies. |

The `BudgetTypes` table has the following definitions for its fields:

| Table | Field | Definition |
|:------|:------|:-----------|
| BudgetTypes | name  | The name for the specific data (e.g.: expenses, revenues, etc) |

The `Years` table has the following definitions for its fields:

| Table | Field | Definition |
|:------|:------|:-----------|
| Years | long_description  | A description of the budget for the specific year. It can also be a rundown or a call to attention of a specific aspect. |
| Years | short_description  | The summary of the budget for a specific year. |

The `Data` table has the following definitions for its fields:

| Table | Field | Definition |
|:------|:------|:-----------|
| Data | description  | A description of the data of a budget. It can also be a rundown or a call to attention of a specific aspect. |
| Data | source  | The source of the data. |
| Data | source_url  | The url of the source of the data. |
| Data | value  | The decimal value of the data. |
| Data | coordinates | the latitude;longitude of the data. |

The `Views` table has the following definitions for its fields:

| Table | Field | Definition |
|:------|:------|:-----------|
| Views | name  | The name of the view. |
| Views | description  | The description of the view. |


### Functional description

#### Summary
The following diagram describes the several use cases for the application:

![enter image description here](http://albertopereira.com/images/use_cases.png)

#### Generation of views

A view object, served through the API as a JSON object, has also a representation in the database. When generating views for publish, a JSON file corresponding to that view is created and stored locally. The API serves that file, and not programatically create and send a JSON response for each request. This allows for easier scalability in the future, if need be, by, for instance, serving those JSON files through a CDN.

Hence, while creating a view, a user with editor permissions has two different actions:

1. the creation of the view, that allows for an unpublished version of a view
2. the publication of the view, that creates the JSON representation file

Only after the publication of the view it can be accessed through the API.


Internationalisation
--------------------

Every string presented to the user has have a representation in a language file. These files are located within the resources/lang directory. Within this directory there is a subdirectory for each language supported by the application.
The languages supported are:

 - English
 - Portuguese

(Refer to [Laravel documentation](https://laravel.com/docs/5.4/localization) for more information)


Revision Table
--------------

| Author   | Revision      | Date  | Version Number |
|:----------|:-------------:|------:|----------------:|
| Alberto Pereira | First draft | 25/02/2017 | 0.1.0 |
