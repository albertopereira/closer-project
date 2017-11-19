API
=======
Author: Alberto Pereira

Date: 25/02/2017

Version: 0.1.0

Summary
--------

This documents details the API specification for the CLOSER application. 

Overview
---------

The API server provides JSON objects with the representations of *views* of the budget data created in the backend.

General specification
---------------------

Communication with the API server is made with JSON/REST requests.

### API structure

| API                             |
|---------------------------------|
| https://[address]:[port]/{budget}/{view} |

**Address**
IP Address or API server name.

**Port**
API port.

**Budget**
The id of the budget to return.

**View**
The id of the view to return.

### Responses

Responses to requests originate a 200 code in success, or other codes in case of error. A successful response returns a JSON object, and a error response returns a string with the description of the error.

Data models
-----------

The following models are used in replies to requests:

### Budget

| Field | Datatype | Description |
|:------|:---------|:------------|
| key    | String  | The name of the budget |
| coords | String | The coords (lat, lng) for the map center|
| descr | String | The description |
| src | String | The source of the data  |
| values | Array[Value] | The values for the overall data |
| view | Array | Contains the selected views |
| children  | Array[Budget] | The children of the given budget node |

### Value

| Field | Datatype | Description |
|:------|:---------|:------------|
| year    | String  | The year of the value |
| val | Float | The value for the year |


Responses
---------

The responses are constructed in the following structure:

### Response

| Code | Type | Content | Description |
|:-----|:-----|:--------|:------------|
| 200 | OK | Budget | |
| Other codes | KO | error | Error string |


### Example: request

GET https://example.pt:1234/1111

### Example: response

``` json

{
   "key":"Câmara Municipal de Lisboa",
   "descr":"Programas Lisboa - 2017-2019",
   "src":"no-reply@closer.com",   
   "coords":"38.7057302,-9.1414086",
   "children":[
      {
         "key":"EIXO A - LISBOA MAIS PRÓXIMA",
         "descr":"EIXO A - LISBOA MAIS PRÓXIMA",         
         "values":[
            {
               "year":"2017",
               "val":123430
            },
            {
               "year":"2018",
               "val":86991
            },
            {
               "year":"2019",
               "val":44478
            }
         ]
      },
      {
         "key":"EIXO B - LISBOA EMPREENDEDORA",
         "descr":"EIXO B - LISBOA EMPREENDEDORA",         
         "values":[
            {
               "year":"2017",
               "val":1258
            },
            {
               "year":"2018",
               "val":1177
            },
            {
               "year":"2019",
               "val":677
            }
         ]
      },
      {
         "key":"EIXO C - LISBOA INCLUSIVA",
         "descr":"EIXO C - LISBOA INCLUSIVA",         
         "values":[
            {
               "year":"2017",
               "val":45677
            },
            {
               "year":"2018",
               "val":73622
            },
            {
               "year":"2019",
               "val":32344
            }
         ]
      },
      {
         "key":"EIXO D - LISBOA SUSTENTÁVEL",
         "descr":"EIXO D - LISBOA SUSTENTÁVEL",         
         "values":[
            {
               "year":"2017",
               "val":102002
            },
            {
               "year":"2018",
               "val":87391
            },
            {
               "year":"2019",
               "val":74518
            }
         ]
      }
   ],
   "values":[
      {
         "year":"2017",
         "val":287783
      },
      {
         "year":"2018",
         "val":260622
      },
      {
         "year":"2019",
         "val":158487
      }
   ],
   "view":[
      "gt",
      "m",
      "t"
   ]
}

```

Revision Table
--------------

| Author   | Revision      | Date  | Version Number |
|----------|:-------------:|------:|----------------:|
| Alberto Pereira | First draft | 19/11/2017 | 0.1.0 |
