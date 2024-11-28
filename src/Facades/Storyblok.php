<?php

namespace RalfHortt\StoryblokForLaravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \RalfHortt\StoryblokForLaravel\Storyblok
 */
class Storyblok extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \RalfHortt\StoryblokForLaravel\Storyblok::class;
    }
}
