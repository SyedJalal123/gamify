@extends('frontend.app')

@section('css')
    <style>
        /* section {
            font-size: 14px;
        }
        .select2-container--default .select2-selection--single {
            height: 39px !important;
            font-size: 14px;
        }
        .d-none {
            display: none !important;
        }
        @media (min-width: 768px) {
            .d-md-block {
                display: block !important;
            }
        } */
    </style>
@endsection

@section('content')
    <section class="section section--bg section--first">
        <div class="container mb-5" style="max-width: 1118px;">
            <div class="row col-12">
                <img src="{{ asset($categoryGame->game->image) }}" style="width: 23px;height: max-content;">
                <h5 class="mb-4 ml-2 text-white">{{ $categoryGame->game->name }} {{ $categoryGame->title }}</h5>
            </div>
            <div class="row fade-in-delay-small">
                <div class="col-md-8">
                    
                </div>
                <div class="col-md-4">

                </div>
            </div>
            <div class="col-12 mt-2 pt-5 px-0 secondaryItemsContainer">
                {{-- Other Sellers --}}
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        
    </script>
@endsection
