<!DOCTYPE html>
<html lang="en">
    @include('admin.layout.partials.head') <!-- Includes meta, CSS, etc. -->

    <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
        <!--begin::App Wrapper-->
        <div class="app-wrapper">
            @include('admin.layout.partials.navbar') <!-- Navbar -->
            @include('admin.layout.partials.sidebar') <!-- Sidebar -->

            <!--begin::App Main-->
            <main class="app-main">
                <!--begin::App Content Header-->
                <div class="app-content-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="mb-0">@yield('page-title', 'Dashboard')</h3>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-end">
                                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">@yield('breadcrumb', 'Dashboard')</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::App Content Header-->

                <!--begin::App Content-->
                <div class="app-content">
                    <div class="container-fluid">
                        @yield('content') <!-- Child views will inject content here -->
                    </div>
                </div>
                <!--end::App Content-->
            </main>
            <!--end::App Main-->

            @include('admin.layout.partials.footer') <!-- Optional footer -->
        </div>
        <!--end::App Wrapper-->
    </body>
</html>