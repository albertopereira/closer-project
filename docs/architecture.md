Architecture
=======
Author: Alberto Pereira

Date: 16/11/2017

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

![enter image description here](http://closer-project.com/docs/images/laravel_lifecycle.png)

### Service Providers

#### Summary
A Service Provider can be considered a parallel, and closed, piece of software, that is included (registered or *injected*), in a Laravel application, at boot level. Any service it provides can be accessed throughout the application. This means that it is not included in the core of the application, being considered an external service. 
Any service provider created in the scope of this project will have its own package repository. Nevertheless, any service provider used is listed in this section.

#### Providers

| Name | Description | URL |
|:--------|:--------------|:------|
| **D3js** | D3 is a JavaScript library for visualizing data with HTML, SVG, and CSS. | https://d3js.org |
| **Handsontable** | Handsontable is a JavaScript Spreadsheet Component available for React, Angular and Vue. | https://handsontable.com |

Structure
---------

The following diagram represents the overall structure of the application.

![enter image description here](http://closer-project.com/docs/images/overall_diagram.png)

A response from the application can be accessed in one of three ways:

1. through snippets, that access the API for the data of a specific view, and can be included in a third party website;
2. through the client, that accesses the API for the data and creates visual objects for that data in its own page;
3. through the administration views, that allow operations over the data.


Data Models
--------------

### Diagram

The data models can be represented by:

![enter image description here](http://closer-project.com/docs/images/er.png)

### Model relationships

The relationships have the following rules:

1- A User can create many entities;
2- An Entity has several types of Budget Types;
3- A Budget Type has many views;


### Model fields

The `Entities` table has the following definitions for its fields:

| Table | Field | Definition |
|:------|:------|:-----------|
| Entities | organization_name  | The name of the organization for which the budget applies. |
| Entities | organization_url | The url of the organization for which the budget applies. |
| Entities | organization_email | The email of the organization for which the budget applies. |
| Entities | agency_name | The name of the agency/organization presenting the budget. |
| Entities | agency_url | The url of the agency/organization presenting the budget. |
| Entities | agency_email | The email of the agency/organization presenting the budget. |
| Entities | country | The country of the organization for which the budget applies. |
| Entities | state | The state of the organization for which the budget applies. |
| Entities | created_at | Timestamp for creation. |
| Entities | updated_at | Timestamp for update. |

The `Budget_Types` table has the following definitions for its fields:

| Table | Field | Definition |
|:------|:------|:-----------|
| Budget_Types | budget_name  | The name for the specific data (e.g.: expenses, revenues, etc) |
| Budget_Types | data  | The JSON representation of that data |
| Budget_Types | created_at | Timestamp for creation. |
| Budget_Types | updated_at | Timestamp for update. |


The `Views` table has the following definitions for its fields:

| Table | Field | Definition |
|:------|:------|:-----------|
| Views | data  | A JSON object with its configuration. |
| Views | description  | The description of the view. |
| Views | created_at | Timestamp for creation. |
| Views | updated_at | Timestamp for update. |


### Functional description

#### Summary
The following diagram describes the several use cases for the application:

![enter image description here](http://closer-project.com/docs/images/use_cases.png)

#### Creation of Budget Types

An Entity can have several Budget Types, regarding distinct sources of data (e.g. Expenses, Projected Budgets, Revenues, etc). Each Budget Type has a field where it saves the data in a JSON format, and is edited through a spreadsheet like table.
The structure of that table has the following definitions:

| Field | Definition |
|:------|:-----------|
| Level 1  | The description of the first level of the data. |
| Level #  | A repeatable column representing the sub-levels of the data |
| Description | The description of the most lower level of data |
| Source | The source of the data. |
| Source URL | The source url of the data. |
| Coords | If applicable, the coords, separated by commas (lat,lng) of the data. |
| [Year] | A repeatable columns of the value for the corresponding year |

A usual header of the table presented to the editor is   

| Level 1 |	Level 2 | Description | Source | Source URL | Coords | 2017 | 2018 | 2019 |
|:--------|:--------|:------------|:-------|:-----------|:-------|:-----|:-----|:-----|


#### Generation of views

A view object, served through the API as a JSON object, has also a representation in the database, in the data field of the budget_types table. This representation is created through, in the backend, a spreadsheet like editor.

While creating a view for a particular Budget Type, a user with editor permissions can choose between several combinations of types of graphical representations. It can also create several distinct views, with distinct representations. So, for example, it can create a view just for a Treemap, and another view with a Treemap and a Heatmap, both reflecting data from the same Budget Type.


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
| Alberto Pereira | Changed views and budget types description | 16/11/2017 | 0.1.0 |
