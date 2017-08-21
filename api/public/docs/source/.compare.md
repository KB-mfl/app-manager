---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)
<!-- END_INFO -->

#App管理
<!-- START_74b9f205005f3bbf88b199a5b7524e9f -->
## api/applist

> Example request:

```bash
curl -X GET "http://localhost/api/applist" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/applist",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/applist`

`HEAD api/applist`


<!-- END_74b9f205005f3bbf88b199a5b7524e9f -->

<!-- START_dc5e08371185e3f3fb6d872458d4134a -->
## api/addapp

> Example request:

```bash
curl -X POST "http://localhost/api/addapp" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/addapp",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/addapp`


<!-- END_dc5e08371185e3f3fb6d872458d4134a -->

<!-- START_1df664e66356d11a79364df693afe50d -->
## api/{app_id}/deleteapp

> Example request:

```bash
curl -X DELETE "http://localhost/api/{app_id}/deleteapp" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/{app_id}/deleteapp",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE api/{app_id}/deleteapp`


<!-- END_1df664e66356d11a79364df693afe50d -->

<!-- START_91ad765d345d58b7332d651cb4f52b6b -->
## api/{app_id}/readapp

> Example request:

```bash
curl -X PUT "http://localhost/api/{app_id}/readapp" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/{app_id}/readapp",
    "method": "PUT",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT api/{app_id}/readapp`


<!-- END_91ad765d345d58b7332d651cb4f52b6b -->

#下载操作
<!-- START_2326bcde22548092491afc34f2dcddde -->
## api/download

> Example request:

```bash
curl -X GET "http://localhost/api/download" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/download",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/download`

`HEAD api/download`


<!-- END_2326bcde22548092491afc34f2dcddde -->

#图片管理
<!-- START_4f4dd19b6baf7a71d36e5e84e1c79dc4 -->
## api/image/{img_name}

> Example request:

```bash
curl -X GET "http://localhost/api/image/{img_name}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/image/{img_name}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/image/{img_name}`

`HEAD api/image/{img_name}`

`POST api/image/{img_name}`

`PUT api/image/{img_name}`

`PATCH api/image/{img_name}`

`DELETE api/image/{img_name}`


<!-- END_4f4dd19b6baf7a71d36e5e84e1c79dc4 -->

<!-- START_9bc84baf94b5b283ab732eae78597bbf -->
## api/{system_id}/image

> Example request:

```bash
curl -X POST "http://localhost/api/{system_id}/image" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/{system_id}/image",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/{system_id}/image`


<!-- END_9bc84baf94b5b283ab732eae78597bbf -->

#数据管理
<!-- START_bf80329c5f48ef59855e21f73b98d3ad -->
## api/{app_id}/data

> Example request:

```bash
curl -X GET "http://localhost/api/{app_id}/data" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/{app_id}/data",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/{app_id}/data`

`HEAD api/{app_id}/data`


<!-- END_bf80329c5f48ef59855e21f73b98d3ad -->

<!-- START_d3410440657fa73bb7bc1d2c3dc70587 -->
## api/{app_id}/data

> Example request:

```bash
curl -X POST "http://localhost/api/{app_id}/data" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/{app_id}/data",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/{app_id}/data`


<!-- END_d3410440657fa73bb7bc1d2c3dc70587 -->

<!-- START_c6a267319cee80ac54f0ed4e822a2ee0 -->
## api/{app_id}/data

> Example request:

```bash
curl -X PUT "http://localhost/api/{app_id}/data" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/{app_id}/data",
    "method": "PUT",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT api/{app_id}/data`


<!-- END_c6a267319cee80ac54f0ed4e822a2ee0 -->

<!-- START_0daed5a848a16368a5a1bce3949a1a69 -->
## api/{app_id}/data

> Example request:

```bash
curl -X DELETE "http://localhost/api/{app_id}/data" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/{app_id}/data",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE api/{app_id}/data`


<!-- END_0daed5a848a16368a5a1bce3949a1a69 -->

#版本管理
<!-- START_b96fadaebeb014e9b3dac4306a43f197 -->
## api/{system_id}/version

> Example request:

```bash
curl -X GET "http://localhost/api/{system_id}/version" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/{system_id}/version",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/{system_id}/version`

`HEAD api/{system_id}/version`


<!-- END_b96fadaebeb014e9b3dac4306a43f197 -->

<!-- START_02508219a8d9bf036d509fd030c23221 -->
## api/{system_id}/version

> Example request:

```bash
curl -X POST "http://localhost/api/{system_id}/version" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/{system_id}/version",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/{system_id}/version`


<!-- END_02508219a8d9bf036d509fd030c23221 -->

<!-- START_d317debd6541f322b1a1a9868e807672 -->
## api/{system_id}/version

> Example request:

```bash
curl -X DELETE "http://localhost/api/{system_id}/version" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/{system_id}/version",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE api/{system_id}/version`


<!-- END_d317debd6541f322b1a1a9868e807672 -->

<!-- START_7a8c9317fa5846d46326575e76087388 -->
## api/{system_id}/version

> Example request:

