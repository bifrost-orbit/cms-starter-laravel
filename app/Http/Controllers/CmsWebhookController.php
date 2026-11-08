<?php

namespace App\Http\Controllers;

use BifrostOrbit\Cms\Webhook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CmsWebhookController extends Controller
{
    public function __invoke(Request $request)
    {
        $message = Webhook::parse(config('services.cms.webhook_secret'), $request->headers->all(), $request->getContent());

        if ($message === null) {
            return response()->noContent(401);
        }

        if (Webhook::tagsForEvent($message['event'], $message['data']) !== []) {
            Cache::store('cms')->flush();
        }

        return response()->noContent();
    }
}
