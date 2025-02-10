<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>
  <link rel="shortcut icon" type="image/png" href="{{asset('images/favicon.ico')}}" />
  <link rel="stylesheet" href="{{asset('css/styles.min.css')}}" />
  <style>
    .submenu {
      display: none;
      list-style-type: none;
      padding-left: 0;
      margin-top: 5px;
      max-height: 0; /* Initially, no height */
      overflow: hidden;
      transition: max-height 0.3s ease-out; /* Smooth animation for height */
    }
  
    .submenu li {
      padding: 8px;
      margin-left: 15px;
      display: flex;
      align-items: center; /* Align icon and text horizontally */
    }
  
    .submenu-icon {
      margin-right: 10px; /* Space between the icon and text */
      font-size: 18px; /* Size of the icons */
    }
  
    .sidebar-item.drop .submenu {
      display: block;
      max-height: 500px; /* Expand to a max height when active */
    }
  </style>
  
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed"  data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-center p-4">
          <div class="logo">
            <a href="{{route('dashboard')}}" class="text-wrap logo-img">
              <img src="{{asset('images/college logo.png')}}" alt=""  style="width: 90%" />
            </a>
          </div>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('dashboard')}}" aria-expanded="false">
                <iconify-icon icon="solar:widget-add-line-duotone"></iconify-icon>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('visitors.index')}}" aria-expanded="false">
                <iconify-icon icon="solar:users-group-rounded-bold-duotone"></iconify-icon>
                <span class="hide-menu">Visitors</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('enquiry.index')}}" aria-expanded="false">
                <iconify-icon icon="tabler:report"></iconify-icon>
                <span class="hide-menu">Enquiry Report</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./callsetup.html" aria-expanded="false">
                <iconify-icon icon="material-symbols:call"></iconify-icon>
                <span class="hide-menu">Call Setup</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./emailsetup.html" aria-expanded="false">
                <iconify-icon icon="ic:baseline-email"></iconify-icon>
                <span class="hide-menu">Email Setup</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="#" aria-expanded="false" onclick="toggleDropdown(event)">
                <iconify-icon icon="material-symbols-light:category"></iconify-icon>
                <span class="hide-menu">Category</span>
                <iconify-icon class="arrow" icon="material-symbols:keyboard-arrow-down"></iconify-icon>
              </a>
              <ul class="submenu" id="dropdownMenu">
                <li><a href="{{ route('category.VisitorCategory') }}"><iconify-icon icon="mdi:account-group" class="submenu-icon"></iconify-icon> Visitor Category</a></li>
                <li><a href="./enquiry-category.html"><iconify-icon icon="mdi:comment-question" class="submenu-icon"></iconify-icon> Enquiry Category</a></li>
              </ul>
            </li>
            
            
            <script>
              function toggleDropdown(event) {
                event.preventDefault();  // Prevent default behavior of the anchor link
            
                const sidebarItem = event.currentTarget.closest('.sidebar-item');
                const menu = sidebarItem.querySelector('.submenu');
                const arrow = sidebarItem.querySelector('.arrow');
                
                // Toggle the 'active' class
                sidebarItem.classList.toggle('drop');
            
                // If the menu is now visible, rotate the arrow
                if (sidebarItem.classList.contains('drop')) {
                  arrow.icon = 'material-symbols:keyboard-arrow-down'; // Up arrow when visible
                } else {
                  arrow.icon = 'material-symbols:keyboard-arrow-right'; // Down arrow when hidden
                }
              }
            </script>
            
            <li>
              <span class="sidebar-divider lg"></span>
            </li>
            <li class="nav-small-cap">
              <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
              <span class="hide-menu">Administration</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./ui-buttons.html" aria-expanded="false">
                <iconify-icon icon="oui:app-users-roles"></iconify-icon>
                <span class="hide-menu">Roles</span>
              </a>
            </li>
            
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-between">
              <li class="nav-item d-block d-xl-none">
                <a class="nav-link sidebartoggler " id="headerCollapse" href="javascript:void(0)">
                  <i class="ti ti-menu-2"></i>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link " href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false"><p class="px-2 pt-3">Hi, Admin</p>  
                  <img src="{{asset('images/user-1.jpg')}}" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                      @csrf
                      <button type="submit" class="btn btn-outline-primary mx-3 mt-2">Logout</button>
                  </form>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <div class="body-wrapper">
        <div class="container-fluid mw-100">
            <div class="card card-body">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="d-sm-flex align-items-center justify-space-between">
                            <!-- Display last path in title -->
                            <h4 class="fw-semibold fs-4 mb-4 mb-md-0 card-title">
                                {{ ucfirst(Request::segment(count(Request::segments()))) }} Report
                            </h4>
                            <nav aria-label="breadcrumb" class="ms-auto">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item d-flex align-items-center">
                                        <a class="text-muted text-decoration-none d-flex" href="{{ url('/') }}">
                                            <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                            
                                        </a>
                                    </li>
                                    <!-- Display the last segment of the URL -->
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                            {{ ucfirst(Request::segment(count(Request::segments()))) }}
                                        </span>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>  
    

            <!---Content Start-->
          @yield('content')
            <!---Content End-->

          <div class="py-6 px-6 text-center">
            <p class="mb-0 fs-4">Developed with  <iconify-icon icon="line-md:heart-filled"></iconify-icon> by <a style="text-decoration: none; " href="https://sionasolutions.com/" target="_blank"
                class="pe-1 text-primary ">Siona Solutions</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="{{asset('libs/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('js/sidebarmenu.js')}}"></script>
  <script src="{{asset('js/app.min.js')}}"></script>
  <script src="{{asset('libs/apexcharts/dist/apexcharts.min.js')}}"></script>
  <script src="{{asset('libs/simplebar/dist/simplebar.js')}}"></script>
  <script src="{{asset('js/dashboard.js')}}"></script>
  <!-- solar icons -->
  
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>