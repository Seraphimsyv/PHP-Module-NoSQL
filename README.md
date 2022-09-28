<h1 align="center">PHP Module NoSQL</h1>

<h2 align="center">Usage</h2>

### Collections
---

#### Get collection
````
$obj = new \NoSQL\Classes\SQL_Manager("@file_name@.json");
$collection = $obj->collections("@collection_name@");
````
#### Create collection
````
$obj = new \NoSQL\Classes\SQL_Manager("@file_name@.json");
$collection = $obj->create_collection("@collection_name@");
````

#### Delete collection
````
$obj = new \NoSQL\Classes\SQL_Manager("@file_name@.json");
$obj->delete_collection("@collection_name@");
````

#### Saving collections
````
$obj = new \NoSQL\Classes\SQL_Manager("@file_name@.json");
/**
	* Code block
	*/
$obj->save();
````

#### Getting documents
<p>
Requests for obtaining documents are made in the format of a nested list
</p>

````
$query_title = ["title", "==", "Test title"];
$query_category = ["category", "==", "Test category" ];
````

`````
$obj = new \NoSQL\Classes\SQL_Manager("@file_name@.json");
$collection = $obj->collections("@collection_name@");
/**
	* Many documents
	*/
$result = $collection->getAll([$query_title, query_category]);
/**
	* One document
	*/
$result = $collection->getOne([$query_title, query_category]);
`````

### Documents
---

#### Get field
````
$obj = new \NoSQL\Classes\SQL_Manager("@file_name@.json");
$collection = $obj->collections("@collection_name@");
$query = ["title", "==", "Test title"];
$document = $collection->getOne([$query]);
$title = $document->title;
````

#### Set field
````
$obj = new \NoSQL\Classes\SQL_Manager("@file_name@.json");
$collection = $obj->collections("@collection_name@");
$query = ["title", "==", "Test title"];
$document = $collection->getOne([$query]);
$content = "some text";
$document->@some_new_fild@ = $content;
````

#### Delete field
````
$obj = new \NoSQL\Classes\SQL_Manager("@file_name@.json");
$collection = $obj->collections("@collection_name@");
$query = ["title", "==", "Test title"];
$document = $collection->getOne([$query]);
$document->delete("title");
````