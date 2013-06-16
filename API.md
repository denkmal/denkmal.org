# API


## Get messages
Request:
```
GET /api/messages HTTP/1.1
Host: www.denkmal.org
```

Response:
```
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
