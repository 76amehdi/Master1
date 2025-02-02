<style>
    /* Add this to your CSS file or within a <style> tag */
    .sidebar {
        height: 100vh;
        /* Make sidebar occupy full viewport height */
        overflow-y: auto;
        /* Enable vertical scrolling if content overflows */
        position: fixed;
        /* Fixed position so it doesn't scroll with the body */
        top: 0;
        left: 0;
        z-index: 10;
        /* Ensure it's above other content */
        /* Add these to ensure it's visible */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

        /* Optional: For visual separation */
    }

    /* Adjust main-panel to accommodate fixed sidebar */
    .page-body-wrapper {
        margin-left: 244px;
        /* Adjust to width of your sidebar if necessary */
    }

    @media (max-width: 768px) {

        /* Or your specific breakpoint */
        .page-body-wrapper {
            margin-left: 0;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 10;
            width: 250px;
            /* Adjust this to your desired width for smaller screens */
            transform: translateX(-250px);
            /* initially off screen */
            transition: transform 0.3s ease-in-out;
        }

        .sidebar.show {
            transform: translateX(0);
        }
    }

    .sidebar {
        max-height: 100vh;
        /* Adjust height as needed */
        overflow-y: auto;
        /* Enable vertical scrolling */
        scrollbar-width: thin;
        /* For Firefox: thin scrollbar */
        scrollbar-color: #a6b7ca #f4f4f4;
        /* For Firefox: thumb and track colors */
    }

    /* For WebKit Browsers (e.g., Chrome, Edge, Safari) */
    .sidebar::-webkit-scrollbar {
        width: 1px;
        /* Scrollbar width */
    }

    .sidebar::-webkit-scrollbar-thumb {
        background-color: #c8d4e2;
        /* Scrollbar thumb color */

    }

    .sidebar::-webkit-scrollbar-track {
        background-color: #f4f4f4;
        /* Scrollbar track color */
    }
