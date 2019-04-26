[Edited] LeadCommerce Shopware SDK
-----------------

Edited PHP SDK for the Shopware 5 REST API.

This repository forked from leadcommerce/shopware-sdk and some arrangements have been made to make it available.

## What does this library offer extra as opposed to the original?

- Fixed Bugs (eg. create entity methods exceptions, not found error etc.)
- Edited Lacking Features (eg. Order Entity, methods params)
- Improve Querying (eg. Filter Params)

## Main Differences

- **Querying Responses** ``Query\Base`` class. Query classes don't return a mapped entity from response anymore. They return itself.
In order to get mapped entity like original library you can use ``getEntity()``. Also you have 3 options more now :)
    1. ``getEntity()`` Entity class of query. Returns mapped entity from json response.
    2. ``getEntities()`` Array of entity classes of query. Returns mapped entities from json response.
    3. ``getRawResponse()`` Raw string response returned from shopware rest api. 
    3. ``getArrayResponse()`` Json decoded Assosicative Array of raw json response returned from shopware rest api. 

- **NotValidApiResponseException** createEntityFromResponse method decodes the json response and resume own logic. 
If you query the order that not exist or if shopware rest api returns an any error (not json), program will have been failed. 
But you can catch this error now. If json decode process has error, thie exception is throwed.

## Installing

~~composer require leadcommerce/shopware-sdk~~
```bash
composer require erkineren/shopware-sdk
```

## Examples
```php
<?php
    require 'vendor/autoload.php';
    
    // Create a new client
    $client = new ShopwareClient('http://shopware.dev/api/', 'user', 'api_key');

    /**
     * set custom options for guzzle
     * the official guzzle documentation contains a list of valid options (http://docs.guzzlephp.org/en/latest/request-options.html) 
     */  
    //$client = new ShopwareClient('http://shopware.dev/api/', 'user', 'api_key', ['cert' => ['/path/server.pem']]);
    
    // Fetch all articles
    $articles = $client->getArticleQuery()->findAll();
    
    // NEW FEATURE Fetch all articles with filters
    $articles = $client->getArticleQuery()->findAll(
        [
            'filter' => [
                [
                    'property' => 'number',
                    'value' => 'SW0001'
                ]
            ]
        ]
    );
    
    // Fetch one article by id
    $article = $client->getArticleQuery()->findOne(1);
    
    // NEW FEATURE Fetch one article by articlenumber
    $article = $client->getArticleQuery()->findOne('SW0001', true);
    
    // Create an article
    $article = new Article();
    $article->setName("John product doe");
    $article->setDescription("Lorem ipsum");
    // ... <- more setters are required
    $client->getArticleQuery()->create($article);
   
    
    // Update article
    $article->setName("John product doe");
    $updatedArticle = $client->getArticleQuery()->update($article)->getEntity();
    
    // Update multiple articles
    $articleOne = $client->getArticleQuery()->findOne(1)->getEntity();
    $articleOne->setName("John product doe");
    $articleTwo = $client->getArticleQuery()->findOne(2)->getEntity();
    $articleTwo->setName("John product doe 2");
        
    $articles = $client->getArticleQuery()->updateBatch([$articleOne, $articleTwo])->getArrayResponse();
    
    // Delete an article
    $client->getArticleQuery()->delete(1);
    
    // Delete multiple articles at once
    $client->getArticleQuery()->deleteBatch([1, 2, 3]);
?>
```

## Issues/Features proposals

[Here](https://github.com/LeadCommerceDE/shopware-sdk/issues) is the issue tracker.

## Contributing :-)

* Read the [Code of Conduct](CODE_OF_CONDUCT.md)
* Write some code
* Write some tests

## License

[MIT](MIT-LICENSE)

## Authors

- [Alexander Mahrt](https://github.com/cyruxx)
- [Jochen Niebuhr](https://github.com/jniebuhr)
- [Erkin Eren](https://github.com/erkineren)
