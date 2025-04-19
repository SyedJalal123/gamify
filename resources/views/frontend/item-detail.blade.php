@extends('frontend.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/item-detail.css') }}">
@endsection

@section('content')
<section class="section section--bg section--first">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <a href="{{ url()->previous() }}" class="text-muted mb-3 d-inline-block">&larr; Back to all offers</a>

                @if ($isGold)
                {{-- GOLD ITEM LAYOUT --}}
                <div class="row gold-layout">
                    <div class="col-lg-7">
                        <h4 class="mb-3">{{ $item->game->name ?? $item->title }}</h4>
                        <div class="gold-badge mb-2 d-inline-flex align-items-center">
                            <img src="{{ asset($item->game->image) }}" alt="Gold Icon" width="24" class="mr-1">
                            <strong>Gold</strong>
                        </div>

                        <div class="seller-box p-3 rounded text-black bg-white mb-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="seller-avatar mr-2">
                                    {{ strtoupper(substr($item->seller->name ?? 'S', 0, 1)) }}
                                </div>
                                {{-- <img src="{{ asset('images/seller-icon.png') }}" alt="Seller" class="rounded-circle mr-2" width="40"> --}}
                                <div>
                                    <strong>{{ $item->seller->name ?? 'Top Seller' }}</strong><br>
                                    <small class="text-muted">{{ $item->seller->rating ?? '99%' }} • <a href="#">Reviews</a></small>
                                </div>
                            </div>

                            <table class="table table-borderless mb-0">
                                @foreach ($item->attributes as $attribute)
                                    <tr>
                                        <td>{{ $attribute->name }}</td>
                                        <td>{{ $attribute->pivot->value }}</td>
                                    </tr>
                                @endforeach
                            </table>

                            <p class="mt-3 mb-0 text-muted">Delivery Method: {{ $item->delivery_method ?? 'Instant Mail / Auction / Face-to-face' }}</p>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="price-box text-black bg-white p-4 rounded text-center">
                            <p class="text-muted mb-1">Price per unit</p>
                            <h3>${{ number_format($item->price, 3) }}</h3>

                            <form method="POST" action="#">
                                <div class="d-flex justify-content-center align-items-center my-3">
                                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="adjustQty(-1)">-</button>
                                    <input type="number" id="goldQty" name="quantity" value="1000" min="1" class="form-control mx-2 text-center" style="max-width: 80px;">
                                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="adjustQty(1)">+</button>
                                    {{-- <span class="ml-2">K</span> --}}
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

                @else
                {{-- NON-GOLD ITEM LAYOUT --}}
                <div class="row">
                    <div class="col-lg-8">
                        <h4 class="mb-3">{{ $item->title }}</h4>

                        <div class="item-gallery mb-4">
                            <img src="{{ asset($item->feature_image) }}" class="img-fluid rounded" alt="{{ $item->title }}">
                        </div>

                        <div class="description">
                            <h6>Offer description</h6>
                            <p>{!! nl2br(e($item->description)) !!}</p>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="spec-box text-black bg-white p-3 rounded mb-3">
                            <h6 class="mb-3">Specifications</h6>
                            <table class="table table-borderless mb-0">
                                @foreach ($item->attributes as $attribute)
                                    <tr>
                                        <td>{{ $attribute->name }}</td>
                                        <td>{{ $attribute->pivot->value }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>

                        <div class="price-box text-black bg-white p-4 rounded text-center">
                            <h3>${{ number_format($item->price, 2) }}</h3>
                            <button class="btn btn-dark w-100 mb-2">Buy now</button>
                            <small class="text-muted d-block">100% Secure Payments by <strong>TradeShield</strong></small>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<script>
function adjustQty(change) {
    const input = document.getElementById('goldQty');
    const pricePerK = {{ $item->price }};
    let qty = parseInt(input.value) + change;
    if (qty < 1) qty = 1;
    input.value = qty;
    document.getElementById('totalPrice').innerText = (pricePerK * qty).toFixed(2);
}
</script>
@endsection
