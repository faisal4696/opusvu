<!DOCTYPE html>
<html lang="en">

@include('admin.includes.head')
<style>
    .categoryInput{
        background: transparent;
        border-radius: unset;
        border: unset;
        border-bottom: 1px solid #4F4F4F;
        padding: unset;
    }
    .categoryInput:focus{
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
                    <h1 class="h3 mb-0 text-white">Add New Category</h1>
                    <a href="{{ URL::previous() }}" class="d-none d-sm-inline-block btn btn-sm shadow-sm" style="background: linear-gradient(117.04deg, #42C8DF 8.53%, #EE3678 88.82%); color: white;border: unset;"><i
                            class="fas fa-backward fa-sm text-white"></i> Back</a>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        @if(Session::has('success'))<div class="alert alert-success">{{ Session::get('success') }}</div>@endif
                        @if(Session::has('error'))<div class="alert alert-danger">{{ Session::get('error') }}</div>@endif
                        <form action="{{ route('new-category') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Category Name</label>
                                <input type="text" name="name" class="form-control categoryInput" placeholder="Enter Category Name" required><br>
                                <button type="submit" class="btn btn-sm custome-btn" style="border: unset;">Submit</button>
                            </div>
                        </form>
                    </div>
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
