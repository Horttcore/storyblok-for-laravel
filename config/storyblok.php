<?php

// config for RalfHortt/StoryblokForLaravel
return [
    'space_id' => env('STORYBLOK_SPACE_ID'),
    'token' => env('STORYBLOK_API_KEY'),
    'region' => env('STORYBLOK_API_REGION', 'EU'),
    'resolve_relations' => [
        'featured-articles-section.articles',
        'article-page.categories',
        'article-page.author',
        'banner-reference.banners'
    ]
];
