@extends('frontend.app')


@section('css')
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('css/items_create.css')}}">
@endsection

{{-- 
- Modify the attributes a little. Because every category with game has different attributes like 
- "gold with wow" has diffrent attributes and "accounts with wow" has different attributes
- and no column should be null in database not game_id and not category_id but instead add multiple game_ids and multiple category_ids 
- so change it like when the user cliks on game then it fetches all the attributes based on category and game both
- and there are no game and category attributes it should be priorties column "1 for first" form "2 for secound" and "3 for final form" --}}

@section('content')
    <!-- home -->
    <section class="section section--bg section--first" data-bg="GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/img/bg.jpg" style="background: url(&quot;GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/img/bg.jpg&quot;) center top 140px / auto 500px no-repeat;">
        <div class="container">
            <div class="row">
                <!-- title -->
                <div class="col-12 d-flex justify-content-center">
                    <form id="regForm" method="post" action="{{url('items/store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="container__top text-center">
                            <div class="title">
                                <h1>Start selling</h1>
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
                            
                        </div>

                        <!-- One "tab" for each step in the form: -->
                        <div class="tab">
                            <div class="container">
                                <div class="base-container">
                                    <eld-select-category>
                                        <div class="header-container">
                                            <h4>Choose category</h4>
                                        </div>
                                        <eld-sell-page-categories>
                                            <div class="category-select-container">
                                                <div class="category-select-row">
                                                    
                                                    
                                                    @foreach($categories as $category)
                                                    <div class="category-select mb-2 category-item" data-category-id="{{ $category->id }}" onclick="nextPrev(1),selectCategory({{ $category->id }})">
                                                        <div class="name">
                                                            <eld-image style="height: 32px;">
                                                                <img class="app-image" alt="Currency"
                                                                    height="32" width="32" loading="eager" fetchpriority="auto" ng-img="true"
                                                                    src="https://w9g7dlhw3kaank.www.eldorado.gg/QLHQai4xYtviUZKeCEdT0qT0HcfzgZBozAps6udCgAdCL8M/KkTCHTxNsbE9qPgCZAxNlysMmOJqL06S4V6e5Jor7qr340moVVUvrOblMkGaS0YkobUqDSo07vPYOnmH1OqU5"
                                                                    srcset="https://assetsdelivery.eldorado.gg/v7/_assets_/miscellaneous/v6/coin.svg?w=32 1x, https://assetsdelivery.eldorado.gg/v7/_assets_/miscellaneous/v6/coin.svg?w=64 2x">
                                                            </eld-image>
                                                            <h6 class="m-0 ml-2">{{ $category->name }}</h6>
                                                        </div>
                                                        <eld-icon name="sign-right">
                                                            <span class="icon icon-sign-right" style="font-size: 32px; font-weight: 400; height: 32px; width: 32px;"></span>
                                                            <i class="bi bi-chevron-right"></i>
                                                        </eld-icon>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </eld-sell-page-categories>

                                        {{-- <div id="verification-required-section" class="mt-5">
                                            <eld-sell-verification-required>
                                                <div class="verification-required-wrapper">
                                                    <eld-image alt="Seller verification required photo"
                                                        style="height: 79px;"><img class="app-image" alt="Seller verification required photo"
                                                            height="79" width="131" loading="eager" fetchpriority="auto" ng-img="true"
                                                            src="https://w9g7dlhw3kaank.www.eldorado.gg/j62a2GcumwfUdKP1xFHZYHorCzvyl6LgnkRxKGN3eBJ6hku/3Y6EJNl18m5bq3jzWibuFZOwBu3I0gUaRSPHr88TQM4NPO1GfRCV6RC1ULurrCqvDHzbUslFHip3DfwqRbz6UhhKvrIKcBSpbSqPQ"
                                                            srcset="https://assetsdelivery.eldorado.gg/v7/_assets_/payments/v9/verification-required.png?w=131 1x, https://assetsdelivery.eldorado.gg/v7/_assets_/payments/v9/verification-required.png?w=262 2x">
                                                    </eld-image>
                                                    <h4><span>Seller verification required</span></h4>
                                                    <div class="verify-messsge">
                                                        <p>To sell accounts, please verify your identity first. <br>Our 24/7 support team will review your ID in up to 15 minutes.</p>
                                                        <div class="verification-card d-flex align-items-center flex-column">
                                                            <div class="container__top drop-box w-50 d-flex align-items-center flex-column">
                                                                <img class="app-image" alt="Seller Details review" height="47" width="47" loading="eager" fetchpriority="auto" ng-img="true" src="https://w9g7dlhw3kaank.www.eldorado.gg/WDlx5231QLHO4pNG8aWDLC6fwyjcgZYq1rK6yiNBBlMlTqwI5oZAqBlyRUmA07HH6oAYiZxmF6PrQLDdoG4x7M6i7mNzNoQx80fB84tuP1nmjA0kdWLI5YVxsT5YbpbXPbr" srcset="https://assetsdelivery.eldorado.gg/v7/_assets_/miscellaneous/v6/id-verification.svg?w=47 1x, https://assetsdelivery.eldorado.gg/v7/_assets_/miscellaneous/v6/id-verification.svg?w=94 2x">
                                                                <strong>Seller Verification</strong>
                                                                <div role="status" tabindex="0" aria-label="Documents required">
                                                                    <span class="badge badge-pill badge-danger">Documents required</span>
                                                                </div>
                                                                <button class="mt-2 btn-sm btn-success">Verify</button>
                                                            </div>
                                                        </div>
                                                    </div><!----><!---->
                                                </div>
                                            </eld-sell-verification-required>
                                        </div> --}}
                                    </eld-select-category>
                                </div>
                            </div>
                        </div>
                        
                        <div class="tab tab_2">
                            <div class="container">
                                <div id="games-container" style="display: none;">
                                    <h3>Select a Game</h3>
                                    <select id="games-dropdown" name="game_id" required>
                                        <option value="">Select a Game</option>
                                    </select>
                                </div>
                            </div>

                            <div style="overflow:auto;" class="d-flex justify-content-center buttons mt-5">
                                <div style="float:right;">
                                    <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                                    <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="tab_3">
                            <div class="tab">
                                <div class="container">
                                    <div class="attributes-container" style="display: none;">
    
                                        <h3>Game Attributes</h3>
                                        <div id="game-attributes-list"></div>
                                    
                                    </div>
                                </div>
    
                                <div style="overflow:auto;" class="d-flex justify-content-center buttons mt-5">
                                    <div style="float:right;">
                                        <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                                        <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="tab">
                            <input type="hidden" name="category_id" id="selectedCategory">
                            <div class="container">
                                <div class="mb-3 title_container">
                                    <label>Title:</label>
                                    <input type="text" name="title" class="form-control" required>
                                </div>
                        
                                <div class="mb-3">
                                    <label>Description:</label>
                                    <textarea name="description" class="form-control" required></textarea>
                                </div>
                        
                                <div class="mb-3">
                                    <label>Price:</label>
                                    <input type="number" name="price" class="form-control" required>
                                </div>
                        
                                <div class="attributes-container mb-5" style="display: none;">

                                    <div id="category-attributes-list"></div>
                                
                                </div>
                    
                                <div class="mb-3">
                                    <label>Upload Images:</label>
                                    <!-- Button for triggering file input -->
                                    <button type="button" class="btn-sm btn-dark" id="uploadBtn">+ Add Images</button>
                                    <input type="file" id="imageInput" accept="image/*" style="display: none;">

                                    <div class="preview-container" id="preview"></div>

                                    <!-- Hidden input to store selected images -->
                                    <div id="imageInputsContainer"></div>
                                    
                                    <input type="hidden" name="feature_image" id="featuredImageInput" required>
                                </div>
                                

                            </div>

                            <div style="overflow:auto;" class="d-flex justify-content-center buttons mt-5">
                                <div style="float:right;">
                                    <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                                    <button type="button" id="nextBtn" onclick="nextPrev(1)">Submit</button>
                                </div>
                            </div>
                        </div>
                        
                        
                        <!-- Circles which indicates the steps of the form: -->
                        <div class="steps-container" style="text-align:center;margin-top:40px;">
                            <span class="step"></span>
                            <span class="step"></span>
                            <span class="step"></span>
                            <span class="step"></span>
                        </div>
                        
                    </form>
                </div>
                <!-- end title -->
            </div>
        </div>
    </section>
    <!-- end home -->

    
