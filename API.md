API
===

The base URL for all API requests is:
```
https://www.denkmal.org/<region>/api
```
Where `<region>` is the slug of the desired region (e.g. "basel").

Get events
----------
Retrieve future events for a venue.

Parameters:
- `venue`: Name of the venue
- `maxEvents` (optional): Maximum number of events

Request:
```
GET /<region>/api/events?venue=Hirscheneck HTTP/1.1
Host: www.denkmal.org
```

Response:
```json
{
   "events":[
      {
         "id":934,
         "venue":123,
         "description":"Foo Bar",
         "descriptionHtml":"Foo <a href='http://bar.com' class='url' target='_blank'>Bar</a>",
         "timeZone":"Europe/Zurich",
         "from":1371386731,
         "until":1371386731,
         "starred":false,
         "song":{
            "label":"Song 1",
            "url":"http:\/\/denkmal.test\/userfiles\/songs\/64.mp3"
         }
      },
      {
         "id":935,
         "venue":123,
         "description":"Foo",
         "descriptionHtml":"Foo",
         "timeZone":"Europe/Zurich",
         "from":1371386731,
         "starred":false
      }
   ],
}
```
