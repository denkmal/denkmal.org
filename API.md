# API

## Get data
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
         "description":"Foo",
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
         "from":1371386731,
         "starred":false
      }
   ],
   "messages":[
      {
         "id":401,
         "venue":78,
         "created":1371386731,
         "text":"Foo 1",
         "image-url":null
      },
      {
         "id":402,
         "venue":78,
         "created":1371386731,
         "text":null,
         "image-url":"http://www.example.com/image.jpg"
      }
   ],
   "dayOffset" : 6
}
```


## Get messages
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
      "image-url":null
   },
   {
      "id":5,
      "venue":3,
      "created":1371383458,
      "text":null,
      "image-url":"http://www.example.com/image.jpg"
   }
]
```

Optionally you can specify how many messages to receive maximum, and how many minimum for venues that have upcoming events:
```
GET /api/messages?maxMessages=500&minMessagesVenue=3 HTTP/1.1
Host: www.denkmal.org
```


## Send message
Request:
```
POST /api/message HTTP/1.1
Host: www.denkmal.org
content-type: text/plain
content-length: 65

venue=1&text=foobar&hash=<HASH>
```
Response:
```json
{
	"id":13,
	"venue":1,
	"created":1380379451,
	"text":"foobar",
	"image-url":null
}
```
Where `<HASH>` is `sha1($secret . $text)`.

Optionally send an image along:
```
POST /api/message HTTP/1.1
Host: www.denkmal.org
content-type: text/plain
content-length: 1234

venue=1&image-data=<BASE64-ENCODED-IMAGE-DATA>&hash=<HASH>
```
Where `<HASH>` is `sha1($secret . md5($file))`.


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

You will receive messages in the following format:
```
{
   "channel":"global-external:18",
   "event":"message-create",
   "data":{
      "id":12,
      "venue":1,
      "created":1380409713,
      "text":"hello world"
   }
}
```
