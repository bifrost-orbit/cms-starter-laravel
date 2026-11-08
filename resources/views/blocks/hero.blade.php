@php($f = $block['fields'])
<section class="hero" data-cms-id="{{ $block['id'] }}">
    @if (!empty($f['eyebrow']))
        <p class="eyebrow">{{ $f['eyebrow'] }}</p>
    @endif
    <h1>{{ $f['heading'] ?? '' }}</h1>
    {!! $f['description'] ?? '' !!}
    <div class="actions">
        {!! $blocks->renderOne($f['primaryAction'] ?? null) !!}
        {!! $blocks->renderOne($f['secondaryAction'] ?? null) !!}
    </div>
</section>
