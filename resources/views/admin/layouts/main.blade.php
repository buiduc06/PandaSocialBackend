<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="/images/logo_2.png">
    <title>@yield('title', 'Quản trị | Mạng xã hội học tập panda')</title>
    <!-- Custom CSS -->
    @include('admin.layouts.css')
    @yield('css')
    @stack('css')
</head>

<body>
    <style>
        .preloader{
            width: 100%;
            height: 100%;
            background-color: black;
        }
    </style>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
 
    <div class="modal fade" style="background-color: rgba(17, 17, 17, 0.6);" id="preloader_2" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="container text-center" style="display: flex;align-items: center;justify-content: center;width: 100%;min-height: 100%">
                <div class="col-sm-3">
                    <img src="https://loading.io/spinners/microsoft/lg.rotating-balls-spinner.gif" width="100px" height="auto">
                    <h5 style="color:white;" class="mt-2">Đang tải video lên cloud</h5> 
                </div>
            </div>
             </div>
        
        
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        @include('admin.layouts.header')
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        @include('admin.layouts.aside')
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            @hasSection('breadcrumb')
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Responsive Table</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Library</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex no-block justify-content-end align-items-center">
                            <div class="m-r-10">
                                <div class="lastmonth"></div>
                            </div>
                            <div class=""><small>LAST MONTH</small>
                                <h4 class="text-info m-b-0 font-medium">$58,256</h4></div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Container fluid  -->
                <!-- ============================================================== -->
                <div class="container-fluid">
                   @yield('content')
               </div>
               <!-- ============================================================== -->
               <!-- End Container fluid  -->
               <!-- ============================================================== -->
               <!-- ============================================================== -->
               <!-- footer -->
               <!-- ============================================================== -->
               <footer class="footer text-center">
                 All Rights Reserved by Xtreme admin. Designed and Developed by <a href="https://wrappixel.com/">WrapPixel</a>.
             </footer>
             <!-- ============================================================== -->
             <!-- End footer -->
             <!-- ============================================================== -->
         </div>
         <!-- ============================================================== -->
         <!-- End Page wrapper  -->
         <!-- ============================================================== -->
     </div>
     <!-- ============================================================== -->
     <!-- End Wrapper -->
     <!-- ============================================================== -->
     <!-- ============================================================== -->
     <!-- customizer Panel -->
     <!-- ============================================================== -->
     @include('admin.layouts.aside_settings')
     <div class="chat-windows"></div>
     <!-- ============================================================== -->
     <!-- All Jquery -->
     <!-- ============================================================== -->
     @include('admin.layouts.js')

     @yield('js')
     @if(Session()->has('msg'))
     <script>
         toastr.success("{{Session::get('msg')}}", 'Thành Công', {timeOut: 5000});
     </script>
     @endif

     @if(Session()->has('msg_error'))
     <script>
         toastr.error("{{Session::get('msg_error')}}", 'Lỗi', {timeOut: 5000})
     </script>
     @endif
{{--     <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="vendor/datatables-bs/js/dataTables.bootstrap.min.js"></script> --}}
@stack('js')
  
 

</body>
</html>