@extends('frontend.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/catalog.css') }}">
    <style>
        section {
            font-size: 14px;
        }
        .select2-container--default .select2-selection--single {
            height: 39px !important;
            font-size: 14px;
        }
    </style>
@endsection

@section('content')
    <section class="section section--bg section--first">
        <div class="container mb-5" style="max-width: 1118px;">
            <div class="row col-12">
                <img src="{{ asset($categoryGame->game->image) }}" style="width: 23px;height: max-content;">
                <h5 class="mb-4 ml-2 text-white">{{ $categoryGame->game->name }} {{ $categoryGame->title }}</h5>
            </div>
            <div class="row">
                <div class="col-md-8">
                    @if(($sortedItems->first() !== null) && count($sortedItems->first()->attributes->where('topup', 0)) > 0)
                        <span class="circle-1">1</span>
                        <form id="attributeFilterForm" class="bg-light-dark br-10 p-3 pt-4 my-3 mb-4 attributes">
                            @foreach ($sortedItems->first()->attributes->where('topup', 0) as $attribute)
                                @php
                                    $options = $attribute->options;
                                    $selected = request("attr_{$attribute->id}");
                                @endphp
                                <div class="form-group select-2-dark">
                                    <h6 class="fw-bold text-white mb-3">Select {{ $attribute->name }}</h6>
                                    <select name="attr_{{ $attribute->id }}" id="attr_{{ $attribute->id }}" class="form-control select2 attribute-filter">
                                        <option value="" disabled selected>-- Select {{ $attribute->name }} --</option>
                                        @foreach($options as $option)
                                            <option value="{{$option}}">
                                                {{$option}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endforeach
                        </form>
                    @endif
                    <div class="fw-bold text-white mb-2 d-flex align-items-center">
                        @if(($sortedItems->first() !== null) && count($sortedItems->first()->attributes->where('topup', 0)) > 0)
                        <span class="circle-2 mr-2">2</span>
                        @endif
                        @if($sortedItems->first() !== null) <span>Select Amount</span> @endif
                    </div>
                    <div id="itemsContainerWrapper">
                        <div id="itemsContainer" class="row-5-1">
                            @include('frontend.catalog.topup-items', ['sortedItems' => $sortedItems])
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <form class="price-box-form d-none" method="GET" action="{{ route('checkout') }}">
                        <input type="hidden" id="item_id" name="item_id" value="">
                        <input type="hidden" id="item_price" name="price" value="">

                        <div class="price-box text-black bg-white br-9 mt-4 mt-md-0">
                            @csrf
                            <div class="d-flex align-items-center px-4 py-3 border-bottom-1-light">
                                <img id="itemImage" src="{{ asset('uploads/games/v-bucks.png') }}" class="br-5" width="34px"
                                    alt="">
                                <div id="itemTitle" class="ml-2 fs-14 fw-bold">1000 V-Bucks</div>
                            </div>
                            <div class="d-flex justify-content-between px-4 p-2 border-bottom-1-light delivery_time_section">
                                <span class="text-black-70">Delivery time</span>
                                <span id="deliveryTime" class="fw-bold">20 min</span>
                            </div>
                            <div class="d-flex justify-content-end px-4 pt-4 price_section">
                                <h5 class="fw-bold">Total: $<span id="totalPrice" id="totalPrice">7.15</span></h5>
                            </div>
                            <div class="d-flex flex-column px-4 p-2">
                                <button type="button" onclick="form_check()" class="btn btn-dark w-100 mb-2">
                                    $<span id="buyNowPrice">7.15 |</span>  Buy now
                                </button>
                                <div class="d-flex flex-column border-top-1-dashed mt-3 pt-2">
                                    <div class="d-flex align-items-center mb-1">
                                        <i class="text-primary bi bi-shield-check"></i>
                                        <span class="ml-2 small">Money-back Guarantee</span>
                                        <span class="ml-2 small text-black-70">Protected by TrustShield</span>
                                    </div>
                                    <div class="d-flex align-items-center mb-1">
                                        <i class="text-primary bi bi-currency-dollar"></i>
                                        <span class="ml-2 small">Purchase Rewards</span>
                                        <span class="ml-2 small text-black-70">Earn Points, Pay Less!</span>
                                    </div>
                                    <div class="d-flex align-items-center mb-1">
                                        <i class="text-primary bi bi-tag"></i>
                                        <span class="ml-2 small">Low Prices</span>
                                        <span class="ml-2 small text-black-70">Unmatched Deals!</span>
                                    </div>
                                    <div class="d-flex align-items-center mb-1">
                                        <i class="text-primary bi bi-lightning-charge"></i>
                                        <span class="ml-2 small">Fast & Secure Checkout</span>
                                        <span class="ml-2 small text-black-70">Multiple Secured Options</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="price-box price-box-2 text-black bg-white br-9 mt-2">
                            <div class="border-bottom d-flex flex-column p-3 px-3">
                                <div class="fw-bold">Delivery instructions</div>
                                <div id="deliveryInstructions" class="text-black-70 fs-13 mt-2 lh-1_3">
                                    Log in Top up  (epic email account and password required) Users 
                                    who play games with PS and Xbox need to prepare a new epic account 
                                    for me(Not connected to any Xbox or PS),PC players do not need to 
                                    prepare a new account
                                </div>
                            </div>
                            <div class="d-flex flex-column px-3 pb-3 pt-2">
                                <div class="text-black-70">Seller</div>
                                <div class="d-flex pt-2">
                                    <div class="seller-avatar mr-2 d-flex align-items-center justify-content-center rounded-circle text-white" style="width: 40px; height: 40px; background-color: #c0392b;">
                                        S
                                    </div>
                                    <div class="d-flex flex-column">
                                        <div id="sellerName" class="small fw-bold">trumpgold</div>
                                        <div class="d-flex align-items-center">
                                            <i class="text-success bi bi-star-fill"></i>
                                            <span class="text-black-70 mx-1 fs-13">99.3%</span>
                                            <a href="#">27,066 reviews</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#attributeFilterForm').on('change', '.attribute-filter', function () {
                
                // Animate the price box
                const priceBoxForm = document.querySelector('#itemsContainerWrapper');
                const overlay = document.createElement('div');
                overlay.classList.add('price-overlay');
                priceBoxForm.appendChild(overlay);
                overlay.style.opacity = '1';
                setTimeout(() => {
                    overlay.style.opacity = '0';
                    setTimeout(() => overlay.remove(), 300);
                }, 1000);

                let url = new URL(window.location.href);

                // Clear all previous attribute-related query params
                $('#attributeFilterForm .attribute-filter').each(function () {
                    const key = $(this).attr('name');
                    url.searchParams.delete(key); // Remove old value
                    const val = $(this).val();
                    if (val) {
                        url.searchParams.set(key, val);
                    }
                });

                // Load new filtered content
                $.ajax({
                    url: url.toString(),
                    method: 'GET',
                    success: function (response) {
                        $('#itemsContainer').html(response); // Replace item list

                        if ($('.no-data').length > 0) {
                            $('.price-box-2').removeClass('d-none');
                            $('.delivery_time_section').addClass('d-none');
                            $('.price_section').addClass('d-none');
                            $('#buyNowPrice').addClass('d-none');
                        } else {
                            change_price_box_values();
                            $('.topup_active').click();
                        }
                    },
                    error: function () {
                        alert('Something went wrong.');
                    }
                });
            });
        });

        function form_check(){
            var valid = true;
            var s = $('.attributes select');

            for (i = 0; i < s.length; i++) {
                // If a field is empty...

                if (s[i].value == "") {
                    $('#'+s[i].id).next('.select2-container').find('.select2-selection').css('border', '1px solid red');
                    valid = false;
                }else {
                    $('#'+s[i].id).next('.select2-container').find('.select2-selection').css('border', '1px solid #aaaaaa');
                }
            }
            if($('.price_section').hasClass('d-none')){
                valid = false
            }
            
            if(valid == true){
                document.getElementById("loadingScreen").style.display = "flex";
                $('.price-box-form').submit();
            }
        }
        function change_price_box_values() {      
            document.querySelectorAll('.item-select').forEach(function (item) {
                item.addEventListener('click', function () {
                    const id = this.dataset.id;

                    // Toggle topup_active
                    document.querySelectorAll('.item-select').forEach(function (i) {
                        i.classList.remove('topup_active');
                    });
                    this.classList.add('topup_active');

                    // Animate the price box
                    const priceBoxForm = document.querySelector('.price-box-form');
                    const overlay = document.createElement('div');
                    overlay.classList.add('price-overlay');
                    priceBoxForm.appendChild(overlay);
                    overlay.style.opacity = '1';
                    setTimeout(function () {
                        overlay.style.opacity = '0';
                        setTimeout(function () {
                            overlay.remove();
                        }, 300);
                    }, 1000);

                    // AJAX fetch by item ID
                    fetch(`/get-item-details/${id}`)
                        .then(function (res) {
                            return res.json();
                        })
                        .then(function (data) {
                            if (data.success) {
                                const item = data.item;

                                document.querySelector('#itemTitle').textContent = item.title;
                                document.querySelector('#itemImage').src = item.image;
                                document.querySelector('#deliveryTime').textContent = item.delivery_time;
                                document.querySelector('#totalPrice').textContent = item.price;
                                document.querySelector('#buyNowPrice').textContent = item.price;
                                document.querySelector('#deliveryInstructions').textContent = item.description;
                                document.querySelector('#sellerName').textContent = item.seller;

                                if ($('.attributes').children().length === 0 || ($('.attributes').children().length !== 0 && ($('.select2').first().val() !== null))) {
                                    $('.price-box-2').removeClass('d-none');
                                    $('.delivery_time_section').removeClass('d-none');
                                    $('.price_section').removeClass('d-none');
                                    $('#buyNowPrice').removeClass('d-none');
                                } else {
                                    $('.price-box-2').addClass('d-none');
                                    $('.delivery_time_section').addClass('d-none');
                                    $('.price_section').addClass('d-none');
                                    $('#buyNowPrice').addClass('d-none');
                                }
                                
                                $('.price-box-form').removeClass('d-none');
                                $('#item_id').val(item.id);
                                $('#item_price').val(item.price);
                            }
                        });
                });
            });
        }
        
        $(document).ready(function() {
            change_price_box_values();
            $('.topup_active').click();
            
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

            fetch(`${url}?${params}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
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
            document.querySelector(`#${id} input[name="search"]`)?.addEventListener('keyup', () => applyAjaxFilters(
                id));
            // Select2-compatible select change
            $(`#${id} select`).on('change select2:select select2:unselect', () => applyAjaxFilters(id));
        });
    </script>

    <script>
        // Handle pagination link click
        document.addEventListener('click', function(e) {
            const link = e.target.closest('.pagination a');
            if (link) {
                e.preventDefault();
                const url = link.getAttribute('href');
                const overlay = document.getElementById('itemsOverlay');
                overlay.style.display = 'flex';

                fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.text())
                    .then(html => {
                        const doc = new DOMParser().parseFromString(html, 'text/html');
                        document.getElementById('itemsContainer').innerHTML = doc.getElementById(
                            'itemsContainer').innerHTML;
                        document.getElementById('itemCount').innerHTML = doc.getElementById('itemCount')
                            .innerHTML;
                        window.scrollTo({
                            top: document.getElementById('itemsContainer').offsetTop - 100,
                            behavior: 'smooth'
                        });
                    })
                    .finally(() => {
                        overlay.style.display = 'none';
                    });
            }
        });
    </script>
@endsection
