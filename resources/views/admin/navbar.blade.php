<head>
    <link href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css" rel="stylesheet">
    <style>
        /* Low Stock Styles */
        #low-stock-toggle {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        #low-stock-dropdown {
            display: none;
            border-radius: 5px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        #low-stock-dropdown li {
            padding: 5px 10px;
            cursor: pointer;
        }

        #low-stock-dropdown li:hover {
            background-color: #000000;
        }

        /* Navbar Styles to handle main panel width */
        .main-panel {
            transition: width 0.3s ease; /* Add transition for smooth effect */
        }
        .main-panel.full-width {
            width: 100%;
            margin-left: 0;

        }

          .sidebar{
              transition: transform 0.3s ease-in-out;
        }
         .sidebar.show{
          transform: translateX(0);
        }
      .content-wrapper{
        transition: width 0.3s ease; /* Add transition for smooth effect */
      }
      .content-wrapper.full-width{
        width: 100%;
      }
      .container{
         transition: width 0.3s ease; /* Add transition for smooth effect */
      }
      .container.full-width{
        width: 100%;
      }
    </style>
</head>
<!-- Navbar starts -->
<nav class="navbar p-0 fixed-top d-flex flex-row">
    <!-- Brand Logo -->


    <!-- Navbar Menu -->
    <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
        <button id="sidebar-toggle-button" class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="mdi mdi-format-line-weight"></span>
        </button>
        
        <ul class="navbar-nav navbar-nav-right">
            <!-- Low Stock Products Dropdown -->
            <li class="nav-item dropdown">
                <div id="low-stock-dropdown-container" style="display: flex; align-items: center; position: relative;">
                    <!-- Circle to display count -->
                    <div id="low-stock-toggle" class=""
                        style="display: none; margin-right: 10px; border-radius: 50%; padding: 10px; cursor: pointer;">
                        <i id="low-stock-icon" class="mdi mdi-alert-circle-outline" style="color: #ff0000"></i>
                        <!-- Main Icon -->
                        <span id="low-stock-count" style="margin-left: 5px; color: #ff0000;">0</span>
                        <i id="low-stock-flesh" class="mdi mdi-chevron-down"
                            style="margin-left: 5px; color: #ff0000;"></i> <!-- Flesh Icon -->
                    </div>

                    <!-- Dropdown to select low stock products -->
                    <ul id="low-stock-dropdown" class="dropdown-menu"
                        style="display: none; position: absolute; top: 100%; left: 0; background: rgb(26, 25, 25); border: 1px solid #ccc; list-style: none; padding: 10px; min-width: 200px;">
                        <!-- Options will be dynamically populated -->
                    </ul>
                </div>
            </li>

            </li>
            <!-- Language Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle" id="languageDropdown" href="#"
                    data-toggle="dropdown">
                    <i class="mdi mdi-translate"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                    aria-labelledby="languageDropdown">
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item"
                        href="{{ url(implode('/', array_merge(['en'], array_slice(request()->segments(), 1)))) }}">
                        <div class="preview-item-content">
                            <p class="preview-subject mb-1">English</p>
                        </div>
                    </a>
                    <a class="dropdown-item preview-item"
                        href="{{ url(implode('/', array_merge(['ar'], array_slice(request()->segments(), 1)))) }}">
                        <div class="preview-item-content">
                            <p class="preview-subject mb-1">العربية</p>
                        </div>
                    </a>
                    <a class="dropdown-item preview-item"
                        href="{{ url(implode('/', array_merge(['fr'], array_slice(request()->segments(), 1)))) }}">
                        <div class="preview-item-content">
                            <p class="preview-subject mb-1">Français</p>
                        </div>
                    </a>
                </div>
            </li>

            <!-- Profile Dropdown -->
            @php
                $id = Auth::user()->id;
                $adminData = App\Models\User::find($id);
            @endphp
            <li class="nav-item dropdown">
                <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                    <div class="navbar-profile">
                        <img class="img-xs rounded-circle"
                            src="{{ asset('admin/assets/images/faces-clipart/pic-1.png') }}" alt="">
                        <p class="mb-0 d-none d-sm-block navbar-profile-name">{{ Auth::user()->name }}</p>
                        <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                    aria-labelledby="profileDropdown">
                    <h6 class="p-3 mb-0">{{ __('navbar.profile') }}</h6>
                    <div class="dropdown-divider"></div>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item"
                        href="{{ route('user.logout', ['lang' => app()->getLocale()]) }}">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-dark rounded-circle">
                                <i class="mdi mdi-logout text-danger"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject mb-1">{{ __('navbar.log_out') }}</p>
                        </div>
                    </a>
                </div>
            </li>
        </ul>
        
    </div>
