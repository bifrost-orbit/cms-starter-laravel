@php($f = $block['fields'])
<article data-cms-id="{{ $block['id'] }}">
    <h3>{{ $f['title'] ?? '' }}</h3>
    <p>{{ $f['body'] ?? '' }}</p>
    @if (!empty($f['link']['href']))
        <a href="{{ $f['link']['href'] }}">Read more</a>
    @endif
</article>
