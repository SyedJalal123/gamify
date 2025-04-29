@if ($sortedItems->count() > 0)
    @php $i = 0; @endphp
    @foreach ($sortedItems as $key => $item)
        @php $i++ @endphp
        @foreach ($item->attributes as $attribute)
            @php if($attribute->topup == 1) {$topup_value = $attribute->pivot->value;} @endphp
        @endforeach
        <div class="drop-box bg-white text-dark d-flex flex-column br-10 item-select cursor-pointer topup_boxes @if($i==1) topup_active @endif" data-id="{{ $item->id }}">
                <div class="d-flex flex-column">
                    <img class="br-5"
                        src="{{ asset($item->feature_image !== null ? $item->feature_image : $item->categoryGame->feature_image) }}" width="40px">
                    
                    <strong class="fs-15">{{$topup_value}}</strong>
                    <span class="small">{{ $item->title != null ? $item->title : $item->categoryGame->title }}</span>
                </div>
                <div class="mt-3">
                    <strong>${{ number_format($item->price * $topup_value, 2) }}</strong>
                </div>
        </div>
    @endforeach
@else
    <div class="col-12 text-center text-muted py-5">
        <h5 class="no-data">No results found.</h5>
    </div>
@endif