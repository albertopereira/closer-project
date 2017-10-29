Quality assurance
=======
Author: Alberto Pereira

Date: 25/02/2017

Version: 0.1.0

Summary
--------
This document lists and details the overall guidelines regarding code and documentation quality assurance, to maintain cohesion throughout all the elements of the project.

Documents
---------
The documentation is comprised of the following individual documents:

1. Quality assurance (this document)
2. Architecture
3. Client
3. User manual
4. API


Versioning
--------
### Summary

The versioning will be bundled for the documentation and for the software. Any changes in either of them will, necessarily, change the version number. 

Given a version number MAJOR.MINOR.PATCH, increment the:

 1. MAJOR version when you make incompatible changes,
 2. MINOR version when you add functionality in a backwards-compatible manner, and
 3. PATCH version when you make backwards-compatible bug fixes.

##### Documentation

Regardless of the medium where it is placed, every document will have, explicitly identified on the first page, the author of the document, the date of the latest release, and the version number.

The format of the date is DD/MM/YYYY.

At the bottom of the document there will be a revision table, following the format:

| Author   | Revision      | Date  | Version Number |
|:----------|:-------------|:------|---------------:|
| Name of the author of the revision | Description of the revision | Date of the revision | The new version after the revision |


Coding conventions
------------------

### General

**Models** are singular nouns (i.e. User).
**Controllers** are singular nouns with `Controller` suffix (i.e. `HomeController`).
**Seeders** have `TableSeeder` suffix and the entity in plural form (i.e. `UsersTableSeeder` because users table).
**Traits** are verbs in the present tense without suffix (i.e. `RegistersUsers`).
**Events** are to be named in past tense (i.e. `UserRegistered`) .
**Listeners** are verbs in imperative mood (i.e. `SendWelcomeEmail`).
**Gates** are verbs in imperative mood (i.e. `update-post`).

### Migrations Naming

create_`<table-name>`_table
add_`<column-names-delimited-with-undescore>`\_to\_`<table-name>`_table
add_`<index-or-foreign-key-name>`
drop_`<table-name>`_table
drop_`<column-names-delimited-with undescore>`\_to\_`<table-name>`_table
drop_`<index-or-foreign-key-name>`

### Index Naming
An index should be named table_column_type. Examples:
users_role_id_foreign
users_id_primary
users_email_unique
geo_state_index

### Resource Controllers
Follow the conventions given in the example in the table:

| Verb      | URI                  | Action       | Route Name | Description
|-----------|-----------------------|--------------|---------------------|-------|
| GET       | `/photos`              | index        | photos.index | Get all resources of a collection |
| GET       | `/photos/create`       | create       | photos.create | Get view for creating a resource |
| POST      | `/photos`              | store        | photos.store | Store a given resource |
| GET       | `/photos/{photo}`      | show         | photos.show | Get a resource |
| GET       | `/photos/{photo}/edit` | edit         | photos.edit | Get view for editing a resource | 
| PUT/PATCH | `/photos/{photo}`      | update       | photos.update | Update a given resource | 
| DELETE    | `/photos/{photo}`      | destroy      | photos.destroy | Destroy a resource |

### Comments
Regarding comment style, for coesion and automatic generation of the published API, it's encouraged the use of the DocBlock  format 
(https://phpdoc.org/docs/latest/guides/docblocks.html), though any code elements that don't have that requirement can have a different style.
All comments are written in English.

CONTRIBUTIONS
-------------
All contributions all welcome and encouraged and must be made through bug reports or pull requests in the official github repository. 

### Reporting Issues

For submitting an issue, please the required steps are:

1. Check in open and closed issues if the inquiry was reported before by somebody else.
2. Propose a PR if needed.

### Security Vulnerabilities

Any security vulnerability discovered must not be reported by creating a new issue in the repository. It must be reported directly to a contributor email.


Coding Style
-------------------

This project follows the [PSR-2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md) coding standard.

Tests
-----
All exposed public functions and classes must have tests created with extensive coverage. Test Driven Development, in which the tests are created prior to the implementation (being almost use-cases), creating very small implementation cycles, is strongly encouraged.

License
-------

Revision Table
--------------

| Author   | Revision      | Date  | Version Number |
|:---------|:-------------:|------:|----------------:|
| Alberto Pereira | First draft | 25/02/2017 | 0.1.0 |

