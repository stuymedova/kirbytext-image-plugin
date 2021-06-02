# Kirby Image Plugin

Prevents reflow, adds lazy loading (requires [lazysizes](https://www.npmjs.com/package/lazysizes)) and `srcset` to each image added with the `(image: …)` tag. Default width is 100%, height set to "auto". Overrides the `(image: …)` KirbyTag located in `kirby/config/tags.php`.

More info on overriding the default tags: [getkirby.com/docs/reference/plugins/extensions/kirbytags#overriding-default-kirbytags](https://getkirby.com/docs/reference/plugins/extensions/kirbytags#overriding-default-kirbytags).

## Output

```html
<div class="responsive-image">
  <div class="placeholder" style="padding-bottom: 100%"></div>
  <img class="lazy lazyautosizes lazyloaded" data-sizes="auto" data-src="http://example.test/image.jpg" data-srcset="http://example.test/image-400x.jpg 400w, http://example.test/image-800x.jpg 800w, http://example.test/image-1020x.jpg 1020w, http://example.test/image-2040x.jpg 2040w" alt="Image" width="100%" height="auto" sizes="377px" srcset="http://example.test/image-400x.jpg 400w, http://example.test/image-800x.jpg 800w, http://example.test/image-1020x.jpg 1020w, http://example.test/image-2040x.jpg 2040w" src="http://example.test/image.jpg">
  <noscript>
    <img src='http://example.test/image.jpg' alt='Image' width='100%' height='auto'>
  </noscript>
</div>
```

## Setup
1. Put the `image` folder in `site/plugins`, such as:
```
site
└── plugins
    └── image
        └── index.php
```

2. Add [lazysizes](https://www.npmjs.com/package/lazysizes) to your project

## Use in a template

```php
<div class='responsive-image'>
  <div class='placeholder' style='padding-bottom: <?= number_format(100 / $page->image()->ratio(), 5, '.', '') ?>%'></div>
  <img class='lazy lazyload' data-sizes='auto'
      data-src='<?= $page->image()->url() ?>'
      data-srcset='<?= $page->image()->srcset([400, 800, 1020, 2040]) ?>'
      alt='<?= $page->title()->html() ?>'
      width='100%' height='auto'/>
  <noscript>
    <img src='<?= $page->image()->url() ?>' alt='<?= $page->title()->html() ?>' width='100%' height='auto' />
  </noscript>
</div>
```
