# CMS Orbit starter for Laravel

A Laravel website that reads its pages from [CMS Orbit](https://bifrostorbit.com/products/cms-orbit/), the headless CMS in Bifröst Orbit, with the PHP SDK `bifrost-orbit/cms-sdk`. It is the finished project from the [Laravel quickstart](https://docs.bifrostorbit.com/cms/developers/quickstart-laravel/): every published page at its own address, Blade templates for the blocks editors place, drafts in the live preview, and a signed webhook that clears cached pages when editors publish.

## Set up

1. **Create your copy.** Select **Use this template** on GitHub, or run `gh repo create my-website --template bifrost-orbit/cms-starter-laravel --private --clone`. Then run `composer install`.
2. **Add your settings.** Copy `.env.example` to `.env`, run `php artisan key:generate`, and fill in the `CMS_` settings: the API address, keys and region from **Configuration › API keys** and **Configuration › Environments** in CMS Orbit.
3. **Run it.** Run `php artisan serve` and open `http://localhost:8000`.

## What's inside

| File | What it does |
| --- | --- |
| `config/services.php`, `config/cache.php` | The `cms` settings, and a cache store of its own for CMS answers |
| `app/Providers/AppServiceProvider.php` | The CMS Orbit client, and which template draws which CMS component |
| `routes/web.php` | The webhook route and one catch-all route for every page |
| `app/Http/Controllers/PageController.php` | Reads a page or its draft: redirects, not found, gone and caching |
| `resources/views/page.blade.php` | The layout, with title, description, share tags and structured data |
| `resources/views/blocks/` | The templates: `hero`, `action`, `featureGrid` and `featureItem` |
| `app/Http/Controllers/CmsWebhookController.php` | The signed webhook that clears cached pages when editors publish |

## Make it yours

- Write your templates in `resources/views/blocks/` and register them in `app/Providers/AppServiceProvider.php`, using the component keys from your own space. **Configuration › Components** lists them.
- For the live preview, serve the website over `https` and set **Preview URL** in the space's **Settings**. For refresh on publish, add a webhook to `https://your-website/cms-webhook` and put its secret in `CMS_WEBHOOK_SECRET`. The [quickstart](https://docs.bifrostorbit.com/cms/developers/quickstart-laravel/) explains both, and how to clear only the page that changed with Redis.

Needs PHP 8.3 or later, Composer and `bifrost-orbit/cms-sdk` 0.2.

## Licence

MIT. See [LICENSE](LICENSE).
