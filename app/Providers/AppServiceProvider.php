<?php

namespace App\Providers;

use BifrostOrbit\Cms\BlockRenderer;
use BifrostOrbit\Cms\Client;
use Closure;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Client::class, fn () => new Client(
            apiKey: config('services.cms.key'),
            baseUrl: config('services.cms.url'),
            previewKey: config('services.cms.preview_key'),
            defaultRegion: config('services.cms.region'),
        ));

        $this->app->singleton(BlockRenderer::class, fn () => new BlockRenderer(
            [
                'hero' => self::template('blocks.hero'),
                'featureGrid' => self::template('blocks.feature-grid'),
                'featureItem' => self::template('blocks.feature-item'),
                'action' => self::template('blocks.action'),
            ],
            fn (array $block) => view('blocks.unknown', ['block' => $block])->render(),
        ));
    }

    private static function template(string $view): Closure
    {
        return fn (array $block, BlockRenderer $blocks) => view($view, ['block' => $block, 'blocks' => $blocks])->render();
    }
}
