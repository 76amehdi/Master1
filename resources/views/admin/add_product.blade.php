<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin | {{ __('add_product.title') }}</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/jvectormap/jquery-jvectormap.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/owl-carousel-2/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/owl-carousel-2/owl.theme.default.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('admin/assets/images/favicon.png') }}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <style>
        .form-group {
            margin-bottom: 1rem;
        }

        .btn {
            font-size: 1rem;
            padding: 10px 10px;
        }

        .row.unit-field {
            margin-bottom: 20px;
        }

        .text-center {
            text-align: center;
        }

        .card-description {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 20px;
            color: black !important;
        }

        /* Responsive styling for larger screens */
        @media (min-width: 768px) {
            .btn {
                width: 180px;
                font-size: 1.2rem;
            }
        }

        /* Textarea Styles */
        .custom-editor-container {
            position: relative;
            /* for absolutely positioned elements */
            border: 1px solid #ddd;
            border-radius: 4px;
            overflow: hidden;
            background-color: #aaaaaa;
            /* background same color as containzzer */
        }

        .custom-editor-container .ck-editor__editable {
            min-height: 150px;
            /* Adjust as needed */
            background-color: #aaaaaa;
            color: #000000;
        }



        .custom-editor-container .ck-editor__top {
            background-color: #aaaaaa;
            /*  background same color as container */

        }

        .custom-editor-container textarea {
            display: block;
            width: 100%;
            min-height: 150px;
            /* Adjust as needed */
            padding: 10px;
            font-size: 1rem;
            color: #000000;
            box-sizing: border-box;
            /* ensure padding doesn't affect width */
            border: 0;
            resize: vertical;
            /* allows vertical resizing only */
            background-color: #aaaaaa;
            color: #000000;
        }
    </style>

</head>

