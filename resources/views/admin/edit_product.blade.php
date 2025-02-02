<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <base href="/public">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin | {{ __('edit_product.title') }}</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="admin/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="admin/assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="admin/assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="admin/assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="admin/assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="admin/assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="admin/assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="admin/assets/images/favicon.png" />
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
            /* background same color as container */
        }

        .custom-editor-container .ck-editor__editable {
            min-height: 150px;
            /* Adjust as needed */
            background-color: #aaaaaa;
            color: #000000;
        }

        .custom-editor-container .ck.ck-editor__main>.ck-editor__editable:not(.ck-focused) {
            border: 0 !important;
        }

        .custom-editor-container .ck-editor__top {
            background-color: #aaaaaa;
            /* background same color as container */
            border: 0;
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
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <form action="{{ url('update_product', $product->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="card-body">
                                        <h4 class="card-title">{{ __('edit_product.edit_product_form') }}</h4>
                                        <p class="card-description"> {{ __('edit_product.product_details') }} </p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-sm-3 col-form-label">{{ __('edit_product.title') }}</label>
                                                    <div class="col-sm-9">
                                                        <input name="title" type="text" class="form-control"
                                                            value="{{ $product->title }}" required />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-sm-3 col-form-label">{{ __('edit_product.category') }}</label>
                                                    <div class="col-sm-9">
                                                        <select name="category" class="form-control">
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}"
                                                                    {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                                                    {{ $category->category_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Product Description -->
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-sm-3 col-form-label">{{ __('edit_product.description') }}</label>
                                                    <div class="col-sm-9">
                                                        <div class="custom-editor-container">
                                                            <textarea class="custom-editor" name="description" id="editor">
                                                            {!! old('description', $product->description) !!}
                                                            </textarea>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-sm-3 col-form-label">{{ __('edit_product.ingredient') }}</label>
                                                    <div class="col-sm-9">
                                                        <div class="custom-editor-container">
                                                            <textarea class="custom-editor" name="ingredient" id="editoringredient">
                                                            {!! old('ingredient', $product->ingredient) !!}
                                                            </textarea>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-sm-3 col-form-label">{{ __('edit_product.utilisation') }}</label>
                                                    <div class="col-sm-9">
                                                        <div class="custom-editor-container">
                                                            <textarea class="custom-editor" name="utilisation" id="editorutilisation">
                                                            {!! old('utilisation', $product->utilisation) !!}
                                                            </textarea>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-sm-3 col-form-label">{{ __('edit_product.result') }}</label>
                                                    <div class="col-sm-9">
                                                        <div class="custom-editor-container">
                                                            <textarea class="custom-editor" name="result" id="editorresult">
                                                            {!! old('result', $product->result) !!}
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

                                                            // Ensure the background and color are set on editor initialization
                                                            editableElement.style.color = '#000000';
                                                            editableElement.style.backgroundColor = '#aaaaaa';

                                                            // Force the styles whenever the document is changed
                                                            editor.model.document.on('change', () => {
                                                                editableElement.style.color = '#000000';
                                                                editableElement.style.backgroundColor = '#aaaaaa';
                                                            });

                                                            // Listen for focus events and prevent style change
                                                            editableElement.addEventListener('focus', () => {
                                                                editableElement.style.color = '#000000';
                                                                editableElement.style.backgroundColor = '#aaaaaa';
                                                            });

                                                            // Listen for blur events and prevent style change
                                                            editableElement.addEventListener('blur', () => {
                                                                editableElement.style.color = '#000000';
                                                                editableElement.style.backgroundColor = '#aaaaaa';
                                                            });

                                                            // Ensure styles are enforced on each content input action
                                                            editor.editing.view.document.on('focus', () => {
                                                                editableElement.style.color = '#000000';
                                                                editableElement.style.backgroundColor = '#aaaaaa';
                                                            });

                                                            editor.editing.view.document.on('blur', () => {
                                                                editableElement.style.color = '#000000';
                                                                editableElement.style.backgroundColor = '#aaaaaa';
                                                            });
                                                        })
                                                        .catch(error => {
                                                            console.error(error);
                                                        });
                                                }
                                                initEditor('#editor');
                                                initEditor('#editoringredient');
                                                initEditor('#editorutilisation');
                                                initEditor('#editorresult');
                                            </script>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-sm-3 col-form-label">{{ __('edit_product.warehouse') }}</label>
                                                    <div class="col-sm-9">
                                                        <select name="warehouse" class="form-control">
                                                            @foreach ($warehouses as $warehouse)
                                                                <option value="{{ $warehouse->id }}"
                                                                    {{ $warehouse->id == $product->warehouse_id ? 'selected' : '' }}>
                                                                    {{ $warehouse->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-sm-3 col-form-label">{{ __('edit_product.quantite') }}</label>
                                                    <div class="col-sm-9">
                                                        <input name="quantity" type="text"
                                                            value="{{ $product->qty }}" class="form-control"
                                                            disabled />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-sm-3 col-form-label">{{ __('edit_product.brand') }}</label>
                                                    <div class="col-sm-9">
                                                        <input name="brand" type="text"
                                                            value="{{ $product->brand }}" class="form-control"
                                                            required />
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- Units and Prices -->
                                    <p class="card-description text-center"
                                        style="font-size: 1.5rem; font-weight: bold;">
                                        {{ __('edit_product.unit_price') }}</p>
                                    <div id="unitFields">
                                        @foreach ($productUnits as $unit)
                                            <div class="row unit-field">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label
                                                            class="col-sm-3 col-form-label">{{ __('edit_product.unit') }}</label>
                                                        <div class="col-sm-9">
                                                            <input name="unit[]" value="{{ $unit->unit }}"
                                                                placeholder="ex: 100 cl" type="text"
                                                                class="form-control" required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label
                                                            class="col-sm-3 col-form-label">{{ __('edit_product.price') }}</label>
                                                        <div class="col-sm-9">
                                                            <input name="price[]" value="{{ $unit->price }}"
                                                                placeholder="200" type="text" class="form-control"
                                                                required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 text-center">
                                                    <button type="button" class="btn btn-danger removeUnitButton"
                                                        style="width: 120px; font-size: 1rem; padding: 8px 16px;">{{ __('edit_product.remove') }}</button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Add New Unit Button -->
                                    <br />
                                    <div class="text-center mt-3">
                                        <button type="button" class="btn btn-primary" id="addUnitButton"
                                            style="width: 150px; font-size: 1rem; padding: 10px 20px;">{{ __('edit_product.add_unit') }}</button>
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
                                                                            <label class="col-sm-3 col-form-label">{{ __('edit_product.unit') }}</label>
                                                                            <div class="col-sm-9">
                                                                                <input name="unit[]" placeholder="ex: 100 cl" type="text" class="form-control"  required />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-3 col-form-label">{{ __('edit_product.price') }}</label>
                                                                            <div class="col-sm-9">
                                                                                <input name="price[]" placeholder="200 " type="text" class="form-control"  required />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- Remove Button -->
                                                                    <div class="col-md-12 text-center">
                                                                        <button type="button" class="btn btn-danger removeUnitButton" style="width: 120px; font-size: 1rem; padding: 8px 16px;">{{ __('edit_product.remove') }}</button>
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
                                        style="font-size: 1.5rem; font-weight: bold;">{{ __('edit_product.colors') }}
                                    </p>


                                    <div id="colorFieldsContainer">
                                        <!-- Existing colors will be appended here dynamically -->
                                        @if ($colors)
                                            @foreach ($colors as $color)
                                                <div class="d-flex justify-content-center">
                                                    <div class="row w-75"> <!-- w-75 to limit the width of the row -->
                                                        <div class="col-9">
                                                            <div class="form-group row">
                                                                <div class="col-12">
                                                                    <input value="{{ $color }}"
                                                                        name="colors[]"
                                                                        placeholder="ex: Red, Blue, #000000"
                                                                        type="text" class="form-control"
                                                                        style="color: #000; background-color: #f9f9f9;" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Remove Button -->
                                                        <div class="col-3 text-center">
                                                            <button type="button"
                                                                class="btn btn-danger removeColorButton"
                                                                style="width: 100%; font-size: 1rem; padding: 8px 16px;">{{ __('edit_product.remove') }}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>

                                    <div class="text-center mt-3">
                                        <!-- Button to add new color -->
                                        <button type="button" class="btn btn-primary" id="addColorButton"
                                            style="width: 150px; font-size: 1rem; padding: 10px 20px;">
                                            {{ __('edit_product.add_color') }}
                                        </button>
                                    </div>

                                    <script>
                                        // Select the button and the container where the fields will be appended
                                        const addColorButton = document.getElementById('addColorButton');
                                        const colorFieldsContainer = document.getElementById('colorFieldsContainer');

                                        // Function to add new color fields
                                        addColorButton.addEventListener('click', function() {
                                            const newColorFields = `
                                                   <div class="d-flex justify-content-center">
    <div class="row w-75"> <!-- w-75 to limit the width of the row -->
        <div class="col-9">
            <div class="form-group row">
                <div class="col-12">
                    <input name="colors[]" placeholder="ex: Red, Blue, #000000" type="text" 
                        class="form-control" style="color: #000; background-color: #f9f9f9;"  />
                </div>
            </div>
        </div>
        <!-- Remove Button -->
        <div class="col-3 text-center">
            <button type="button" class="btn btn-danger removeColorButton" 
                style="width: 100%; font-size: 1rem; padding: 8px 16px;">{{ __('edit_product.remove') }}</button>
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
                                                // Remove the parent row (color input and remove button)
                                                e.target.closest('.row').remove();
                                            }
                                        });
                                    </script>

                                    <p></p>
                                    <p class="card-description text-center"
                                        style="font-size: 1.5rem; font-weight: bold;">{{ __('edit_product.images') }}
                                    </p>
                                    <p></p>

                                    <!-- Images Section -->
                                    @if ($productImages && $productImages->count() > 0)
                                        <div class="row">
                                            @foreach ($productImages as $image)
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label
                                                            class="col-sm-3 col-form-label">{{ __('edit_product.product_image') }}</label>
                                                        <input id="image{{ $loop->index + 1 }}" type="file"
                                                            name="image{{ $loop->index + 1 }}"
                                                            class="file-upload-default">
                                                        <div class="input-group col-sm-9">
                                                            <input type="text" value="{{ $image->image_path }}"
                                                                class="form-control file-upload-info" disabled
                                                                placeholder="{{ __('edit_product.upload_image') }}">
                                                            <span class="input-group-append">
                                                                <button class="file-upload-browse btn btn-primary"
                                                                    type="button">{{ __('edit_product.upload') }}</button>
                                                            </span>
                                                            <span class="input-group-append">
                                                                <a href="{{ route('removeImage', $image->id) }}">
                                                                    <button class="file-upload-browse btn btn-danger"
                                                                        type="button">{{ __('edit_product.remove') }}</button>
                                                                </a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 text-center">
                                                        <img id="showImage{{ $loop->index + 1 }}"
                                                            src="{{ asset($image->image_path) }}"
                                                            style="width: 40%; border-radius: 3%;"
                                                            alt="Current Image">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif

                                    <!-- Display for products with fewer than 3 images -->
                                    @if ($productImages && $productImages->count() < 10)
                                        <div class="row">
                                            @for ($i = $productImages->count() + 1; $i <= 10; $i++)
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label
                                                            class="col-sm-3 col-form-label">{{ __('edit_product.product_image') }}
                                                            {{ $i }}</label>
                                                        <input id="image{{ $i }}" type="file"
                                                            name="image{{ $i }}"
                                                            class="file-upload-default"
                                                            {{ $productImages->count() == 3 ? 'disabled' : '' }}>
                                                        <div class="input-group col-sm-9">
                                                            <input type="text"
                                                                class="form-control file-upload-info" disabled
                                                                placeholder="{{ __('edit_product.upload_image') }}">
                                                            <span class="input-group-append">
                                                                <button class="file-upload-browse btn btn-primary"
                                                                    type="button">{{ __('edit_product.upload') }}</button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label"></label>
                                                        <div class="input-group col-sm-9">
                                                            <img id="showImage{{ $i }}"
                                                                style="width: 40%; border-radius: 3%;"
                                                                src="/admin/assets/images/no_image.jpg"
                                                                alt="product_image">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endfor
                                        </div>
                                    @endif

                                    <div class="col-md-12">
                                        <div class="d-flex justify-content-center">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label"></label>
                                                    <div class="input-group col-sm-9">
                                                        <button type="submit"
                                                            class="btn btn-info">{{ __('edit_product.update_product') }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
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
    <script src="admin/assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="admin/assets/js/file-upload.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // Loop through the image input fields (image1 to image10)
            for (let i = 1; i <= 10; i++) {
                $('#image' + i).change(function(e) {
                    var reader = new FileReader();
                    reader.onload = function(event) {
                        $('#showImage' + i).attr('src', event.target.result);
                    };
                    // Check if a file was selected before reading as data url
                    if (e.target.files && e.target.files[0]) {
                        reader.readAsDataURL(e.target.files[0]);
                    } else {
                        $('#showImage' + i).attr('src', "{{ asset('admin/assets/images/no_image.jpg') }}");
                    }

                });
            }
        });
    </script>
</body>

</html>
