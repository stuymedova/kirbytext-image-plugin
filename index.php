<?php

Kirby::plugin('stuymedova/image', [
  'tags' => [
    'image' => [
      'attr' => [
        'alt',
        'caption',
        'class',
        'height',
        'imgclass',
        'link',
        'linkclass',
        'rel',
        'target',
        'title',
        'width'
      ],
      'html' => function($tag) {

        if ($tag->file = $tag->file($tag->value)) {

          $tag->src     = $tag->file->url();
          $tag->alt     = $tag->alt     ?? $tag->file->alt()->or(' ')->value();
          $tag->title   = $tag->title   ?? $tag->file->title()->value();
          $tag->caption = $tag->caption ?? $tag->file->caption()->value();
          $tag->ratio   = $tag->file->ratio();

          $html = 
            '<figure class="responsive-image">
                <div class="placeholder" style="padding-bottom:'. number_format(100 / $tag->ratio(), 5, ".", "") .'%"></div>
                <img class="lazy lazyload ' . $tag->class . '" data-sizes="auto"
                    data-src="' . $tag->file->url() . '"
                    data-srcset="' . $tag->file->srcset([400, 800, 1020, 2040]) . '" 
                    alt="' . $tag->alt . '"
                    width="100%" height="auto">
                <noscript>
                  <img src="' . $tag->file->url() . '" alt="' . $tag->alt . '" width="100%" height="auto" />
                </noscript>
                <figcaption>'. kt($tag->caption) . '</figcaption>
            </figure>';

          $html = str_replace(array('\r', '\n'), '', $html);
          return $html;
          
        } else {
          $tag->src = Url::to($tag->value);
        }
      },
    ],
  ],
]);