@endsection


@section('js')


    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script>
        setTimeout(function() {
            $('#nationality_select').select2();
        }, 1000); // Wait 1 second before initializing
        setTimeout(function() {
            $('#country_select').select2();
        }, 1000); // Wait 1 second before initializing

        var currentTab = 0; // Current tab is set to be the first tab (0)
        showTab(currentTab); // Display the current tab

        function showTab(n) {
            
            // This function will display the specified tab of the form ...
            var x = document.getElementsByClassName("tab");

            if(x.length == 3){
                addLastStepVisibility();
            }else{
                removeLastStepVisibility();
            }
            x[n].style.display = "block";
            // ... and fix the Previous/Next buttons:
            if (n == 0) {
                document.getElementById("prevBtn").style.display = "none";
            } else {
                document.getElementById("prevBtn").style.display = "inline";
            }
            
            if (n == (x.length - 1)) {
                document.getElementById("nextBtn").innerHTML = "Submit";
            } else {
                document.getElementById("nextBtn").innerHTML = "Next";
            }
            // ... and run a function that displays the correct step indicator:
            fixStepIndicator(n)
        }

        function nextPrev(n) {
            // This function will figure out which tab to display
            var x = document.getElementsByClassName("tab");
            // Exit the function if any field in the current tab is invalid:
            if (n == 1 && !validateForm()) return false;
            // Hide the current tab:
            x[currentTab].style.display = "none";
            // Increase or decrease the current tab by 1:
            currentTab = currentTab + n;
            // if you have reached the end of the form... :
            if (currentTab >= x.length) {
                //...the form gets submitted:
                document.getElementById("loadingScreen").style.display = "flex";
                document.getElementById("regForm").submit();
                return false;
            }
            // Otherwise, display the correct tab:
            showTab(currentTab);
        }

        function validateForm() {
            // This function deals with validation of the form fields
            var x, y, i, valid = true;
            x = document.getElementsByClassName("tab");
            y = x[currentTab].getElementsByTagName("input");
            z = x[currentTab].getElementsByTagName("select");
            // A loop that checks every input field in the current tab:
            for (i = 0; i < y.length; i++) {

                // If a field is empty...
                if (y[i].value == "" && $(y[i]).attr('required')) {
                    // add an "invalid" class to the field:
                    y[i].className += " invalid";
                    // and set the current valid status to false:
                    valid = false;
                }
            }
            
            for (i = 0; i < z.length; i++) {
                // If a field is empty...
                if (z[i].value == "" && $(z[i]).attr('required')) {
                    // add an "invalid" class to the field:
                    z[i].className += " invalid";
                    // and set the current valid status to false:
                    valid = false;
                }
            }
            // If the valid status is true, mark the step as finished and valid:
            if (valid) {
                document.getElementsByClassName("step")[currentTab].className += " finish";
            }
            return valid; // return the valid status
        }

        function fixStepIndicator(n) {
            // This function removes the "active" class of all steps...
            var i, x = document.getElementsByClassName("step");
            for (i = 0; i < x.length; i++) {
                x[i].className = x[i].className.replace(" active", "");
            }
            //... and adds the "active" class to the current step:
            x[n].className += " active";
        }

        function addLastStepVisibility() {
            
            let steps = document.querySelectorAll('.step'); // Select all step elements

            if (steps.length > 0) {
                steps[steps.length - 1].classList.add('d-none', steps.length === 1);
            }
        }
        function removeLastStepVisibility() {
            
            let steps = document.querySelectorAll('.step'); // Select all step elements

            if (steps.length > 0) {
                steps[steps.length - 1].classList.remove('d-none', steps.length === 1);
            }
        }
    </script>

    <script>
    // $(document).ready(function() {
    //     // When a category is clicked
    //     $('.category-item').click(function() {
    //         let categoryId = $(this).data('category-id');

    //         // Reset everything when category is changed
    //         $('#games-dropdown').html('<option value="">Select a Game</option>'); // Reset games dropdown
    //         $('#games-container').hide(); // Hide games dropdown until populated
    //         $('#game-attributes-list').empty(); // Remove game attributes

    //         // Fetch and display category attributes
    //         $.get('/get-attributes', { category_id: categoryId }, function(data) {
    //             // console.log(data);
    //             $('#category-attributes-list').empty();
    //             renderAttributes(data.attributes, 'category-attributes-list');
    //         });

    //         // Fetch games for the selected category
    //         $.get('/get-games', { category_id: categoryId }, function(data) {
    //             if (data.games.length > 0) {
    //                 $('#games-dropdown').append(data.games.map(game => 
    //                     `<option value="${game.id}">${game.name}</option>`
    //                 ));
    //                 $('#games-container').show(); // Show dropdown if games are available
    //             }
    //         });

    //         $('.attributes-container').show(); // Show attributes section
    //     });

    //     // When a game is selected
    //     $('#games-dropdown').change(function() {
    //         let gameId = $(this).val();

    //         if (gameId) {
    //             $.get('/get-attributes', { game_id: gameId }, function(data) {
    //                 $('#game-attributes-list').empty(); // Remove old game attributes
    //                 renderAttributes(data.attributes, 'game-attributes-list');
    //             });
    //         } else {
    //             $('#game-attributes-list').empty(); // If no game is selected, clear attributes
    //         }
    //     });

    //     // Function to render attributes dynamically
    //     function renderAttributes(attributes, targetId) {
    //         let tab3 = document.querySelector('.tab_3');
    //         let firstChildTab = tab3.firstElementChild; // Selects the first child of .tab_3

    //         // Ensure the first child exists before modifying
    //         if (firstChildTab) {
    //             if (attributes.length > 0) {
    //                 firstChildTab.classList.add('tab');  // Add "tab" class if attributes exist
    //                 tab3.style.display = 'block'; // Show tab
    //             } else {
    //                 firstChildTab.classList.remove('tab'); // Remove "tab" class if no attributes
    //                 tab3.style.display = 'none'; // Hide tab
    //             }
    //         }
            
    //         attributes.forEach(attr => {
    //             let inputField = '';

    //             if (attr.type === 'text') {
    //                 inputField = `<input type="text" name="attribute_${attr.id}" placeholder="${attr.name}" class="form-control" />`;
    //             } else if (attr.type === 'select') {
    //                 let options = attr.options.map(option => 
    //                     `<option value="${option}">${option}</option>`).join('');
    //                 inputField = `<select name="attribute_${attr.id}" class="form-control">${options}</select>`;
    //             }

    //             $(`#${targetId}`).append(`
    //                 <div class="attribute-item">
    //                     <label>${attr.name}:</label>
    //                     ${inputField}
    //                 </div>
    //             `);
    //         });
            
    //     }
    // });

    function selectCategory(categoryId) {
        // Set the selected category ID in the hidden input field
        $('#selectedCategory').val(categoryId);

        // Get the title input field
        let titleInput = $('input[name="title"]');

        // Show/hide .title_container and update title input value
        if (categoryId == 1) {
            $('.title_container').hide();  // Hide if category is "Gold"
            titleInput.val('Gold');        // Set title to "Gold"
        } else {
            $('.title_container').show();  // Show for other categories
            titleInput.val('');            // Clear title input
        }
    }
    
    $(document).ready(function () {
        $('.category-item').click(function () {
            let categoryId = $(this).data('category-id');
            $('#selectedCategory').val(categoryId);

            $('#games-dropdown').html('<option value="">Select a Game</option>');
            $('#games-container').hide();
            $('#category-attributes-list').empty();

            // Populate games
            $.get('/get-games', { category_id: categoryId }, function (data) {
                if (data.games.length > 0) {
                    data.games.forEach(game => {
                        $('#games-dropdown').append(`<option value="${game.id}">${game.name}</option>`);
                    });
                    $('#games-container').show();
                }
            });

            // Game change listener
            $('#games-dropdown').off('change').on('change', function () {
                let gameId = $(this).val();

                $.get('/get-attributes', {
                    category_id: categoryId,
                    game_id: gameId
                }, function (data) {
                    $('#game-attributes-list').empty();
                    $('#category-attributes-list').empty();

                    renderAttributes(data.gameAttributes, 'game-attributes-list');
                    renderAttributes(data.categoryAttributes, 'category-attributes-list');
                });

            });

            $('.attributes-container').show();
        });
    });

    function renderAttributes(attributes, targetId) {
        let tab3 = document.querySelector('.tab_3');
        let firstChildTab = tab3.firstElementChild;

        if (firstChildTab) {
            firstChildTab.classList.toggle('tab', attributes.length > 0);
            tab3.style.display = attributes.length > 0 ? 'block' : 'none';
        }

        attributes.forEach(attr => {
            let inputField = '';

            if (attr.type === 'text') {
                inputField = `<input type="text" name="attribute_${attr.id}" placeholder="${attr.name}" class="form-control" />`;
            } else if (attr.type === 'select') {
                let options = attr.options.map(option => `<option value="${option}">${option}</option>`).join('');
                inputField = `<select name="attribute_${attr.id}" class="form-control">${options}</select>`;
            }

            $(`#${targetId}`).append(`
                <div class="attribute-item">
                    <label>${attr.name}:</label>
                    ${inputField}
                </div>
            `);
        });
    }
    </script>

    {{-- Images Script --}}
    <script>
        let selectedFiles = [];

        document.getElementById('uploadBtn').addEventListener('click', function() {
            document.getElementById('imageInput').click();
        });

        document.getElementById('imageInput').addEventListener('change', function(event) {
            let preview = document.getElementById('preview');
            let imageInputsContainer = document.getElementById('imageInputsContainer');
            let featuredImageInput = document.getElementById('featuredImageInput');

            if (event.target.files.length > 0) {
                let file = event.target.files[0];

                if (!selectedFiles.some(f => f.name === file.name)) { // Prevent duplicate uploads
                    let reader = new FileReader();

                    reader.onload = function(e) {
                        let imageWrapper = document.createElement('div');
                        imageWrapper.classList.add('image-wrapper');

                        let img = document.createElement('img');
                        img.src = e.target.result;
                        img.dataset.filename = file.name;

                        // Remove Button
                        let removeBtn = document.createElement('button');
                        removeBtn.innerText = 'X';
                        removeBtn.classList.add('remove-btn');
                        removeBtn.onclick = function() {
                            preview.removeChild(imageWrapper);
                            selectedFiles = selectedFiles.filter(f => f.name !== file.name);
                            document.getElementById(file.name).remove();

                            // Update featured image if removed
                            if (featuredImageInput.value === file.name) {
                                if (selectedFiles.length > 0) {
                                    featuredImageInput.value = selectedFiles[0].name;
                                    updateFeaturedImage(selectedFiles[0].name);
                                } else {
                                    featuredImageInput.value = '';
                                }
                            }
                        };

                        // Click to Set Featured Image
                        img.onclick = function() {
                            updateFeaturedImage(file.name);
                        };

                        imageWrapper.appendChild(img);
                        imageWrapper.appendChild(removeBtn);
                        preview.appendChild(imageWrapper);

                        selectedFiles.push(file);

                        // Create hidden input field for each image
                        let input = document.createElement('input');
                        input.type = 'file';
                        input.name = 'images[]';
                        input.id = file.name;
                        input.files = event.target.files;
                        input.style.display = 'none';
                        imageInputsContainer.appendChild(input);

                        // Auto-set first image as featured
                        if (selectedFiles.length === 1) {
                            updateFeaturedImage(file.name);
                        }
                    };

                    reader.readAsDataURL(file);
                }
            }
        });

        function updateFeaturedImage(filename) {
            document.querySelectorAll('.image-wrapper img').forEach(i => i.classList.remove('featured'));
            document.querySelectorAll('.featured-tag').forEach(tag => tag.remove());

            let featuredImg = document.querySelector(`.image-wrapper img[data-filename="${filename}"]`);
            if (featuredImg) {
                featuredImg.classList.add('featured');
                document.getElementById('featuredImageInput').value = filename;

                let tag = document.createElement('div');
                tag.classList.add('featured-tag');
                tag.innerText = 'FEATURED';
                featuredImg.parentElement.appendChild(tag);
            }
        }
    </script>