</style>
<nav class="sidebar sidebar-offcanvas" id="sidebar">

    <ul class="nav">
        <li class="nav-item profile">
            <div class="profile-desc">
                <div class="profile-pic">
                    <div class="count-indicator">
                        <img class="img-xs rounded-circle"
                            src="{{ asset('admin/assets/images/faces-clipart/pic-1.png') }}" alt="">
                        <span class="count bg-success"></span>
                    </div>
                    <div class="profile-name">
                        <h5 class="mb-0 font-weight-normal">{{ Auth::user()->name }}</h5>
                        <span>{{ __('sidebar.admin') }}</span>
                    </div>
                </div>
                <a href="#" id="profile-dropdown" data-toggle="dropdown">
                    <i class="mdi mdi-dots-vertical"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list"
                    aria-labelledby="profile-dropdown">

                    <div class="dropdown-divider"></div>
                    <a href="{{ route('user.logout') }}" class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-dark rounded-circle">
                                <i class="mdi mdi-logout text-danger"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject mb-1">{{ __('sidebar.log_out') }}</p>
                        </div>
                    </a>
                </div>
            </div>
        </li>
        <li class="nav-item nav-category">
            <span class="nav-link">{{ __('sidebar.navigation') }}</span>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ route('dashboard', ['lang' => app()->getLocale()]) }}">
                <span class="menu-icon"><i class="mdi mdi-speedometer"></i></span>
                <span class="menu-title">{{ __('sidebar.dashboard') }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('users.index', ['lang' => app()->getLocale()]) }}">
                <span class="menu-icon"><i class="mdi mdi-account-group"></i></span>
                <span class="menu-title">{{ __('sidebar.users') }}</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('fournisseurs.index', ['lang' => app()->getLocale()]) }}">
                <span class="menu-icon"><i class="mdi mdi-account"></i></span>
                <span class="menu-title">{{ __('sidebar.fournisseurs') }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url(app()->getLocale() . '/admin/astuces') }}">
                <span class="menu-icon"><i class="mdi mdi-account-group"></i></span>
                <span class="menu-title">Blogs</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.category', ['lang' => app()->getLocale()]) }}">
                <span class="menu-icon"><i class="mdi mdi-cart-outline"></i></span>
                <span class="menu-title">{{ __('sidebar.categories') }}</span>
            </a>
        </li>



        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.settings', ['lang' => app()->getLocale()]) }}">
                <span class="menu-icon"><i class="mdi mdi-cog"></i></span>
                <span class="menu-title">{{ __('sidebar.settings') }}</span>
            </a>
        </li>


        <!-- Purchases Dropdown -->
        <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#purchases-dropdown" aria-expanded="false"
                aria-controls="purchases-dropdown">
                <span class="menu-icon"><i class="mdi mdi-cart"></i></span>
                <span class="menu-title">{{ __('sidebar.purchases') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="purchases-dropdown">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('purchases.index', ['lang' => app()->getLocale()]) }}">
                            <span class="menu-icon"><i class="mdi mdi-cart"></i></span>
                            <span class="menu-title">{{ __('sidebar.purchases') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('purchases.create', ['lang' => app()->getLocale()]) }}">
                            <span class="menu-icon"><i class="mdi mdi-plus"></i></span>
                            <span class="menu-title">{{ __('sidebar.add_purchase') }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <!-- Warehouses Dropdown -->
        <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#warehouses-dropdown" aria-expanded="false"
                aria-controls="warehouses-dropdown">
                <span class="menu-icon"><i class="mdi mdi-warehouse"></i></span>
                <span class="menu-title">{{ __('sidebar.warehouses') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="warehouses-dropdown">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link"
                            href="{{ route('admin.warehouse', ['lang' => app()->getLocale()]) }}">{{ __('sidebar.show') }}</a>
                    </li>
                    <li class="nav-item"><a class="nav-link"
                            href="{{ route('warehouses.transfer', ['lang' => app()->getLocale()]) }}">{{ __('sidebar.transfer_products') }}</a>
                    </li>
                </ul>
            </div>
        </li>
        <!-- Products Dropdown -->
        <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#products-dropdown" aria-expanded="false"
                aria-controls="products-dropdown">
                <span class="menu-icon"><i class="mdi mdi-package-variant"></i></span>
                <span class="menu-title">{{ __('sidebar.products') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="products-dropdown">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link"
                            href="{{ route('admin.view_product', ['lang' => app()->getLocale()]) }}">{{ __('sidebar.add_product') }}</a>
                    </li>
                    <li class="nav-item"><a class="nav-link"
                            href="{{ route('admin.show_product', ['lang' => app()->getLocale()]) }}">{{ __('sidebar.show_products') }}</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('customers', ['lang' => app()->getLocale()]) }}">
                <span class="menu-icon"><i class="mdi mdi-account-circle"></i></span>
                <span class="menu-title">{{ __('sidebar.customers') }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('contacts.index', ['lang' => app()->getLocale()]) }}">
                <span class="menu-icon"><i class="mdi mdi-contacts-outline"></i></span>
                <span class="menu-title">{{ __('sidebar.contacts') }}</span>
            </a>
        </li>
        
        <!-- Orders -->
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ route('admin.user_orders', ['lang' => app()->getLocale()]) }}">
                <span class="menu-icon"><i class="mdi mdi-basket"></i></span>
                <span class="menu-title">{{ __('sidebar.orders') }}</span>
                
            </a>
            

        </li>
        <!-- Reports Dropdown -->
        <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#reports-dropdown" aria-expanded="false"
                aria-controls="reports-dropdown">
                <span class="menu-icon"><i class="mdi mdi-ticket-percent-outline"></i></span>
                <span class="menu-title">{{ __('sidebar.reports') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="reports-dropdown">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('all.reports', ['lang' => app()->getLocale()]) }}">
                            <i class="mdi mdi-file-document"></i> {{ __('sidebar.all_economic_reports') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('reports.sales', ['lang' => app()->getLocale()]) }}">
                            <i class="mdi mdi-chart-bar"></i> {{ __('sidebar.sales_report') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="{{ route('reports.purchase_report', ['lang' => app()->getLocale()]) }}">
                            <i class="mdi mdi-cart"></i> {{ __('sidebar.purchase_report') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('combined.reports', ['lang' => app()->getLocale()]) }}">
                            <i class="mdi  mdi-chart-line"></i>{{ __('sidebar.combined_orders_report') }}</span>
                        </a>
                    </li>
                    
                    
                    <li class="nav-item">
                        <a class="nav-link"
                            href="{{ route('reports.warehouse_report', ['lang' => app()->getLocale()]) }}">
                            <i class="mdi mdi-home"></i> {{ __('sidebar.warehouse_report') }}
                        </a>
                    </li>
                    
                </ul>

            </div>
        </li>

    </ul>
</nav>

<!-- JavaScript to ensure only one dropdown is open at a time -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const collapses = document.querySelectorAll('.nav-link[data-toggle="collapse"]');
        collapses.forEach((collapse) => {
            collapse.addEventListener('click', function() {
                collapses.forEach((el) => {
                    if (el !== this) {
                        const target = document.querySelector(el.getAttribute('href'));
                        if (target && target.classList.contains('show')) {
                            target.classList.remove('show');
                        }
                    }
                });
            });
        });
    });
</script>
