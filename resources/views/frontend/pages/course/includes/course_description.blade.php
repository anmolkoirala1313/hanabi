<div class="tab {{ $row->description ? '': ($loop->first ? 'active-tab':'') }}" id="tab-{{$index}}">
    <div class="text">
        <h3 class="product-description__title">{{ $detail->title }}</h3>
        <div class="product-description__text1 custom-description">{!! $detail->description ?? '' !!}</div>
    </div>
</div>