```bash
curl -X PUT "http://localhost/api/{system_id}/version" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/{system_id}/version",
    "method": "PUT",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT api/{system_id}/version`


<!-- END_7a8c9317fa5846d46326575e76087388 -->

#用户操作
<!-- START_d7b7952e7fdddc07c978c9bdaf757acf -->
## 用户注册

> Example request:

```bash
curl -X POST "http://localhost/api/register" \
-H "Accept: application/json" \
    -d "username"="et" \
    -d "password"="et" \
    -d "admin"="1" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/register",
    "method": "POST",
    "data": {
        "username": "et",
        "password": "et",
        "admin": true
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/register`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    username | string |  required  | Minimum: ` 6`
    password | string |  required  | Minimum: ` 6`
    admin | boolean |  optional  | 

<!-- END_d7b7952e7fdddc07c978c9bdaf757acf -->

<!-- START_c3fa189a6c95ca36ad6ac4791a873d23 -->
## 用户登录

> Example request:

```bash
curl -X POST "http://localhost/api/login" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/login",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/login`


<!-- END_c3fa189a6c95ca36ad6ac4791a873d23 -->

#系统管理
<!-- START_fe059461fc2c033be6ce57cbeb1c8844 -->
## api/{app_id}/system

> Example request:

```bash
curl -X GET "http://localhost/api/{app_id}/system" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/{app_id}/system",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/{app_id}/system`

`HEAD api/{app_id}/system`


<!-- END_fe059461fc2c033be6ce57cbeb1c8844 -->

<!-- START_134da392169b2d885006036a869ece51 -->
## api/{app_id}/system

> Example request:

```bash
curl -X POST "http://localhost/api/{app_id}/system" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/{app_id}/system",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/{app_id}/system`


<!-- END_134da392169b2d885006036a869ece51 -->

<!-- START_e4b91369182279f52499e43e911a6000 -->
## api/{app_id}/system

> Example request:

```bash
curl -X DELETE "http://localhost/api/{app_id}/system" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/{app_id}/system",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE api/{app_id}/system`


<!-- END_e4b91369182279f52499e43e911a6000 -->

<!-- START_21943f2972e4cc03e5457d2846d1c675 -->
## api/{app_id}/system

> Example request:

```bash
curl -X PUT "http://localhost/api/{app_id}/system" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/{app_id}/system",
    "method": "PUT",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT api/{app_id}/system`


<!-- END_21943f2972e4cc03e5457d2846d1c675 -->

#评论管理
<!-- START_bded806b1de8feacfece1ae7cbd8f064 -->
## api/{app_id}/feedback

> Example request:

```bash
curl -X GET "http://localhost/api/{app_id}/feedback" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/{app_id}/feedback",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/{app_id}/feedback`

`HEAD api/{app_id}/feedback`


<!-- END_bded806b1de8feacfece1ae7cbd8f064 -->

<!-- START_fb28bfdeb6707b01b9093e9c2d5d35b5 -->
## api/{app_id}/feedback

> Example request:

```bash
curl -X POST "http://localhost/api/{app_id}/feedback" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/{app_id}/feedback",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/{app_id}/feedback`


<!-- END_fb28bfdeb6707b01b9093e9c2d5d35b5 -->

<!-- START_11f8481f13c6f423e3fba5e5985b9107 -->
## api/{app_id}/feedback

> Example request:

```bash
curl -X DELETE "http://localhost/api/{app_id}/feedback" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/{app_id}/feedback",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE api/{app_id}/feedback`


<!-- END_11f8481f13c6f423e3fba5e5985b9107 -->

#首屏推送管理
<!-- START_b704e2a15cdd9dc22e1e5014b934b107 -->
## api/{app_id}/first_screen

> Example request:

```bash
curl -X GET "http://localhost/api/{app_id}/first_screen" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/{app_id}/first_screen",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/{app_id}/first_screen`

`HEAD api/{app_id}/first_screen`


<!-- END_b704e2a15cdd9dc22e1e5014b934b107 -->

<!-- START_d38324ada054c09c5f5a44871b4e0a23 -->
## api/{app_id}/first_screen

> Example request:

```bash
curl -X POST "http://localhost/api/{app_id}/first_screen" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/{app_id}/first_screen",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/{app_id}/first_screen`


<!-- END_d38324ada054c09c5f5a44871b4e0a23 -->

<!-- START_ef37c225a2171a4efa63808e19fcb3ef -->
## api/{app_id}/first_screen

> Example request:

```bash
curl -X PUT "http://localhost/api/{app_id}/first_screen" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/{app_id}/first_screen",
    "method": "PUT",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT api/{app_id}/first_screen`


<!-- END_ef37c225a2171a4efa63808e19fcb3ef -->

<!-- START_bfcb2c7fc5d3d78a1cf978c0a66550ab -->
## api/{app_id}/first_screen

> Example request:

```bash
curl -X DELETE "http://localhost/api/{app_id}/first_screen" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/{app_id}/first_screen",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE api/{app_id}/first_screen`


<!-- END_bfcb2c7fc5d3d78a1cf978c0a66550ab -->

