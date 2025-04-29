@extends('frontend.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/catalog.css')}}">
@endsection

@section('content')
<section class="section section--bg section--first">
    <div class="container mb-5" style="max-width: 1118px;">
        <div class="row col-12">
            <img src="{{asset($categoryGame->game->image)}}" style="width: 23px;height: max-content;">
            <h5 class="mb-4 ml-2 text-white">{{$categoryGame->game->name}} {{ $categoryGame->title }}</h5>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="fw-bold text-white mb-2">Select Amount</div>
                <div id="itemsContainerWrapper">
                    <div id="itemsContainer" class="row-5-1">
                        @if ($items->count() > 0)
                            @foreach ($sortedItems as $item)
                                <div class="drop-box bg-white text-dark d-flex flex-column br-10">
                                    <div class="d-flex flex-column">
                                        <img class="br-5" src="{{ asset($item->feature_image!==null ? $item->feature_image : $item->categoryGame->feature_image) }}" alt="" width="40px">
                                        @foreach ($item->attributes as $key => $attribute)
                                            @if ($attribute->topup == 1)
                                                <strong class="fs-15">@if ($key !== 0).@endif {{ $attribute->pivot->value }}</strong>
                                            @endif
                                        @endforeach
                                        <span class="small">{{ $item->title!=null ? $item->title : $item->categoryGame->title }}</span>
                                    </div>
                                    <div class="mt-3">
                                        <strong>${{ $item->price }}</strong>
                                    </div>
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
                </div>
            </div>
            <div class="col-md-4">
                {{-- change this like eldorado then give the whole page code to chatgpt and tell that i want to make it dynamic like eldorado --}}
                <div class="price-box text-black bg-white p-4 rounded text-center">
                    <p class="text-muted mb-1">Price per unit</p>
                    <h3>${{ number_format($item->price, 3) }}</h3>

                    <form method="GET" action="{{ route('checkout') }}">
                        @csrf
                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                        <input type="hidden" name="price" value="{{ $item->price }}">
                        <div class="d-flex justify-content-center align-items-center my-3">
                            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="adjustQty(-1)">-</button>
                            <input type="number" id="goldQty" name="quantity" value="1000" min="1" class="form-control mx-2 text-center" style="max-width: 80px;">
                            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="adjustQty(1)">+</button>
                        </div>

                        <small class="d-block mb-2 text-muted">Min Qty: {{ $item->min_quantity ?? '1000' }} • In Stock: {{ $item->stock ?? 'N/A' }} K</small>

                        <button type="submit" class="btn btn-dark w-100 mb-2">
                            $<span id="totalPrice">{{ number_format($item->price * 1000, 2) }}</span> | Buy now
                        </button>
                        <small class="text-muted d-block">100% Secure Payments by <strong>TradeShield</strong></small>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')

<script>
    $(document).ready(function() {
        // Apply Select2 to all select elements
        $('.select2').select2({
            dropdownPosition: 'below',
        });
        // Focus on the search input inside the Select2 dropdown
        $('select').on('select2:open', function() {
            const searchBox = $('.select2-container--open .select2-search__field');
            if (searchBox.length) {
                // Check if the search box is visible and interactable
                if (!searchBox.is(':focus')) {
                    searchBox[0].focus(); // Use [0] to directly access the DOM element
                }
            }
        });
    });

    function toggleFilters() {
        document.getElementById('filterDrawer').classList.toggle('show');
    }

    // AJAX filter function
    function applyAjaxFilters(id) {
    const f = document.getElementById(id);
    const url = f.action || location.href;
    const params = new URLSearchParams(new FormData(f)).toString();
    const overlay = document.getElementById('itemsOverlay');
    overlay.style.display = 'flex';

    fetch(`${url}?${params}`, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
        .then(res => res.text())
        .then(html => {
        const doc = new DOMParser().parseFromString(html, 'text/html');
        ['itemsContainer', 'itemCount'].forEach(id =>
            document.getElementById(id).innerHTML = doc.getElementById(id).innerHTML
        );
        })
        .finally(() => overlay.style.display = 'none');
    }

    // Apply to both desktop and phone filters
    ['desktopFilterForm', 'phoneFilterForm'].forEach(id => {
        // Search input
        document.querySelector(`#${id} input[name="search"]`)?.addEventListener('keyup', () => applyAjaxFilters(id));
        // Select2-compatible select change
        $(`#${id} select`).on('change select2:select select2:unselect', () => applyAjaxFilters(id));
    });
</script>

<script>
    // Handle pagination link click
    document.addEventListener('click', function (e) {
        const link = e.target.closest('.pagination a');
        if (link) {
            e.preventDefault();
            const url = link.getAttribute('href');
            const overlay = document.getElementById('itemsOverlay');
            overlay.style.display = 'flex';

            fetch(url, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(response => response.text())
            .then(html => {
                const doc = new DOMParser().parseFromString(html, 'text/html');
                document.getElementById('itemsContainer').innerHTML = doc.getElementById('itemsContainer').innerHTML;
                document.getElementById('itemCount').innerHTML = doc.getElementById('itemCount').innerHTML;
                window.scrollTo({ top: document.getElementById('itemsContainer').offsetTop - 100, behavior: 'smooth' });
            })
            .finally(() => {
                overlay.style.display = 'none';
            });
        }
    });
</script>

@endsection