@endsection































{{-- @extends('frontend.app')

@section('content')

    <div class="container section section--first text-white text-center pb-5 mb-5">
        <h2>Upload New Item</h2>
    
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    
        <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
    
            <input type="hidden" name="category_id" value="{{ $categoryId }}">
            <input type="hidden" name="game_id" value="{{ $gameId }}">
    
            <div class="mb-3">
                <label>Title:</label>
                <input type="text" name="title" class="form-control" required>
            </div>
    
            <div class="mb-3">
                <label>Description:</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>
    
            <div class="mb-3">
                <label>Price:</label>
                <input type="number" name="price" class="form-control" required>
            </div>
    
            <div class="mb-3">
                <label>Delivery Type:</label>
                <select name="delivery_type" class="form-control" required>
                    <option value="instant">Instant</option>
                    <option value="manual">Manual</option>
                </select>
            </div>
    
            <div class="mb-3">
                <label>Upload Images:</label>
                <input type="file" id="imageInput" name="images[]" class="form-control" multiple onchange="event.preventDefault();">
            </div>
        
            <!-- Image Preview Section -->
            <div id="imagePreviewContainer" class="d-flex flex-wrap"></div>
        
            <!-- Hidden input for feature image -->
            <input type="hidden" name="feature_image" id="featureImageInput">

    
            <button type="submit" class="btn btn-primary">Upload Item</button>
        </form>
    </div>
@endsection

@section('js')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let selectedFiles = []; // Store selected files
        let featureImageName = null; // Track feature image

        document.getElementById('imageInput').addEventListener('change', function(event) {
            let files = Array.from(event.target.files);
            let previewContainer = document.getElementById('imagePreviewContainer');

            files.forEach(file => {
                if (!selectedFiles.some(f => f.name === file.name)) { // Avoid duplicate images
                    selectedFiles.push(file);

                    let reader = new FileReader();
                    reader.onload = function(e) {
                        let imageWrapper = document.createElement('div');
                        imageWrapper.classList.add('image-wrapper');
                        imageWrapper.style.position = 'relative';
                        imageWrapper.style.margin = '10px';
                        imageWrapper.style.display = 'inline-block';
                        imageWrapper.style.border = '2px solid transparent';

                        let img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.width = '100px';
                        img.style.height = '100px';
                        img.style.objectFit = 'cover';
                        img.dataset.filename = file.name;

                        // Feature Image Tag
                        let featureTag = document.createElement('div');
                        featureTag.innerText = 'Feature';
                        featureTag.classList.add('feature-tag');
                        featureTag.style.position = 'absolute';
                        featureTag.style.top = '5px';
                        featureTag.style.left = '5px';
                        featureTag.style.background = 'gold';
                        featureTag.style.color = 'black';
                        featureTag.style.padding = '2px 5px';
                        featureTag.style.borderRadius = '5px';
                        featureTag.style.display = 'none'; // Hidden by default

                        // Feature Image Button
                        let featureButton = document.createElement('button');
                        featureButton.innerText = 'Set Feature';
                        featureButton.type = 'button';
                        featureButton.style.position = 'absolute';
                        featureButton.style.bottom = '5px';
                        featureButton.style.left = '5px';
                        featureButton.style.background = 'green';
                        featureButton.style.color = 'white';
                        featureButton.style.border = 'none';
                        featureButton.style.cursor = 'pointer';
                        featureButton.addEventListener('click', function() {
                            setFeatureImage(file.name, imageWrapper, featureTag);
                        });

                        // Remove Button
                        let removeButton = document.createElement('button');
                        removeButton.innerText = 'X';
                        removeButton.style.position = 'absolute';
                        removeButton.style.top = '5px';
                        removeButton.style.right = '5px';
                        removeButton.style.background = 'red';
                        removeButton.style.color = 'white';
                        removeButton.style.border = 'none';
                        removeButton.style.cursor = 'pointer';
                        removeButton.addEventListener('click', function() {
                            selectedFiles = selectedFiles.filter(f => f.name !== file.name);
                            
                            // If the removed image was the feature image, reset feature selection
                            if (featureImageName === file.name) {
                                document.getElementById('featureImageInput').value = ''; // Reset feature image
                                featureImageName = null;

                                // Set the first remaining image as the new feature image
                                if (selectedFiles.length > 0) {
                                    let firstImageWrapper = previewContainer.querySelector('.image-wrapper');
                                    let firstFeatureTag = firstImageWrapper.querySelector('.feature-tag');
                                    let firstImageName = selectedFiles[0].name;
                                    setFeatureImage(firstImageName, firstImageWrapper, firstFeatureTag);
                                }
                            }

                            imageWrapper.remove();
                        });

                        imageWrapper.appendChild(img);
                        imageWrapper.appendChild(featureTag);
                        imageWrapper.appendChild(featureButton);
                        imageWrapper.appendChild(removeButton);
                        previewContainer.appendChild(imageWrapper);

                        // Automatically set the first image as the feature image
                        if (selectedFiles.length === 1) {
                            setFeatureImage(file.name, imageWrapper, featureTag);
                        }
                    };

                    reader.readAsDataURL(file);
                }
            });

            // Reset the file input to allow re-selection of the same file
            event.target.value = '';
        });

        function setFeatureImage(imageName, imageWrapper, featureTag) {
            // Remove highlight from all images
            document.querySelectorAll('.image-wrapper').forEach(el => {
                el.style.border = '2px solid transparent';

                // Hide previous feature tag
                let prevFeatureTag = el.querySelector('.feature-tag');
                if (prevFeatureTag) prevFeatureTag.style.display = 'none';
            });

            // Highlight selected feature image
            imageWrapper.style.border = '2px solid gold';
            featureTag.style.display = 'block';

            // Store feature image filename
            document.getElementById('featureImageInput').value = imageName;
            featureImageName = imageName;
        }
    });
</script>
    
    
@endsection --}}