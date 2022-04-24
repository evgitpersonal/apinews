<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Basic API News Project</h1>
    <br>
</p>

Yii 2 Basic Project which implements api access to the data. Base actions are already available 
such as create, view, update and delete users, categories and news. Each news can be in many categories.
The project uses simple authentication by '?access-token=' for manipulating data in DB.

DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.6.0.


INSTALLATION
------------

### Install from Git or from an archive File

Extract the archive file to
a directory named `apinews` that is directly under the Web root.

CONFIGURATION
-------------

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=apinews',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
];
```

**NOTES:**
- Yii won't create the database for you, this has to be done manually before you can access it.
- Check and edit the other files in the `config/` directory to customize your application as required.


Use project migrations to create tables
and fill them with test data using console command:
```
yii migrate
```

Run yii server in local using console command:
```
php yii serve
```

REST API
-------------

Request URL in local:
```
http://localhost:8080/
```

All data that will be sent and received have to be in JSON format.

### USER actions:

Access-token for the test user 'admin' will be generated during migrations.

CREATE USER
```
Request: POST /user
```
```JSON
{
  "username": "unique:{username}",
  "password": "{password}"
}
```
```
Response:
```
```JSON
{
  "username": "{username}",
  "password": "{passwordHash}",
  "accessToken": "{accessToken}",
  "id": "int:{user_id}"
}
```

SHOW USER
```
Request: GET /user/{user_id}?access-token={accessToken}
```
```
Response:
```
```JSON
{
  "username": "{username}",
  "password": "{passwordHash}",
  "accessToken": "{accessToken}",
  "id": "int:{user_id}"
}
```

UPDATE USER
```
Request: PUT /user/{user_id}?access-token={accessToken}
```
```JSON
{
  "username": "unique:{newUsername}",
  "password": "{newPassword}"
}
```
```
Response:
```
```JSON
{
  "username": "{newUsername}",
  "password": "{newPasswordHash}",
  "accessToken": "{newAccessToken}",
  "id": "int:{user_id}"
}
```

DELETE USER
```
Request: DELETE /user/{user_id}?access-token={accessToken}
```
```
Response: empty body if correct
```


### CATEGORY actions:

SHOW all categories with their news
```
Request: GET /category
```
```
Response:
```
```JSON
[
  {
    "id": 1,
    "title": "{Category 1}",
    "description": "{Category 1 description}",
    "news": [
      {
        "id": "1",
        "title": "Category 1 News 1",
        "content": "Content for Category 1 News 1"
      },
      {
        "id": "2",
        "title": "Category 1 News 2",
        "content": "Content for Category 1 News 2"
      }
    ]
  },
  {
    "id": 2,
    "title": "{Category 2}",
    "description": "{Category 2 description}",
    "news": [
      {
        "id": "3",
        "title": "Category 1 News 3",
        "content": "Content for Category 2 News 3"
      }
    ]
  }
]
```

SHOW category and news from this category by category_id
```
Request: GET /category/{category_id}
```
```
Response:
```
```JSON
[
  {
    "id": "int:{category_id}",
    "title": "{Category title}",
    "description": "{Category description}",
    "news": [
      {
        "id": "1",
        "title": "Category news 1",
        "content": "Content for category news 1"
      },
      {
        "id": "2",
        "title": "Category news 2",
        "content": "Content for category news 2"
      }
    ]
  }
]
```

CREATE category
```
Request: POST /category/?access-token={accessToken}
```
```JSON
  {
    "title": "unique:{category title}",
    "description": "category description"
  }
```
```
Response:
```
```JSON
{
  "id": "int:{category_id}",
  "title": "{category title}",
  "description": "{Category description}",
  "news": []
}
```

UPDATE category
```
Request: PUT /category/{category_id}?access-token={accessToken}
```
```JSON
  {
    "title": "unique:{new category title}",
    "description": "new category description"
  }
```
```
Response:
```
```JSON
{
  "id": "int:{category_id}",
  "title": "{new category title}",
  "description": "{new category description}",
  "news": []
}
```

DELETE category
```
Request: DELETE /category/{category_id}?access-token={accessToken}
```
```
Response: empty body if correct
```


### NEWS actions:

SHOW all news with their categories
```
Request: GET /news
```
```
Response:
```
```JSON
[
  {
    "id": 1,
    "title": "News 1",
    "content": "Content for news 1",
    "categories": [
      {
        "id": "1",
        "title": "News 1 category 1"
      }
    ]
  },
  {
    "id": 2,
    "title": "News 2",
    "content": "Content for news 2",
    "categories": [
      {
        "id": "1",
        "title": "Category 1 for news 2"
      },
      {
        "id": "3",
        "title": "Category 2 for news 2"
      }
    ]
  }
]
```

SHOW news by news_id
```
Request: GET /news/{news_id}
```
```
Response:
```
```JSON
[
  {
    "id": 1,
    "title": "News 1",
    "content": "Content for news 1",
    "categories": [
      {
        "id": "1",
        "title": "News 1 category 1"
      }
    ]
  }
]
```

Create news
```
Request: POST /news/?access-token={accessToken}
```
```JSON
{    
    "title": "news title",
    "content": "content for news",
    "categories": "int/array:{category_ids}"    
}
```
```
Response:
```
```JSON
[
  {
    "id": "int:{news_id}",
    "title": "unique:{news title}",
    "content": "{news content}",
    "categories": [
      {
        "id": "{category_id}",
        "title": "{category title}"
      }
    ]
  }
]
```

Update news
```
Request: PUT /news/{news_id}?access-token={accessToken}
```
```JSON
{    
    "title": "changed news title",
    "content": "changed content for news",
    "categories": "int/array:{changed category_ids}"    
}
```
```
Response:
```
```JSON
[
  {
    "id": "int:{news_id}",
    "title": "unique:{changed news title}",
    "content": "{changed news content}",
    "categories": [
      {
        "id": "{category_id}",
        "title": "{category title}"
      }
    ]
  }
]
```


Delete news
```
Request: DELETE /news/{news_id}?access-token={accessToken}
```
```
Response: empty body if correct
```

### Possible errors:

404 not found. Example:
```JSON
{
    "name": "Not Found",
    "message": "Object not found: 5",
    "code": 0,
    "status": 404,
    "type": "yii\\web\\NotFoundHttpException"
}
```
403 Forbidden. Example:

```JSON
{
    "name": "Forbidden",
    "message": "Wrong access token",
    "code": 0,
    "status": 403,
    "type": "yii\\web\\ForbiddenHttpException"
}
```
400 Bad request. Example:
```JSON
{
    "name": "Bad Request",
    "message": "Invalid JSON data in request body: Syntax error",
    "code": 0,
    "status": 400,
    "type": "yii\\web\\BadRequestHttpException"
}
```
Null - wrong request.