<body>
    <div class="container-scroller">
        @include('admin.sidebar')
        <div class="container-fluid page-body-wrapper">
            @include('admin.navbar')
            <div class="main-panel">
                <div class="content-wrapper">
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <form action="{{ route('admin.add_product', ['lang' => app()->getLocale()]) }}"
                                    method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <h4 class="card-title">{{ __('add_product.add_product_form') }}</h4>
                                        <p class="card-description"> {{ __('add_product.product_details') }} </p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-sm-3 col-form-label">{{ __('add_product.product_title') }}</label>
                                                    <div class="col-sm-9">
                                                        <input name="title" type="text" class="form-control"
                                                            required />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-sm-3 col-form-label">{{ __('add_product.category') }}</label>
                                                    <div class="col-sm-9">
                                                        <select name="category" class="form-control" required>
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}">
                                                                    {{ $category->category_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-sm-3 col-form-label">{{ __('add_product.product_description') }}</label>
                                                    <div class="col-sm-9">
                                                        <div class="custom-editor-container">
                                                            <textarea class="custom-editor" name="description" id="editor">

                                                            </textarea>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-sm-3 col-form-label">{{ __('add_product.ingredient') }}</label>
                                                    <div class="col-sm-9">
                                                        <div class="custom-editor-container">
                                                            <textarea class="custom-editor" name="ingredient" id="editoringredient">

                                                            </textarea>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-sm-3 col-form-label">{{ __('add_product.utilisation') }}</label>
                                                    <div class="col-sm-9">
                                                        <div class="custom-editor-container">
                                                            <textarea class="custom-editor" name="utilisation" id="editorutilisation">

                                                            </textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-sm-3 col-form-label">{{ __('add_product.result') }}</label>
                                                    <div class="col-sm-9">
                                                        <div class="custom-editor-container">
                                                            <textarea class="custom-editor" name="result" id="editorresult">

                                                            </textarea>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <script src="https://cdn.ckeditor.com/ckeditor5/23.1.0/classic/ckeditor.js"></script>
                                            <script>
                                                function initEditor(selector) {
                                                    ClassicEditor
                                                        .create(document.querySelector(selector), {
                                                            removePlugins: [
                                                                'CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'Image', 'ImageCaption',
                                                                'ImageStyle', 'ImageToolbar', 'ImageUpload', 'MediaEmbed'
                                                            ],
                                                        })
                                                        .then(editor => {
                                                            const editableElement = editor.ui.view.editable.element;
                                                            editableElement.style.color = '#000000'; // Text color black
                                                            editableElement.style.backgroundColor = '#aaaaaa'; // Background color gray

                                                            editableElement.style.color = '#000000';
                                                            editableElement.style.backgroundColor = '#aaaaaa';

                                                            // Focus event
                                                            editableElement.addEventListener('focus', () => {
                                                                editableElement.style.backgroundColor = '#aaaaaa'; // Background stays gray on focus
                                                                editableElement.style.color = '#000000'; // Text stays black on focus
                                                            });

                                                            // Blur event
                                                            editableElement.addEventListener('blur', () => {
                                                                editableElement.style.backgroundColor = '#aaaaaa'; // Background stays gray on blur
                                                                editableElement.style.color = '#000000'; // Text stays black on blur
                                                            });
                                                        })
                                                        .catch(error => {
                                                            console.error(error);
                                                        });
                                                }

                                                // Initialize all editors
                                                initEditor('#editor');
                                                initEditor('#editoringredient');
                                                initEditor('#editorutilisation');
                                                initEditor('#editorresult');
                                            </script>

                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-sm-3 col-form-label">{{ __('add_product.warehouse') }}</label>
                                                    <div class="col-sm-9">
                                                        <select name="warehouse" class="form-control" required>
                                                            @foreach ($warehouses as $warehouse)
                                                                <option value="{{ $warehouse->id }}">
                                                                    {{ $warehouse->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-sm-3 col-form-label">{{ __('add_product.brand') }}</label>
                                                    <div class="col-sm-9">
                                                        <input name="brand" type="text" class="form-control"
                                                            required />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <p class="card-description text-center"
                                            style="font-size: 1.5rem; font-weight: bold;">
                                            {{ __('add_product.unit_price') }}</p>

                                        <div id="unitFields">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label
                                                            class="col-sm-3 col-form-label">{{ __('add_product.unit') }}</label>
                                                        <div class="col-sm-9">
                                                            <input name="unit[]" placeholder="ex: 100 cl"
                                                                type="text" class="form-control" required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label
                                                            class="col-sm-3 col-form-label">{{ __('add_product.price') }}</label>
                                                        <div class="col-sm-9">
                                                            <input name="price[]" placeholder="200 " type="text"
                                                                class="form-control" required />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Buttons Section -->
                                        <div class="text-center mt-3">
                                            <!-- Button to add new unit and price -->
                                            <button type="button" class="btn btn-primary" id="addUnitButton"
                                                style="width: 150px; font-size: 1rem; padding: 10px 20px;">{{ __('add_product.add_unit') }}</button>
                                        </div>

                                        <script>
                                            // Select the button and the container where the fields will be appended
                                            const addUnitButton = document.getElementById('addUnitButton');
                                            const unitFieldsContainer = document.getElementById('unitFields');

                                            // Function to add new unit and price fields
                                            addUnitButton.addEventListener('click', function() {
                                                const newUnitFields = `
                                                                <div class="row unit-field">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-3 col-form-label">{{ __('add_product.unit') }}</label>
                                                                            <div class="col-sm-9">
                                                                                <input name="unit[]" placeholder="ex: 100 cl" type="text" class="form-control"  required />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-3 col-form-label">{{ __('add_product.price') }}</label>
                                                                            <div class="col-sm-9">
                                                                                <input name="price[]" placeholder="200 " type="text" class="form-control"  required />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- Remove Button -->
                                                                    <div class="col-md-12 text-center">
                                                                        <button type="button" class="btn btn-danger removeUnitButton" style="width: 120px; font-size: 1rem; padding: 8px 16px;">{{ __('add_product.remove') }}</button>
                                                                    </div>
                                                                </div>
                                                            `;

                                                // Append the new fields to the container
                                                unitFieldsContainer.insertAdjacentHTML('beforeend', newUnitFields);
                                            });

                                            // Event delegation to handle remove button clicks
                                            unitFieldsContainer.addEventListener('click', function(e) {
                                                if (e.target && e.target.classList.contains('removeUnitButton')) {
                                                    // Remove the parent row (unit and price inputs along with the remove button)
                                                    e.target.closest('.row').remove();
                                                }
                                            });
                                        </script>
                                        <p></p>
                                        <p class="card-description text-center"
                                            style="font-size: 1.5rem; font-weight: bold;">
                                            {{ __('add_product.colors') }}</p>

                                        <div id="colorFields" class="container">
                                            <!-- Dynamically added color fields will appear here -->
                                        </div>

                                        <!-- Buttons Section -->
                                        <div class="text-center mt-3">
                                            <!-- Button to add new color fields -->
                                            <button type="button" class="btn btn-primary" id="addColorButton"
                                                style="width: 150px; font-size: 1rem; padding: 10px 20px;">{{ __('add_product.add_color') }}</button>
                                        </div>

                                        <script>
                                            // Select the button and the container where the fields will be appended
                                            const addColorButton = document.getElementById('addColorButton');
                                            const colorFieldsContainer = document.getElementById('colorFields');

                                            // Function to add new color fields
                                            addColorButton.addEventListener('click', function() {
                                                const newColorFields = `
            <div class="row color-field mt-3">
                <div class="col-md-10 offset-md-1">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">{{ __('add_product.color') }}</label>
                        <div class="col-sm-8">
                            <input name="colors[]" placeholder="ex: Red" type="text" class="form-control" style="color: white;" required />
                        </div>
                        <!-- Remove Button -->
                        <div class="col-sm-2 text-center">
                            <button type="button" class="btn btn-danger removeColorButton" style="width: 100%; font-size: 1rem; padding: 8px;">{{ __('add_product.remove') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        `;

                                                // Append the new fields to the container
                                                colorFieldsContainer.insertAdjacentHTML('beforeend', newColorFields);
                                            });

                                            // Event delegation to handle remove button clicks
                                            colorFieldsContainer.addEventListener('click', function(e) {
                                                if (e.target && e.target.classList.contains('removeColorButton')) {
                                                    // Remove the parent row (color input along with the remove button)
                                                    e.target.closest('.row').remove();
                                                }
                                            });
                                        </script>
                                        <br />
                                        <p></p>
                                        <p class="card-description text-center"
                                            style="font-size: 1.5rem; font-weight: bold;">
                                            {{ __('add_product.images') }}</p>
                                        <p></p>

                                        <div class="row">
                                            <div id="image-container">
                                                <!-- Initial Image Upload -->
                                                <div class="image-upload-row">
                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <label class="col col-form-label">{{ __('add_product.product_image') }}</label>
                                                            <input type="file" name="image1" class="file-upload-default image-input">
                                                            <div class="input-group">
                                                                <input type="text"  class="form-control file-upload-info" disabled
                                                                    placeholder="{{ __('add_product.upload_image') }} (required)">
                                                                <span style="margin-left: 50px;" class="input-group-append">
                                                                    <button class="file-upload-browse btn btn-primary" type="button">{{ __('add_product.upload') }}</button>
                                                                </span>
                                                                
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group row">
                                                            <div class="input-group col-sm-9">
                                                                <img class="showImage" style="width: 70%; border-radius: 3%;"
                                                                    src="{{ asset('admin/assets/images/no_image.jpg') }}" alt="product_image">
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 text-center">
                                                <button type="button" id="add-image-btn"
                                                    class="btn btn-secondary">{{ __('add_product.add_another_image') }}</button>
                                            </div>

                                            <div class="form-group">
                                                <label
                                                    for="recuperation_from_shop">{{ __('add_product.recuperation_from_shop') }}:</label>
                                                <div>
                                                    <input type="checkbox" id="recuperation_from_shop"
                                                        name="recuperation_from_shop" value="1"
                                                        {{ old('recuperation_from_shop') ? 'checked' : '' }}>
                                                    <label
                                                        for="recuperation_from_shop">{{ __('add_product.yes') }}</label>
                                                </div>
                                                @error('recuperation_from_shop')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-12">
                                                <div class="d-flex justify-content-center">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label"></label>
                                                            <div class="input-group col-sm-9">
                                                                <button type="submit"
                                                                    class="btn btn-info">{{ __('add_product.add_product') }}</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                const imageContainer = document.getElementById('image-container');
                                                const addImageBtn = document.getElementById('add-image-btn');
                                                let imageCount = 1; // Start from image1 already included above

                                                function addImageRow() {
                                                    imageCount++;
                                                    if (imageCount > 10) {
                                                        alert("You can add a maximum of 10 images.");
                                                        return;
                                                    }

                                                    const newImageRow = document.createElement('div');
                                                    newImageRow.classList.add('image-upload-row');
                                                    newImageRow.innerHTML = `
                                                        <div class="col-12">
                                                            <div class="form-group row">
                                                                <label class="col col-form-label">{{ __('add_product.product_image') }}</label>
                                                                <input type="file" name="image${imageCount}" class="file-upload-default image-input">
                                                                <div class="input-group">
                                                                    <input type="text"  class="form-control file-upload-info" disabled
                                                                        placeholder="{{ __('add_product.upload_image') }}">
                                                                    <span style="margin-left: 50px;" class="input-group-append">
                                                                        <button class="file-upload-browse btn btn-primary" type="button">{{ __('add_product.upload') }}</button>
                                                                    </span>
                                                                    <span style="margin-left: 50px;" class="input-group-append">
                                                                        <button type="button" class="btn btn-danger remove-image-btn">Remove</button>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group row">
                                                                <div class="input-group col-sm-9">
                                                                    <img class="showImage" style="width: 70%; border-radius: 3%;"
                                                                        src="{{ asset('admin/assets/images/no_image.jpg') }}" alt="product_image">
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    `;
                                                    imageContainer.appendChild(newImageRow);

                                                    // Image Preview
                                                    const imageInput = newImageRow.querySelector('.image-input');
                                                    const previewImage = newImageRow.querySelector('.showImage');

                                                    imageInput.addEventListener('change', function() {
                                                        const file = imageInput.files[0];
                                                        if (file) {
                                                            const reader = new FileReader();
                                                            reader.onload = function(e) {
                                                                previewImage.src = e.target.result;
                                                            };
                                                            reader.readAsDataURL(file);
                                                        } else {
                                                            previewImage.src = "{{ asset('admin/assets/images/no_image.jpg') }}";
                                                        }
                                                    });

                                                    // Handle the File Input Browse Button Functionality
                                                    const fileBrowseButton = newImageRow.querySelector('.file-upload-browse');
                                                    fileBrowseButton.addEventListener('click', function() {
                                                        imageInput.click();
                                                    })

                                                    // Handle the File Input Textbox Update Functionality
                                                    const fileInfoInput = newImageRow.querySelector('.file-upload-info')
                                                    imageInput.addEventListener('change', function() {
                                                        if (this.files.length > 0) {
                                                            fileInfoInput.value = this.files[0].name;
                                                        } else {
                                                            fileInfoInput.value = '';
                                                        }
                                                    })

                                                    // Add event listener for the remove button
                                                    const removeButton = newImageRow.querySelector('.remove-image-btn');
                                                    removeButton.addEventListener('click', function() {
                                                        imageContainer.removeChild(newImageRow);
                                                        imageCount--; // Decrease the imageCount
                                                    });

                                                }
                                                addImageBtn.addEventListener('click', addImageRow);

                                                // Image Preview for initial image
                                                const firstImageInput = document.querySelector('.image-input');
                                                const firstPreviewImage = document.querySelector('.showImage');


                                                firstImageInput.addEventListener('change', function() {
                                                    const file = firstImageInput.files[0];
                                                    if (file) {
                                                        const reader = new FileReader();
                                                        reader.onload = function(e) {
                                                            firstPreviewImage.src = e.target.result;
                                                        };
                                                        reader.readAsDataURL(file);
                                                    } else {
                                                        firstPreviewImage.src = "{{ asset('admin/assets/images/no_image.jpg') }}";
                                                    }
                                                });

                                                // Handle the File Input Browse Button Functionality
                                                const firstFileBrowseButton = document.querySelector('.file-upload-browse');
                                                firstFileBrowseButton.addEventListener('click', function() {
                                                    firstImageInput.click();
                                                })


                                                // Handle the File Input Textbox Update Functionality
                                                const firstFileInfoInput = document.querySelector('.file-upload-info')
                                                firstImageInput.addEventListener('change', function() {
                                                    if (this.files.length > 0) {
                                                        firstFileInfoInput.value = this.files[0].name;
                                                    } else {
                                                        firstFileInfoInput.value = '';
                                                    }
                                                })
                                            });
                                        </script>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('admin/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('admin/assets/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendors/progressbar.js/progressbar.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendors/jvectormap/jquery-jvectormap.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('admin/assets/vendors/owl-carousel-2/owl.carousel.min.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('admin/assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('admin/assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('admin/assets/js/misc.js') }}"></script>
    <script src="{{ asset('admin/assets/js/settings.js') }}"></script>
    <script src="{{ asset('admin/assets/js/todolist.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{ asset('admin/assets/js/dashboard.js') }}"></script>
    <!-- End custom js for this page -->
    <!-- Custom js for this page -->
    <script src="{{ asset('admin/assets/js/file-upload.js') }}"></script>
    <script src="{{ asset('admin/assets/js/typeahead.js') }}"></script>
    <script src="{{ asset('admin/assets/js/select2.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // Attach change event handlers for each file input
            $('#image1').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage1').attr('src', e.target.result);
                };
                reader.readAsDataURL(e.target.files[0]);
            });

            $('#image2').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage2').attr('src', e.target.result);
                };
                reader.readAsDataURL(e.target.files[0]);
            });

            $('#image3').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage3').attr('src', e.target.result);
                };
                reader.readAsDataURL(e.target.files[0]);
            });
        });
    </script>

</body>

</html>
