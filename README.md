# php-easytag
Tag Creator for Php.  

It is an easy markup tag creation tool with PHP. You can use helper methods with the **Tag** object and build it whenever you want. If you wish, you can have your tag build instantly by using the **TagBuild** extended class.

For self closing elements in html tags, I defined self closing tags in an extended **HtmlTag** class and provided instant rendering with the use of TagBuilder.

# Usage

#### Tag Object

* **Init**
```php 
$tag = new Tag(string $name);
```
* **Fast Init**
```php 
Tag::@tagname(array|string|Tag $element) : Tag
```

* **Element Methods**
```php 
$tag->setElements(array<Tag|String> $elements);
```
```php 
$tag->appendElement(Tag|String $elements);
```
```php 
$tag->prependElement(Tag|String $elements);
```

* **Attribute Methods**
```php 
$tag->setAttrs(array<[key,value]> $attrs);
```
```php 
$tag->addAttr(string $attr, string $value);
```
```php 
$tag->removeAttr(string $attr);
```

* **Build methods**

```php 
$tag->setSelfClosing(bool $isPaired = TRUE);
```
```php 
$tag->build(): string
```
```php 
$tag->render(): void
```




#### Fast Tag Builder
```php 
TagBuild::@tagname(array|string|Tag $element) : string
```
#### Html Tag Builder

```php 
HtmlTag::@tagname(array|string|Tag $element) : string
```
or with attributes

```php 
HtmlTag::@tagname(array $attrs, array|string|Tag $element) : string
```

# Features
* All methods can be chained.
* Tag Object have static method for fast tag init. Just call static method with your tag name. return type Tag
* HtmlTag and TagBuild are abstract class and just call static method with your tag name. Elements builds at runtime and only string returns.
* Tag Object and TagBuild fast init feature can take array ,string and tag objects. If you don't like using arrays, you can add infinite parameters of tag or string type and the class defines these parameters as elements.
* When using Tag Object fast init or using TagBuild, if the first parameter is array[key=> value] the class will automatically define attributes.
* In version 1.0.0, all outputs go through the beautify process. This feature currently does not have any settings.

# Examples

#### Object Example

```php
$data = [
	[
		'price' => '15.95',
		'name' => 'Cap',
		'code' => 'C1234'
	],
	[
		'price' => '23.95',
		'name' => 'Tshirt',
		'code' => 'T1534',
	]
];


$products = new Tag('products');
$products->addAttr('last-date','17.08.2021');

foreach ($data as $product_detail){
	$product = new Tag('product');

	foreach ($product_detail as $key => $value){
		$product->appendElement((new Tag($key))->appendElement($value));
	}

	$products->appendElement($product);
}

$products->render();
```
* Output
``` xml
<products last-date="17.08.2021">
	<product>
		<price>15.95</price>
		<name>Cap</name>
		<code>C1234</code>
	</product>
	<product>
		<price>23.95</price>
		<name>Tshirt</name>
		<code>T1534</code>
	</product>
</products>
```

#### Fast Render Example

``` PHP
echo TagBuild::config(
	TagBuild::server('localhost'),
	TagBuild::port('8080'),
	TagBuild::db('tagV1'),
	TagBuild::user('root'),
	TagBuild::pass('toor'),
);
```
* OUTPUT

```XML
<config>
	<server>localhost</server>
	<port>8080</port>
	<db>tagV1</db>
	<user>root</user>
	<pass>toor</pass>
</config>
```

#### Easy Html for self closing tags

``` PHP
echo HtmlTag::html(
	HtmlTag::head(
		HtmlTag::title('Html Example'),
		HtmlTag::meta(['author' => 'emreuyguc']),
		HtmlTag::link(['rel' => 'stylesheet','href' => 'your.css']),
	),
	HtmlTag::body(
		HtmlTag::div(['class' => 'content'],'hello',' world'),
		HtmlTag::script(['src' => 'your.js'])
	)
);
```

* OUTPUT

``` html
<html>
	<head>
		<title>Html Example</title>
		<meta author="emreuyguc" />
		<link rel="stylesheet" href="your.css" />
	</head>
	<body>
		<div class="content">hello world</div>
		<script src="your.js"></script>
	</body>
</html>
```

