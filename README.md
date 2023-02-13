# Simple seo bundle for Pimcore

Seo package that allows you to complete metadata very quickly

## Installation
```
composer require lemonmind/pimcore-simple-seo-bundle
```

in the `config/bundles.php` file add
```php
return [
    // another bundles
    Lemonmind\PimcoreSimpleSeoBundle\LemonMindPimcoreSimpleSeoBundle::class => ['all' => true],
];
```

in the `config/config.yaml` file add
```yaml
lemon_mind_pimcore_simple_seo:
    thumbnail_name: 'your_thumb_name'
```

## Usage

in base template add
```html
<head>
    {{ leogout_seo() }}
</head>
```

### Document
Just complete the fields in the SEO section and create (optional) a custom property named **meta_tag_image** with the asset for the document
![](docs/img/meta-tag-image-property.png)


in `controller` add
```php
public function defaultAction(DocumentSeoMetaGenerator $seoMetaGenerator): Response
{
    $seoMetaGenerator->generate($this->document);

    return $this->render('default/default.html.twig');
}
```

### Object
An interface should be added to the object definition `\Lemonmind\PimcoreSimpleSeoBundle\Model\ObjectSeoInterface`
![](docs/img/implements-interface.png)

Then, according to the interface(`\Lemonmind\PimcoreSimpleSeoBundle\Model\ObjectSeoInterface`), create the necessary fields

![](docs/img/object-definition.png)
 
- seoTitle (text->input)
- seoDescription (text->textarea)
- seoKeywords (text->input)
- seoImage (media->image)


in controller
```php
public function seoObjectAction(ObjectSeoMetaGenerator $seoMetaGenerator): Response
{
    /**
     * @var ObjectSeoInterface $test
     */
    $test = Test::getById(1);
    $url = 'absolute url to this object';

    $seoMetaGenerator->generate($test, $url);

    return $this->render('default/default.html.twig');
}
```