This API is modified and adapted version of [Larapi by Esben Petersen](https://github.com/esbenp/larapi)

Query: Get Data
---

Filter can be applied

**Common Pattern:**
```
GET https://dbs.noxus.co.id/{tableNamePlural}
GET https://dbs.noxus.co.id/{tableNamePlural}/{userId}
```
**Usage Pattern:**
```
GET https://dbs.noxus.co.id/users
GET https://dbs.noxus.co.id/users/{userId}

GET https://dbs.noxus.co.id/drivers
GET https://dbs.noxus.co.id/drivers/{driverId}

GET https://dbs.noxus.co.id/vehicles
GET https://dbs.noxus.co.id/vehicles/{vehicleId}

GET https://dbs.noxus.co.id/trips
GET https://dbs.noxus.co.id/trips/{tripId}

GET https://dbs.noxus.co.id/waypoints
GET https://dbs.noxus.co.id/waypoints/{waypointId}

GET https://dbs.noxus.co.id/checkpoints
GET https://dbs.noxus.co.id/checkpoints/{checkpointId}

GET https://dbs.noxus.co.id/divisions
GET https://dbs.noxus.co.id/divisions/{divisionId}

GET https://dbs.noxus.co.id/sites
GET https://dbs.noxus.co.id/sites/{siteId}

GET https://dbs.noxus.co.id/regions
GET https://dbs.noxus.co.id/regions/{regionId}

GET https://dbs.noxus.co.id/feedbacks
GET https://dbs.noxus.co.id/feedbacks/{feedbackId}
```

Query: Create Data
---
Create request uses `POST` method.

**Common Pattern:**

```
POST https://dbs.noxus.co.id/{tableNamePlural}
```

````json
Header:
Authentication: Bearer<space>{access_token}
Content-Type: application/json

Body:
{
  tableName: {
    fieldName[0]: fieldValue[0],
    fieldName[1]: fieldValue[1],
    fieldName[2]: fieldValue[2],
    .
    .
    .
    fieldName[n]: fieldValue[n],
  }
}
````

**Request  Example:** `POST https://dbs.noxus.co.id/regions`

```json
{ 
  "region": {
    "name": "Tes"
  }
}
```

```json
{
  "name": "Tes",
  "updated_at": "2017-04-23 13:52:37",
  "created_at": "2017-04-23 13:52:37",
  "id": 6
}
```

Query: Update Data
---

Update request use `PATCH` method.

**Common Pattern:**

```
PATCH https://dbs.noxus.co.id/{tableNamePlural}
PATCH https://dbs.noxus.co.id/{tableNamePlural}/{fieldId}
```

````json
Header:
Authentication: Bearer<space>{access_token}
Content-Type: application/json

Body:
{
  tableName: {
    fieldName[0]: fieldValue[0],
    fieldName[1]: fieldValue[1],
    fieldName[2]: fieldValue[2],
    .
    .
    .
    fieldName[n]: fieldValue[n],
  }
}
````

**Request  Example:** `PATCH https://dbs.noxus.co.id/regions`

```json
{ 
  "region": {
    "name": "Tes"
  }
}
```

```json
{
  "name": "Tes",
  "updated_at": "2017-04-23 13:52:37",
  "created_at": "2017-04-23 13:52:37",
  "id": 6
}
```

**Request Example:** `PATCH https://dbs.noxus.co.id/regions/6`

```
{ 
  "region": {
    "name": "TESTER"
  }
}
```

```json
{
  "id": 6,
  "name": "TESTER",
  "created_at": "2017-04-23 13:52:37",
  "updated_at": "2017-04-23 14:03:17"
}
```

Query: Delete Data
---

Delete request use `delete` method.

**Common Pattern:**

```
DELETE https://dbs.noxus.co.id/{tableNamePlural}/{fieldId}
```

````json
Header:
Authentication: Bearer<space>{access_token}
````

**Request  Example:** `DELETE https://dbs.noxus.co.id/regions/6`

```json
{}
```
Available Query Parameters
---

| Key           | Type    | Description                              |
| ------------- | ------- | ---------------------------------------- |
| Includes      | array   | Array of related resources to load, e.g. ['author', 'publisher', 'publisher.books'] |
| Sort          | array   | Property to sort by, e.g. 'title'        |
| Limit         | integer | Limit of resources to return             |
| Page          | integer | For use with limit                       |
| Filter_groups | array   | Array of filter groups. See below for syntax. |

---

### I. Includes
---
Includes are a methodology to join tables and return JSON

**Default Pattern:**
```html
GET https://dbs.noxus.co.id/{tableNamePlural}?includes[]={relatedTableNamePlural}
```

**Usage Pattern:**
```html
GET https://dbs.noxus.co.id/users?includes[]=drivers
GET https://dbs.noxus.co.id/drivers?includes[]=vehicles
GET https://dbs.noxus.co.id/users?includes[]=trips

**Not all table can be joined**
**ONLY use two pivot table**
```
**Response Example:** `GET https://dbs.noxus.co.id/users?includes[]=drivers`

```json
{
  "users": [
    {    
      "id": 3,
      "username": "autopilot",
      "email": "autopilot@noxus.co.id",
      "full_name": "Mr. Autopilot",
      "gender": "male",
      "phone_number": "083899000097",
      "access_level": 4,
      "status": true,
      "token": null,
      "requests": 0,
      "created_at": "2017-01-01 00:00:00",
      "updated_at": null,
      "division_id": 2,
      "drivers": {
        "id": 2,
        "user_id": 3,
        "status": "1",
        "created_at": "2017-01-01 00:00:00",
        "updated_at": null,
        "latitude": "-6.282398",
        "longitude": "106.702439"
      }
    }
  ]
}  
```

**IDs Pattern**:

```html
GET https://dbs.noxus.co.id/{tableNamePlural}?includes[]={relatedTableNamePlural}:ids
```

**Usage Pattern:**

```
GET https://dbs.noxus.co.id/users?includes[]=drivers:ids
GET https://dbs.noxus.co.id/drivers?includes[]=vehicles:ids
GET https://dbs.noxus.co.id/users?includes[]=trips:ids

**Not all table can be joined**
**ONLY use two pivot table**
```

**Request Example:** `GET https://dbs.noxus.co.id/users?includes[]=drivers:ids`

```json
{
  "users": [
    {
      "id": 4,
      "username": "tes",
      "email": "tes@tes.tes",
      "full_name": "tes",
      "gender": "0",
      "phone_number": "0",
      "access_level": 4,
      "status": true,
      "token": "0",
      "requests": 1,
      "created_at": "2017-04-08 12:30:39",
      "updated_at": "2017-04-08 12:30:39",
      "division_id": 1,
      "drivers": 3
    }
  ]
}
```

**Sideload Pattern:** 

```
GET https://dbs.noxus.co.id/{tableNamePlural}?includes[]={relatedTableNamePlural}:sideload
```

**Usage Pattern:**

```
GET https://dbs.noxus.co.id/users?includes[]=drivers:sideload
GET https://dbs.noxus.co.id/drivers?includes[]=vehicles:sideload
GET https://dbs.noxus.co.id/users?includes[]=trips:sideload

**Not all table can be joined**
**ONLY use two pivot table**
```

**Response Example:** `GET https://dbs.noxus.co.id/users?includes[]=drivers:sideload`

```json
{
  "drivers": [
    {
      "id": 2,
      "user_id": 3,
      "status": "1",
      "created_at": "2017-01-01 00:00:00",
      "updated_at": null,
      "latitude": "-6.282398",
      "longitude": "106.702439"
    }
  ],
  "users": [
    {
      "id": 4,
      "username": "tes",
      "email": "tes@tes.tes",
      "full_name": "tes",
      "gender": "0",
      "phone_number": "0",
      "access_level": 4,
      "status": true,
      "token": "0",
      "requests": 1,
      "created_at": "2017-04-08 12:30:39",
      "updated_at": "2017-04-08 12:30:39",
      "division_id": 1,
      "drivers": 3
    }
  ]
}    
```



### II. Sort

---
Should be defined as an array of sorting rules. They will be applied in the order of which they are defined.

**Sorting rules**

| Property  | Value type  | Description                             |
| --------- | ----------- | --------------------------------------- |
| key       | string      | The property of the model to sort by    |
| direction | ASC or DESC | Which direction to sort the property by |

**Sort Pattern:**

```
GET https://dbs.noxus.co.id/{tableNamePlural}?sort[index][key]={value}&sort[index][direction]={ASC/DESC}
```

**Usage Pattern:**

```
GET https://dbs.noxus.co.id/users?includes[]=drivers&sort[0][key]=username&sort[0][direction]=DESC
```

**Request Example:** `GET https://dbs.noxus.co.id/users?includes[]=drivers&sort[0][key]=username&sort[0][direction]=DESC`

```json
{
  "users": [
    {
      "id": 8,
      "username": "titodharma",
      "email": "tito.dharma@noxus.co.id",
      "full_name": "Tito Dharma",
      "gender": "Male",
      "phone_number": "+6282260063986",
      "access_level": 0,
      "status": true,
      "token": null,
      "requests": 0,
      "created_at": "2017-04-03 08:07:34",
      "updated_at": "2017-04-03 11:13:04",
      "division_id": 1,
      "drivers": null
    },
    {
      "id": 4,
      "username": "tes",
      "email": "tes@tes.tes",
      "full_name": "tes",
      "gender": "0",
      "phone_number": "0",
      "access_level": 4,
      "status": true,
      "token": "0",
      "requests": 1,
      "created_at": "2017-04-08 12:30:39",
      "updated_at": "2017-04-08 12:30:39",
      "division_id": 1,
      "drivers": {
        "id": 3,
        "user_id": 4,
        "status": "0",
        "created_at": "2017-04-23 10:43:00",
        "updated_at": null,
        "latitude": null,
        "longitude": null
      }
    }
  ]
}
```



### III. Limit

---

Limit is used to get paging or a certain number of results.

| Property | Value type | Description                              |
| -------- | ---------- | ---------------------------------------- |
| Limit    | string     | `limit` will determine the number of results. |
| Page     | string     | `page` will determine the current page.  |

**Limit Pattern:**

```
GET https://dbs.noxus.co.id/{tableNamePlural}?limit={value}&page={value}
```

**Usage Pattern:**

```
GET https://dbs.noxus.co.id/{tableNamePlural}?limit=11&page=3
```

**Request Example:** `GET https://dbs.noxus.co.id/users?limit=1&page=1`

```json
{
  "users": [
    {
      "id": 6,
      "username": "Mahesa",
      "email": "mahesa@noxus.co.id",
      "full_name": "Mahesa Hoesain",
      "gender": "Male",
      "phone_number": "+6285715335178",
      "access_level": 0,
      "status": true,
      "token": null,
      "requests": 0,
      "created_at": "2017-03-16 07:32:20",
      "updated_at": "2017-03-21 08:34:58",
      "division_id": 1
    }
  ]
}
```



### IV. Filter 

Should be defined as an array of filter groups.

**Filter groups**

| Property | Value type | Description                              |
| -------- | ---------- | ---------------------------------------- |
| or       | boolean    | Should the filters in this group be grouped by logical OR or AND operator |
| filters  | array      | Array of filters (see syntax below)      |

**Filters**

| Property | Value type | Description                              |
| -------- | ---------- | ---------------------------------------- |
| key      | string     | The property of the model to filter by (can also be custom filter) |
| value    | mixed      | The value to search for                  |
| operator | string     | The filter operator to use (see different types below) |
| not      | boolean    | Negate the filter                        |

**Operators**

| Type | Description     | Example                                  |
| ---- | --------------- | ---------------------------------------- |
| ct   | String contains | `fuq` matches `dafuq furqon` and `fusrodah` |
| sw   | Starts with     | `fuq` matches `fuq` but not `da`         |
| ew   | Ends with       | `fuq` matches `dafuq` but not `Eva Notty` |
| eq   | Equals          | `Sasha Grey` matches `Sasha Grey` but not `McDonalds` |
| gt   | Greater than    | `1548` matches `1600` but not `1400`     |
| lt   | Lesser than     | `1600` matches `1548` but not `1700`     |
| in   | In array        | `['Sasha', 'Grey']` matches `Sasha` and `Grey` but not `Gianna` |

**Special values**

| Value          | Description                              |
| -------------- | ---------------------------------------- |
| null (string)  | The property will be checked for NULL value |
| (empty string) | The property will be checked for NULL value |


**Apply Filter URL**
```
Usage Pattern *For easier reading! shan't be new line*:
GET https://dbs.noxus.co.id/{tableName}?
filter_groups[0][filters][0][key]={fieldName}&
filter_groups[0][filters][0][value]={fieldValue}&
filter_groups[0][filters][0][operator]={filterOperator}

*Example: URL must be encoded!*
GET https://dbs.noxus.co.id/drivers?filter_groups%5B0%5D%5Bfilters%5D%5B0%5D%5Bkey%5D=status&filter_groups%5B0%5D%5Bfilters%5D%5B0%5D%5Bvalue%5D=1&filter_groups%5B0%5D%5Bfilters%5D%5B0%5D%5Boperator%5D=eq

*Filter URL*
GET https://dbs.noxus.co.id/users 
GET https://dbs.noxus.co.id/drivers
GET https://dbs.noxus.co.id/vehicles
GET https://dbs.noxus.co.id/trips
GET https://dbs.noxus.co.id/waypoints
GET https://dbs.noxus.co.id/checkpoints
GET https://dbs.noxus.co.id/divisions
GET https://dbs.noxus.co.id/sites
GET https://dbs.noxus.co.id/regions
GET https://dbs.noxus.co.id/feedback
```

**Filter JSON Structure**
```
{
  "filter_groups": [
    {
      "filters": [
        {
          "key": {fieldName},
          "value": {fieldValue},
          "operator": {filterOperator}
        }
      ]
    }
  ]
}
```

**Filter ARRAY Structure [URL DECODED]**
```
filter_groups[0][filters][0][key]={fieldName}&
filter_groups[0][filters][0][value]={fieldValue}&
filter_groups[0][filters][0][operator]={filterOperator}
```