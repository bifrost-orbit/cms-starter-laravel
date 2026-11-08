@use('BifrostOrbit\Cms\Preview')
@use('BifrostOrbit\Cms\Seo')
<!DOCTYPE html>
<html lang="{{ $page['locale'] }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {!! Seo::headTags($page) !!}
    {!! Seo::jsonLd($page) !!}
</head>
<body>
    <main>
        {!! $blocks->render($page['components']) !!}
    </main>
    @if ($preview)
        {!! Preview::bridgeScript($cms) !!}
    @endif
</body>
</html>
