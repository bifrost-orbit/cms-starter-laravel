<?php

namespace App\Http\Controllers;

use BifrostOrbit\Cms\BlockRenderer;
use BifrostOrbit\Cms\Client;
use BifrostOrbit\Cms\Preview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PageController extends Controller
{
    public function show(Request $request, Client $cms, BlockRenderer $blocks, ?string $path = null)
    {
        $path = '/' . $path;

        if ($request->filled('preview')) {
            $token = $cms->verifyPreviewToken($request->query('preview'));
            abort_if($token === null, 401, 'That preview link is invalid or has expired');

            return redirect(Preview::redirectPath($path, $token))
                ->withCookie(cookie('cms_preview', '1', 0, '/', null, true, true, false, 'none'));
        }

        $preview = $request->cookie('cms_preview') === '1';
        $result = $preview
            ? $cms->resolve($path, ['preview' => true])
            : Cache::store('cms')->remember('page:' . $path, 60, fn () => $cms->resolve($path));

        return match ($result['kind']) {
            'redirect' => redirect($result['to'], $result['status']),
            'gone' => abort(410),
            'notFound' => abort(404),
            'page' => response()
                ->view('page', ['page' => $result['page'], 'blocks' => $blocks, 'cms' => $cms, 'preview' => $preview])
                ->header('Cache-Control', $preview ? 'no-store' : 'public, max-age=60'),
        };
    }
}
