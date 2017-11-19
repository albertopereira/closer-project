API
=======
Author: Alberto Pereira

Date: 19/11/2017

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
| https://[address]:[port]/{view} |

**Address**
IP Address or API server name.

**Port**
API port.

**View**
The id of the view to return.

### Responses

Responses to requests originate a 200 code in success, or other codes in case of error. A successful response returns a JSON object, and a error response returns a string with the description of the error.

Data models
-----------

The following models are used in replies to requests:

### Budget

| Field | Datatype | Optional | Description |
|:------|:---------|:---------|:------------|
| id    | Integer  | No       |             |
| org_name | String | Yes | |
| org_email | String | Yes | |
| org_url | String | Yes | |
| agency_name | String | Yes | |
| agency_email | String | Yes | |
| agency_url | String | Yes | |
| country | String | Yes | |
| state | String | Yes | |
| view  | View | No | | 

### View

| Field | Datatype | Optional | Description |
|:------|:---------|:---------|:------------|
| id    | Integer  | No       |             |
| name  | String   | Yes      |             |
| description  | String   | Yes      |             |
| graphs | Array | No | Defines which graphs to show |
| data | Data | No | |

### Data

| Field | Datatype | Optional | Description |
|:------|:---------|:---------|:------------|
| id    | Integer  | No       |             |
| description  | String   | Yes      |             |
| source  | String   | Yes      |             |
| source_url  | String   | Yes      |             |
| values | [Value] | No | |
| sub | [Data] | Yes | |

### Value

| Field | Datatype | Optional | Description |
|:------|:---------|:---------|:------------|
| val    | Integer  | No       |             |
| year    | Integer  | No       |             |
| lat    | String  | No       |             |
| lng    | String  | No       |             |

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

    {
	    "id": 1,
	    "org_name": "CMSantarém",
	    "org_url": "http://www.cmsantarem.pt",
	    "org_email": "geral@cmsantarem.pt",
	    "agency_name": "O Mirante",
	    "agency_url": "http://www.omirante.pt",
	    "agency_email": "geral@omirante.pt",
	    "country": "Portugal",
	    "state": "Santarém",
	    "view":[
		    "id": 1,
		    "name": "Example view",
		    "description": "This view shows graph and tabular data for 3 years of the budget education expenses.",
		    "graphs":[
			    "graph": 1,
			    "tabular": 1,
			    "bubbletree": 0,
			    "heatmap": 0,
			    "stacked_horizontal": 0,
			    "treemap": 0
		    ],
		    "data":[
			    "id": 1,
			    "description": "Education Expenses",
			    "source": "CMSantarém",
			    "source_url": "",
			    "values":[
				    {
		               "val": 1885012.0,
		               "year": 2014,
		               "lat": "39.325794",
		               "lng": "-8.8613707"
		            },
		            {
		               "val": 1985012.0,
		               "year": 2015,
		               "lat": "39.325794",
		               "lng": "-8.8613707"
		            },
		            {
		               "val": 2085012.0,
		               "year": 2016,
		               "lat": "39.325794",
		               "lng": "-8.8613707"
		            },
				],
				"sub":[
					{
						"id": 2,
					    "description": "Schools",
					    "source": "CMSantarém",
					    "source_url": "",
					    "values":[
						    {
				               "val": 885012.0,
				               "year": 2014,
				               "lat": "39.325794",
				               "lng": "-8.8613707"
				            },
				            {
				               "val": 985012.0,
				               "year": 2015,
				               "lat": "39.325794",
				               "lng": "-8.8613707"
				            },
				            {
				               "val": 285012.0,
				               "year": 2016,
				               "lat": "39.325794",
				               "lng": "-8.8613707"
				            },
						],
					},
					{
						"id": 3,
					    "description": "Transportation",
					    "source": "CMSantarém",
					    "source_url": "",
					    "values":[
						    {
				               "val": 85012.0,
				               "year": 2014,
				               "lat": "39.325794",
				               "lng": "-8.8613707"
				            },
				            {
				               "val": 55012.0,
				               "year": 2015,
				               "lat": "39.325794",
				               "lng": "-8.8613707"
				            },
				            {
				               "val": 28522.0,
				               "year": 2016,
				               "lat": "39.325794",
				               "lng": "-8.8613707"
				            },
						],
					}
				]
		    ]
	    ]
    }

Revision Table
--------------

| Author   | Revision      | Date  | Version Number |
|----------|:-------------:|------:|----------------:|
| Alberto Pereira | First draft | 19/11/2017 | 0.1.0 |
