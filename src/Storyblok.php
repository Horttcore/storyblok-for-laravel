<?php

namespace RalfHortt\StoryblokForLaravel;

use Illuminate\Support\Collection;
use Storyblok\ApiException;
use Storyblok\Client;

class Storyblok
{
    protected Client $client;

    protected Collection $settings;

    protected string $path;

    protected Collection $response;

    /**
     * @throws ApiException
     */
    public function __construct()
    {
        $this->client = new Client(config('storyblok.token'));
        $this->client->resolveRelations(collect(config('storyblok.resolve_relations'))->implode(','));
        $this->loadSettings();
    }

    public function getStories($params = []): array
    {
        $request = $this->client->getStories($params)->getBody();

        return [
            collect($request)->get('stories'),
            collect($request)->except('stories'),
        ];
    }

    /**
     * @throws ApiException
     */
    public function get(?string $path = null): Collection
    {
        $this->path = $path ?? request()->path();

        // Implementieren Sie hier die Logik, um eine Story von Storyblok abzurufen
        $this->response = collect($this->client->getStoryBySlug($this->path)->getBody());

        return collect($this->response->get('story'));
    }

    /**
     * @throws ApiException
     */
    public function all(array $params = []): Collection
    {
        [$stories] = $this->getStories($params);
        return collect($stories);
    }

    /**
     * @throws ApiException
     */
    public function blok(?string $path = null): Collection
    {
        if ($this->path === $path) {
            return collect($this->response->get('story')['content']);
        }

        $story = $this->get($path);

        return collect($story->get('content'));
    }

    /**
     * @throws ApiException
     */
    private function loadSettings(): void
    {
        $this->settings = $this->get('site-config');
    }

    public function settings(): Collection
    {
        return $this->settings;
    }

    public function setting(string $key): Collection
    {
        return $this->settings()->get($key);
    }
}
