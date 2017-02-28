Client
=======
Author: Alberto Pereira

Date: 25/02/2017

Version: 0.1.0

Summary
--------

This documents details the technological architecture of the client application. 

Overview
---------

The client module generates either a complete visualization or a view of a budget of a specific municipality through the years, including all its categories (eg.: revenues, expenses, funds and reserves, etc). As it consumes the data from the API, it can be housed in any other server.


Technologies
------------

### Summary

CLOSER client application is built over [VueJS](https://vuejs.org/), a javascript framework. Being decoupled and consuming data from an API service, other technologies can be used to create new clients, or new versions of the official client, enhancing the versatility of the application, and providing a needed flexibility for a long lifecycle.
 

### External libraries and components

Any external library and component outside the scope of the vuejs framework core is listed here.

| Name | Description | URL |
|:--------|:--------------|:------|
|**vue-router** | `vue-router` is the official router for Vue.js. | https://github.com/vuejs/vue-router |
|**vue-resource**| The plugin for Vue.js provides services for making web requests and handle responses using a XMLHttpRequest or JSONP. | https://github.com/pagekit/vue-resource |
|**Vuex**| Centralized State Management for Vue.js. | https://github.com/vuejs/vuex | 


Structure
---------

The following diagram represents the overall structure of the client application.

![enter image description here](http://albertopereira.com/images/vuex_structure_diagram.png)



Mockup Components
--------------

### Summary

This section shows the visual examples of the desired final **main representations** of data in the client.

### Treemap

##### Definition

A treemap represents data hierarchically using nested rectangles.

##### Example

![enter image description here](http://albertopereira.com/images/card.png)

### Line Chart

##### Definition

A line chart represents data using lines within a x*y axis.

##### Example

![enter image description here](http://albertopereira.com/images/graph.png)

### BubbleTree

##### Definition

Displays data in a radial display

##### Example

![enter image description here](http://albertopereira.com/images/bubbletree.png)

### Stacked Horizontal Graph

##### Definition

Displays a main set of data using stacked rectangles.

##### Example

![enter image description here](http://albertopereira.com/images/stacked_horizontal_graph.png)


### Tabular view

##### Definition

Displays a main set of data using a table with the values.

##### Example

![enter image description here](http://albertopereira.com/images/tabular.png)


### Heatmap

##### Definition

Displays a main set of data using maps with its geographical distribution.

##### Example

![enter image description here](http://albertopereira.com/images/heatmap_1.png)
![enter image description here](http://albertopereira.com/images/heatmap_2.png)


The store
---------

### Summary

Data in the client is centralized in a collection of globally accessible objects, called the store. Every change in the data will have a correspondent change in a rerendered component, that represents that data.

### Data structure

The main element of the data store, served by the API, is an object with the following structure:

An entry is defined by:

 - name {string}: entry name
 - src {url string}: link to data source from where entry data was extracted (optional)
 - sub {array of other entries}: subsections that make up current entry
 - descr {string} : entry description (optional)
 - values {array of value objects} : entry values over time

A value object is defined by:

- year : year of value
- val : value
- lat: latitude of value
- lng: longitude of value


Revision Table
--------------

| Author   | Revision      | Date  | Version Number |
|----------|:-------------:|------:|----------------:|
| Alberto Pereira | First draft | 25/02/2017 | 0.1.0 |
