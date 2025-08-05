<!DOCTYPE html>
<html lang="en">

@include('admin.includes.head')
<style>
    .Inputs{
        background: transparent;
        border-radius: unset;
        border: unset;
        border-bottom: 1px solid #4F4F4F;
        padding: unset;
    }
    .Inputs:focus{
        box-shadow: none;
    }
    label {
        color: #39D1E5;
    }
    .custome-btn{
        background: linear-gradient(117.04deg, #42C8DF 8.53%, #FF00FF 88.82%);
        color: white;
    }
    .custome-btn:hover{
        color: white;
    }
    form.d-none.d-sm-inline-block.form-inline.mr-auto.ml-md-3.my-2.my-md-0.mw-100.navbar-search {
        display: none !important;
    }
    form#fileUpload {
        background: lightblue;
    }
</style>
<body id="page-top" class="body">

<!-- Page Wrapper -->
<div id="wrapper">

@include('admin.includes.sidebar')

<!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content" style="background: #000000;">

        @include('admin.includes.topbar')

        <!-- Begin Page Content -->
            <div class="container-fluid" style="background: #000000;">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-white">Upload New Promotion Video</h1>
                    <a href="{{ URL::previous() }}" class="d-none d-sm-inline-block btn btn-sm shadow-sm" style="background: linear-gradient(117.04deg, #42C8DF 8.53%, #EE3678 88.82%); color: white;border: unset;"><i
                            class="fas fa-backward fa-sm text-white"></i> Back</a>
                </div>

                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        @if(Session::has('success'))<div class="alert alert-success">{{ Session::get('success') }}</div>@endif
                        @if(Session::has('error'))<div class="alert alert-danger">{{ Session::get('error') }}</div>@endif
                        <div id="dropzone">
                            <form class="dropzone dz-clickable" id="fileUpload">
                                @csrf
                                <div class="dz-message">Drop Video here
                                    {{--                                <br> <span class="note">(Input name and Click Upload)</span>--}}
                                </div>
                        </div><br>
                        <div id="details">
                            <div class="form-group">
                                <button type="submit" id="submitBtn"  class="btn btn-sm custome-btn px-4" style="border: unset;">Submit</button>
                            </div>

                            <div class="form-group">
                                <input type="hidden" class="form-control" id="promotion_video_id" name="promotion_video_id" value="{{ $promotionVideo->id }}">
                            </div>

                            <div class="form-group">
                                <input type="hidden" class="form-control" id="name" name="name" value="name">
                            </div>

                            <div class="form-group">
                                <input type="hidden" id="thumb" name="thumb" class="form-control Inputs">
                            </div>

                        </div>
                        </form>
                        <div class="progress" style="height: 20px; margin-bottom: 25px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>

            </div>
            <!-- End of Main Content -->

            @include('admin.includes.footer')

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

@include('admin.includes.script')

</body>

</html>
