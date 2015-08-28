Yii 2 Neo4j Extension Template
================================

This project is a template with some examples, how to use the boehsermoe/yii2-neo4j extension.
The extension make it easily to use Yii2 models with Neo4j database.
The project structure based on the Yii 2 Basic Template.

**Please note that this extension is currently just a experimental project.**

INSTALLATION
------------

### Clone from github

~~~
git clone git@github.com:boehsermoe/neo.git && cd neo && composer install
~~~

Maybe you need to adjust your directory permissions.

~~~
chmod -R 777 runtime/
chmod -R 777 web/
~~~

Now you should be able to access the application through the following URL, assuming `neo` is the directory
directly under the Web root.

~~~
http://localhost/basic/web/
~~~

CONFIGURATION
-------------

Now you have to configure your database connection.

**NOTE:**
The extension won't create the database for you, this has to be done manually before you can access it.
See here for more information http://neo4j.com/developer/get-started/

### index.php

You have to disable E_STRICT error reporting in the `index.php`:

```php
error_reporting(E_ALL ^ E_STRICT);
```


### Database

Required following class in the file `config/db.php`:

```php
return [
    'class' => '\neo4j\db\Connection',
];
```

You can edit it with real data, for example:

```php
return [
    'class' => '\neo4j\db\Connection',
    'host' => 'localhost', // Default
    'port' => 7474, // Default
    'username' => 'neo4j', // Default
    'password' => 'neo', // Default
];
```

Is your Neo4j Server running and available?

~~~
http://localhost:7474
~~~


Guide
-------------

### Models

The `models/User.php` and `models/UserDetail.php` are the schema for the database nodes.
A database node is mirrored by a Model. The class name is the node label. Each class property in the model is a node property in the database.

In the model will be declared, how it is related to other models.
A relationship consist of a the other `model class`, a `label` of the relationship and the `direction`.

~~~
public function getDetails()
{
	return $this->hasMany(UserDetail::className(), ['HAS'], ActiveQuery::DIRECTION_OUT);
}
~~~

With implementations the extension can link one model to another.

*More coming soon...*


### Console Examples

The examples are located in `commands/CypherController.php`, there you can experiment with the Neo4j-ActiveRecord.

1. Step: Create a User *./yii cypher/create Neo 30*
2. Step: Find the created User *./yii cypher/find Neo*
3. Step: Delete the created User *./yii cypher/delete-user Neo*

For more information:
~~~
./yii help cypher
~~~

*More coming soon...*