</nav>
<!-- Navbar ends -->

<!-- Include the Vite bundle -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        let notifiedProducts = []; // To store IDs of notified products

        // Toggle dropdown visibility and change the flesh icon
        $('#low-stock-toggle').on('click', function() {
            $('#low-stock-dropdown').toggle(); // Toggle dropdown visibility

            const isVisible = $('#low-stock-dropdown').is(':visible');
            const fleshIcon = $('#low-stock-flesh');

            // Change flesh icon based on visibility
            if (isVisible) {
                fleshIcon.removeClass('mdi-chevron-down').addClass('mdi-chevron-up'); // Flesh up icon
            } else {
                fleshIcon.removeClass('mdi-chevron-up').addClass('mdi-chevron-down'); // Flesh down icon
            }
        });

        setInterval(function() {
            $.ajax({
                url: '/check-low-stock',
                type: 'GET',
                success: function(response) {
                    if (response.status === 'low_stock') {
                        let dropdown = $('#low-stock-dropdown');
                        let lowStockCount = 0; // Counter for low-stock products
                        dropdown.empty(); // Clear the dropdown before repopulating

                        // Loop through the response.products object
                        $.each(response.products, function(index, product) {
                            const imageTag = product.image_path ?
                                `<img src="${product.image_path}" alt="${product.title}" style="width: 30px; height: 30px; border-radius: 50%; margin-right: 10px;">` :
                                '<div style="width: 30px; height: 30px; border-radius: 50%; background: #ccc; margin-right: 10px;"></div>'; // Placeholder for missing images


                            // Add the product to the dropdown
                            dropdown.append(`
                                            <li style="display: flex; align-items: center; padding: 5px; cursor: pointer;">
                                               <a href="{{ route('purchases.create', ['lang' => app()->getLocale()]) }}?product_id=${product.id}"
                                               style="display: flex; align-items: center; text-decoration: none; color: inherit;">
                                                   ${imageTag}
                                                   <span>${product.id} : ${product.title}</span>
                                               </a>
                                            </li>
                                        `);

                            lowStockCount++;

                            // Notify for new low-stock products
                            if (!notifiedProducts.includes(product.id)) {
                                console.log(
                                    `Low stock alert for product: ${product.title}`
                                );
                                notifiedProducts.push(product.id);
                            }
                        });

                        // Update the count in the badge and toggle visibility
                        if (lowStockCount > 0) {
                            $('#low-stock-count').text(lowStockCount);
                            $('#low-stock-toggle').show();
                        } else {
                            $('#low-stock-toggle').hide();
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                }
            });
        }, 2000); // Execute every 2 seconds
    });
</script>

<script>
   document.addEventListener('DOMContentLoaded', function() {
        const body = document.querySelector('body');
        const sidebar = document.getElementById('sidebar'); // Get the sidebar element
        const mainPanel = document.querySelector('.main-panel'); //get the main panel
       const contentWrapper = document.querySelector('.content-wrapper'); //get the content wrapper
        const containerElement = document.querySelector('.container'); //get the container element
       const toggleButton = document.getElementById('sidebar-toggle-button'); //Get the button that toggle the sidebar

       function toggleSidebar() {
            if ((body.classList.contains('sidebar-toggle-display')) || (body.classList.contains('sidebar-absolute'))) {
                body.classList.toggle('sidebar-hidden');
                mainPanel.classList.toggle('full-width');
                contentWrapper.classList.toggle('full-width'); // Toggle content-wrapper width
                containerElement.classList.toggle('full-width')//toggle container width
            } else {
                body.classList.toggle('sidebar-icon-only');
                  mainPanel.classList.toggle('full-width');
                    contentWrapper.classList.toggle('full-width');
                     containerElement.classList.toggle('full-width')

            }
        }
        if (toggleButton) {
          toggleButton.addEventListener('click', function() {
           toggleSidebar(); // Call the toggle sidebar function
            if (sidebar.style.transform === 'translateX(-250px)' || !sidebar.style.transform) {
                 sidebar.style.transform =
                    'translateX(0)'; //Remove  transform if exists or not exist
                 sidebar.classList.add('show')

                } else {
                    sidebar.style.transform = 'translateX(-250px)'; //add  transform if removed
                     sidebar.classList.remove('show')
                }
            });
        }
    });
</script>