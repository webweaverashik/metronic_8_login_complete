<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
@include('layouts.partials.head')
<!--end::Head-->
<!--begin::Body-->

<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true"
    data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true"
    data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true"
    class="app-default">
    <!--begin::Theme mode setup on page load-->
    @include('layouts.partials.theme-mode')
    <!--end::Theme mode setup on page load-->
    <!--begin::App-->
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <!--begin::Page-->
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            <!--begin::Header-->
            @include('layouts.partials.header')
            <!--end::Header-->
            <!--begin::Wrapper-->
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                <!--begin::Sidebar-->
                @include('layouts.partials.sidebar')
                <!--end::Sidebar-->
                <!--begin::Main-->
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    <!--begin::Content wrapper-->
                    <div class="d-flex flex-column flex-column-fluid">
                        @yield('content')
                    </div>
                    <!--end::Content wrapper-->
                    <!--begin::Footer-->
                    @include('layouts.partials.footer')
                    <!--end::Footer-->
                </div>
                <!--end:::Main-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::App-->
    <!--begin::Drawers-->
    @yield('drawers')
    <!--end::Drawers-->
    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <i class="ki-duotone ki-arrow-up">
            <span class="path1"></span>
            <span class="path2"></span>
        </i>
    </div>
    <!--end::Scrolltop-->
    <!--begin::Modals-->
    @yield('modals')
    <!--end::Modals-->
    <!--begin::Javascript-->
    <script>
        var hostUrl = "assets/";
    </script>
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="assets/plugins/global/plugins.bundle.js"></script>
    <script src="assets/js/scripts.bundle.js"></script>
    <!--end::Global Javascript Bundle-->
    @stack('vendor-scripts')
    @stack('custom-scripts')

    <!--Ashik:jQuery AJAX Logout-->
    <script>
        $(document).on('click', '.button-ajax', function(e) {
            e.preventDefault();
            var action = $(this).data('action');
            var method = $(this).data('method');
            var csrf = $(this).data('csrf');
            var reload = $(this).data('reload');

            axios({
                    url: action,
                    method: method,
                    headers: {
                        'X-CSRF-TOKEN': csrf // Send CSRF token in headers
                    },
                    // If your server expects the token in the request body, you can also send it like this:
                    // data: method.toLowerCase() === 'post' ? { _token: csrf } : null,
                })
                .then(function(response) {
                    console.log(response);
                    if (response.status === 204 || response.status === 200) { // Check for success status
                        if (reload) {
                            window.location.reload();
                        } else {
                            window.location.href = '/'; // or your login route
                        }
                    } else {
                        console.error('Logout failed:', response);
                    }
                })
                .catch(function(error) {
                    console.error('Logout error:', error);
                });
        });
    </script>
    <!--end::Javascript-->
</body>
<!--end::Body-->

</html>
