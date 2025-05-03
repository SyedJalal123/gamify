@extends('frontend.app')

@section('css')
    <style>
        section {
            font-size: 14px;
        }
       /* .select2-container--default .select2-selection--single {
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
        <div class="container mb-5 p-0" style="max-width: 1118px;">
            <div class="d-flex flex-row align-items-center mb-5 px-3">
                <img onclick="get_live_feeds()" src="{{ asset($buyerRequest->service->categoryGame->game->image) }}" style="width: 40px;height: max-content;">
                <div class="d-flex flex-column ml-3">
                    <h5 class="text-white fs-18 mb-0">{{ $buyerRequest->service->categoryGame->game->name }} - {{ $buyerRequest->service->name }}</h5>
                    <div class="text-black-40">Created: {{ $buyerRequest->created_at->format('F j, Y, g:i:s A') }}</div>
                    <div class="text-black-40">Expires: {{ $buyerRequest->expires_at->format('F j, Y, g:i:s A') }}</div>
                </div>
                {{dd('yes')}}
            </div>
            <div class="alerts col-12 w-100">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="fade-in-delay-small d-flex flex-column main-box px-2">
                <div class="Offers-live-feed d-flex flex-column pb-4">
                    <div class="d-flex justify-content-md-between flex-column flex-md-row">
                        <div class="offer-live-feed-title d-flex align-items-center mt-1 mb-3 px-3">
                            <div class="signal-ping-wrapper">
                                <span class="signal-ping-dot"></span>
                                <span class="signal-ping-circle"></span>
                                <span class="signal-ping-circle"></span>
                            </div>
                            <div class="d-flex flex-column text-white ml-3">
                                <div class="fw-bold">Offers live feed</div>
                                <div class="small text-black-40">Connected</div>
                            </div>
                        </div>
                        <div class="notifications-data d-flex flex-column flex-md-row text-white pb-2 p-md-0">
                            <div class="d-flex align-items-center ml-4 pb-2 fs-15">
                                <i class="bi bi-bell fs-19 pr-1"></i>
                                <span>Notified sellers: 666</span>
                            </div>
                            <div class="d-flex align-items-center ml-4 pb-2 fs-15">
                                <i class="bi bi-eye fs-19 pr-1"></i>
                                <span>Seen by: 45</span>
                            </div>
                            <div class="d-flex align-items-center ml-4 pb-2 fs-15">
                                <i class="bi bi-tag fs-19 pr-1"></i>
                                <span>Offers created: 6</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex bg-white br-2 flex-column align-items-center" id="live-feed">
                        @include('frontend.offers-live-feed', ['buyerRequest' => $buyerRequest])
                    </div>
                </div>
                <div class="live-chat d-flex flex-column mb-4 pb-4">
                    <div class="live-chat-title d-flex align-items-center mt-1 mb-3 px-3">
                        <div class="signal-ping-wrapper">
                            <span class="red-ping-dot"></span>
                        </div>
                        <div class="d-flex flex-column text-white ml-2">
                            <div class="fw-bold">LIVE CHAT WITH SELLERS</div>
                        </div>
                    </div>
                    <div class="d-flex live-chat-data py-5 bg-white">
                        .
                    </div>
                </div>
                <div class="request-details row d-flex pb-4 pb-md-2 mb-4 m-md-0 mx-0">
                    <div class="col-md-8 p-0 pr-md-4 pb-4">
                        <div class="bg-white">
                            <div class="px-4 py-3 border-bottom fw-bold">
                                Request Detials
                            </div>
                            <div>
                                @if($buyerRequest->user_id !== auth()->user()->id)
                                <div class="d-flex justify-content-between px-4 py-2 border-bottom">
                                    <div class="seller_details d-flex text-left">
                                        <div class="seller-avatar mr-2 d-flex align-items-center justify-content-center rounded-circle text-white" style="width: 40px; height: 40px; background-color: #c0392b;">
                                            S
                                        </div>
                                        <div class="d-flex flex-column">
                                            <div id="sellerName" class="fs-15 fw-bold">{{$buyerRequest->user->name}}</div>
                                            <div class="d-flex align-items-center">
                                                <i class="text-success bi bi-star-fill"></i>
                                                <span class="text-black-70 mx-1 fs-13">99.3%</span>
                                                <a href="#" class="fs-13">27,066 reviews</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @foreach ($buyerRequest->attributes as $attribute)
                                    <div class="d-flex justify-content-between px-4 py-2 border-bottom">
                                        @if ($attribute->type == 'select')
                                            <div class="">Select your {{$attribute->name}}</div>
                                            <div class="fw-bold">{{$attribute->pivot->value}}</div>
                                        @else
                                            <div class="">Input your {{$attribute->name}}</div>
                                            <div class="fw-bold">{{$attribute->pivot->value}}</div>
                                        @endif
                                    </div>
                                @endforeach
                                <div class="row m-0 d-flex justify-content-between px-4 py-2 border-bottom">
                                    @if ($buyerRequest->description != null && $buyerRequest->service->name !== 'Custom Request')
                                        <div class="col-6 p-0">Provide any additional information</div>
                                        <div class="fw-bold col-6 p-0 text-right">{{$buyerRequest->description}}</div>
                                    @elseif ($buyerRequest->service->name == 'Custom Request')
                                        <div class="">Describe your request</div>
                                        <div class="fw-bold">{{$buyerRequest->description}}</div>
                                    @endif
                                </div>
                                @if($buyerRequest->user_id !== auth()->user()->id)
                                <div class="d-flex px-4 py-3">
                                    <button class="btn btn-secondary fs-14 p-2 px-3 mr-2">Chat</button>
                                    @php
                                        $isRelated = $buyerRequest->requestOffers->contains(function ($offer) {
                                            return $offer->user_id === auth()->id();
                                        });
                                    @endphp

                                    @if(!$isRelated)
                                        <button class="btn btn-dark fs-14 p-2 px-3" data-toggle="modal" data-target="#createOfferModal">Create Offer</button>
                                    @endif
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 p-0">
                        <div class="px-4 py-3 border-bottom fw-bold bg-white">
                            Attachments
                        </div>
                        <div class="d-flex justify-content-center align-items-center h-50 bg-white">
                            <span class="text-muted py-5">No photos uploaded</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="createOfferModal" tabindex="-1" role="dialog" aria-labelledby="createOfferModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{url('create-offer')}}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="createOfferModalLabel">Create Boosting offer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="container px-md-5">
                        <div class="container__top d-flex align-item-start align-items-md-end flex-column">

                            <input type="hidden" name="buyer_request_id" value="{{$buyerRequest->id}}">
                            <div class="mb-3 d-flex flex-column flex-md-row align-items-start align-items-md-center">
                                <label for="nameInput" class="form-label mr-2 fs-13">Price&nbsp;$:</label>
                                <input type="number" class="form-control" name="price" id="nameInput" placeholder="Enter price" style="min-width: 272px; max-width: 272px; width: 100%;">
                            </div>

                            <div class="mb-3 d-flex flex-column flex-md-row align-items-start align-items-md-center">
                                <label for="roleSelect" class="form-label mr-2 fs-13">Delivery time:</label>
                                <div style="min-width: 272px; max-width: 272px; width: 100%;">
                                    <select class="form-select" name="delivery_time" id="roleSelect">
                                        <option selected disabled>Select Delivery time</option>
                                        <option value="20 min">20 min</option>
                                        <option value="1 h">1 h</option>
                                        <option value="2 h">2 h</option>
                                        <option value="3 h">3 h</option>
                                        <option value="5 h">5 h</option>
                                        <option value="8 h">8 h</option>
                                        <option value="12 h">12 h</option>
                                        <option value="1 day">1 day</option>
                                        <option value="2 days">2 days</option>
                                        <option value="3 days">3 days</option>
                                        <option value="7 days">7 days</option>
                                        <option value="14 days">14 days</option>
                                        <option value="28 days">28 days</option>
                                        <option value="45 days">45 days</option>
                                        <option value="60 days">60 days</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create offer</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        // Select 2
        $(document).ready(function() {
            // Apply Select2 to all select elements
            $('select').select2({
                dropdownPosition: 'below',
                dropdownParent: $('#createOfferModal'),
            });
        });
        document.addEventListener("DOMContentLoaded", function() {
            let userId = @json(auth()->user()->id);  // Get user ID dynamically from Laravel
            let buyerRequestId = @json($buyerRequest->user_id);

            console.log("User ID: ", userId); // Debug log for user ID
            console.log("Buyer Request User ID: ", buyerRequestId); // Debug log for buyer request ID

            // Get the div elements by class
            let div1 = document.getElementsByClassName('Offers-live-feed')[0];  // Get the first element with class 'Offers-live-feed'
            let div2 = document.getElementsByClassName('live-chat')[0];  // Get the first element with class 'live-chat'
            let div3 = document.getElementsByClassName('request-details')[0];  // Get the first element with class 'request-details'


            // Check if the elements exist and if the user is not the buyer request user
            if (div1 && div2 && div3) {
                if (userId !== buyerRequestId) {
                    div1.style.order = 2;
                    div2.style.order = 3;
                    div3.style.order = 1;
                }
            } else {
                console.error("One or more elements are missing in the DOM.");
            }
        });

        function get_live_feeds(){
            let url = new URL(window.location.href);
            $.ajax({
                url: url.toString(),
                method: 'GET',
                success: function (response) {
                    $('#live-feed').html(response); // Replace item list
                },
                error: function () {
                    alert('Something went wrong.');
                }
            });
        }

        function create_offer(){
            let url = new URL(window.location.href);
            $.ajax({
                url: '/create-offer',
                method: 'POST',
                success: function (response) {
                    
                },
                error: function () {
                    alert('Something went wrong.');
                }
            });
        }
        
    </script>
    @auth
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const userId = window.Laravel.user.id; // Pass user ID from Laravel to JS
            let unreadCount = parseInt(document.querySelector('.count-notifications').textContent) || 0;
    
            // Initialize Echo private channel listener for user notifications
            Echo.private(`App.Models.User.${userId}`)
                .notification((notification) => {                        
                    get_live_feeds()
                });
        });
    </script>
    @endauth
@endsection
