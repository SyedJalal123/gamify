@extends('frontend.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/catalog.css')}}">
@endsection

@section('content')
<section class="section section--bg section--first">
    <!-- MOBILE FILTER DRAWER -->
    <div id="filterDrawer" class="filter-drawer d-md-none">
        <div class="d-flex justify-content-between mx-3 mb-3 align-items-center">
            <p>Filters</p>
            <button type="button" class="btn btn-danger btn-sm" onclick="toggleFilters()">X</button>
        </div>
        <form method="GET" id="mobileFilterForm" class="mb-4 px-3">
            <input type="text" name="search" class="form-control mb-3" placeholder="Search..." value="{{ request('search') }}">
            <select name="sort" class="form-control mb-3">
                <option value="">Recommended</option>
                <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>Price (Low to High)</option>
                <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Price (High to Low)</option>
            </select>
            @foreach ($attributes as $attribute)
                <div class="mb-3">
                    <select class="form-control filter-select" name="attr_{{ $attribute->id }}">
                        <option value="">{{ $attribute->name }}</option>
                        @foreach ($attribute->options as $option)
                            <option value="{{ $option }}" {{ request("attr_{$attribute->id}") == $option ? 'selected' : '' }}>
                                {{ $option }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endforeach
            <a href="{{ route('catalog.index', [$categoryGame->id]) }}" class="btn btn-outline-light w-100">Clear Filters</a>
        </form>
    </div>

    <div class="container mb-5">
        <div class="row">
            <div class="col-12">
                <h4 class="mb-4">{{$categoryGame->game->name}} {{ $categoryGame->title }}</h4>

                <div class="d-block d-md-none mb-3">
                    <button type="button" class="btn btn-dark w-100" onclick="toggleFilters()">Filters</button>
                </div>

                <div class="d-none d-md-block mb-4">
                    <form method="GET" id="desktopFilterForm">
                        <div class="d-flex flex-wrap align-items-center gap-3 mb-3">
                            @foreach ($attributes as $attribute)
                                <div class="mr-3" style="min-width: 200px;">
                                    <select class="form-control filter-select" name="attr_{{ $attribute->id }}">
                                        <option value="">{{ $attribute->name }}</option>
                                        @foreach ($attribute->options as $option)
                                            <option value="{{ $option }}" {{ request("attr_{$attribute->id}") == $option ? 'selected' : '' }}>
                                                {{ $option }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endforeach
                            <a href="{{ route('catalog.index', [$categoryGame->id]) }}" class="btn btn-outline-light btn-sm">
                                Clear Filters
                            </a>
                        </div>

                        <div class="search-sort-wrapper">
                            <div class="search-input-wrapper">
                                <input type="text" name="search" placeholder="Search" value="{{ request('search') }}" />
                                <i class="ml-2 fas fa-search"></i>
                            </div>

                            <div class="sort-dropdown">
                                <select name="sort" class="form-control">
                                    <option value="">Recommended</option>
                                    <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>Price (Low to High)</option>
                                    <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Price (High to Low)</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-12 mb-3" id="itemCount">
                    <p><strong>{{ $items->count() }}</strong> items found</p>
                </div>

                <div class="col-12" id="itemsContainerWrapper">
                    <div id="itemsOverlay">
                        <div class="spinner-border text-light" role="status"></div>
                    </div>
                    @include('frontend._items', ['items' => $items])
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')

<script>
    function toggleFilters() {
        document.getElementById('filterDrawer').classList.toggle('show');
    }

    function applyAjaxFilters(formId) {
        const form = document.getElementById(formId);
        const url = form.getAttribute('action') || window.location.href;
        const params = new URLSearchParams(new FormData(form)).toString();
        const overlay = document.getElementById('itemsOverlay');
        overlay.style.display = 'flex';

        fetch(`${url}?${params}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => response.text())
        .then(html => {
            const doc = new DOMParser().parseFromString(html, 'text/html');
            document.getElementById('itemsContainer').innerHTML = doc.getElementById('itemsContainer').innerHTML;
            document.getElementById('itemCount').innerHTML = doc.getElementById('itemCount').innerHTML;
        })
        .finally(() => {
            overlay.style.display = 'none';
        });
    }

    document.querySelectorAll('#desktopFilterForm select, #desktopFilterForm input[name="search"]').forEach(el => {
        if (el.name === 'search') {
            el.addEventListener('keyup', () => applyAjaxFilters('desktopFilterForm')); // Keyup not Enter
        } else {
            el.addEventListener('change', () => applyAjaxFilters('desktopFilterForm'));
        }
    });

    document.querySelectorAll('#mobileFilterForm select, #mobileFilterForm input[name="search"]').forEach(el => {
        if (el.name === 'search') {
            el.addEventListener('keyup', () => applyAjaxFilters('mobileFilterForm'));
        } else {
            el.addEventListener('change', () => applyAjaxFilters('mobileFilterForm'));
        }
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
