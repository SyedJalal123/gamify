
<div class="row" id="itemsContainer">
    @if ($items->count() > 0)
        @foreach ($items as $item)
            <div class="col-md-4 col-12">
                <a href="{{ route('item.detail', $item->id) }}" class="text-dark text-decoration-none">
                    <div class="drop-box bg-white text-dark m-2">
                        <p>
                            @foreach ($item->attributes as $key => $attribute)
                                @if ($attribute->applies_to == 1)
                                    <strong>@if ($key !== 0).@endif {{ $attribute->pivot->value }}</strong>
                                @endif
                            @endforeach
                        </p>
                        <div class="d-flex justify-content-between mb-4">
                            <p>{{ $item->title }}</p>
                            <div class="mb-2 d-flex flex-column align-items-end">
                                <img src="{{ asset($item->feature_image) }}" alt="" width="70px">
                            </div>
                        </div>
                        <p class="m-0">
                            <strong>${{ $item->price }}</strong>
                        </p>
                    </div>
                </a>
            </div>
        @endforeach
    @else
        <div class="col-12 text-center text-muted py-5">
            <h5>No results found.</h5>
        </div>
    @endif

    @if ($items->hasPages())
        <div class="col-12 d-flex justify-content-center mt-4">
            {!! $items->links('pagination::bootstrap-4') !!}
        </div>
    @endif
</div>
