API
===

Get data
--------
Retrieve list of all venues plus upcoming events.

Request:
```
GET /api/data HTTP/1.1
Host: www.denkmal.org
```

Response:
```json
{
   "venues":[
      {
         "id":78,
         "name":"Foo 1",
         "url":"http:\/\/www.example.com",
         "address":"Address 1",
         "latitude":12.1,
         "longitude":13.3
      },
      {
         "id":79,
         "name":"Foo 2"
      }
   ],
   "events":[
      {
         "id":934,
         "venue":123,
         "description":"Foo Bar",
         "descriptionHtml":"Foo <a href='http://bar.com' class='url' target='_blank'>Bar</a>",
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
         "from":1371386731,
         "starred":false
      }
   ],
   "dayOffset" : 6,
   "suspendedDays": null
}
```

When the site is suspended temporarily `suspendedDays` will contain the number of days left until we're back.


Get events
----------
Retrieve future events for a venue.

Parameters:
- `venue`: Name of the venue
- `maxEvents` (optional): Maximum number of events

Request:
```
GET /api/events?venue=Hirscheneck HTTP/1.1
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
         "from":1371386731,
         "starred":false
      }
   ],
}
```


Get messages
------------
Retrieve recent messages.

Parameters:
- `maxMessages` (optional): Maximum number of messages
- `minMessagesVenue` (optional): Minimum number of messages for venues that have upcoming events
- `startAfterId` (optional): Only include messages with ID larger than this number

Request:
```
GET /api/messages HTTP/1.1
Host: www.denkmal.org
```

Response:
```json
[
   {
      "id":4,
      "venue":2,
      "created":1371383458,
      "text":"Foo 1",
      "image":null
   },
   {
      "id":5,
      "venue":3,
      "created":1371383458,
      "text":null,
      "image":{
         "url-view":"http://www.example.com/image-view.jpg",
         "url-thumb":"http://www.example.com/image-thumb.jpg"
      }
   }
]
```


Send message
------------
Send a message. Only available if you know the API *secret*.

Parameters:
- `venue`: ID of the venue
- `clientId`: Client cookie (string)
- `text` (optional): Text to post
- `image-data` (optional): Image to post (base64 encoded)
- `hash`: Hash of content and *secret*
 - For text: `sha1($secret . $text)`
 - For image: `sha1($secret . md5($file))`


Request:
```
POST /api/message HTTP/1.1
Host: www.denkmal.org
content-type: text/plain
content-length: 65

venue=1&clientId=my-client&text=foobar&hash=<HASH>
```
Response:
```json
{
	"id":13,
	"venue":1,
	"created":1380379451,
	"text":"foobar",
	"image":null
}
```


## Receive message (WebSocket)
Connect via WebSocket to `ws://stream.denkmal.org:8090/websocket`.
Send the following JSON-string to subscribe to messages:
```
{
   "event":"subscribe",
   "data":{
      "channel":"global-external:18",
      "data":"null",
      "start":<TIMESTAMP>
   }
}
```
where `<TIMESTAMP>` is a unix timestamp in seconds from when on you want to receive messages.

You will receive messages in the following format (`data` is the same as in the HTTP API):
```
{
   "channel":"global-external:15",
   "event":"message-create",
   "data":{
      "id":5,
      "venue":3,
      "created":1371383458,
      "text":null,
      "image":{
         "url-view":"http://www.example.com/image-view.jpg",
         "url-thumb":"http://www.example.com/image-thumb.jpg"
      }
   }
}
```
