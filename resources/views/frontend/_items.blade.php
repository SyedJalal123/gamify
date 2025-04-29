
<div id="itemsContainer" class="row-3-2-1">
    @if ($items->count() > 0)
        @foreach ($items as $item)
            <div>
                <a href="{{ route('item.detail', $item->id) }}" class="text-dark text-decoration-none">
                    <div class="drop-box bg-white text-dark">
                        <p>
                            @foreach ($item->attributes as $key => $attribute)
                                @if ($attribute->applies_to == 1)
                                    <strong>@if ($key !== 0).@endif {{ $attribute->pivot->value }}</strong>
                                @endif
                            @endforeach
                        </p>
                        <div class="d-flex justify-content-between mb-4 fs-14 text-muted">
                            <p class="two-line-ellipsis lh-1_2">{{ $item->title!=null ? $item->title : $item->categoryGame->title }}</p>
                            <div class="mb-2 d-flex flex-column align-items-end">
                                <img src="{{ asset($item->feature_image!==null ? $item->feature_image : $item->categoryGame->feature_image) }}" alt="" width="50px">
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
