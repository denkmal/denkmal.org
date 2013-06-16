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
         "text":"Foo 1"
      },
      {
         "id":402,
         "venue":78,
         "created":1371386731,
         "text":"Foo 2"
      }
   ]
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
      "text":"Foo 1"
   },
   {
      "id":5,
      "venue":3,
      "created":1371383458,
      "text":"Foo 2"
   }
]
```


## Send message
Request:
```
POST /api/message HTTP/1.1
Host: www.denkmal.org

venue=23&text=Foobar
```
