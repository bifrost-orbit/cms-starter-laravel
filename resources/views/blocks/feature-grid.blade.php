@php($f = $block['fields'])
<section class="feature-grid" data-cms-id="{{ $block['id'] }}">
    <h2>{{ $f['heading'] ?? '' }}</h2>
    @if (!empty($f['intro']))
        <p>{{ $f['intro'] }}</p>
    @endif
    <div class="grid">
        {!! $blocks->slot($block, 'items') !!}
    </div>
</section>
