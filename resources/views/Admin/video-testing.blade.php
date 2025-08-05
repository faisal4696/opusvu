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

        <!-- Begin Page Content -->
            <div class="container-fluid" style="background: #000000;">

                <!-- Page Heading -->

                <div class="row">
                    <div class="col-md-12">
                        <div class="progress" style="height: 20px; margin-bottom: 25px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 0%%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div id="dropzone">
                            <!-- <form class="dropzone dz-clickable" id="file-upload"> -->
                            <form class="dropzone dz-clickable" id="fileUpload">
                                @csrf
                                <div class="dz-message">Drop files here or click to upload.
                                    <br> <span class="note">(Input name and Click Upload)</span>
                                </div>
                        </div>
                        <hr>
                        <div id="details">
                            <div class="form-group">
                                <label for="name">Name :</label>
                                <input type="text" class="form-control" id="name" name="name" required="required">
                            </div>

                            <div class="form-group">
                                <label for="thumb">Thumb :</label>
                                <input type="file" class="form-control" id="thumb" name="thumb" required="required">
                            </div>
                            <button type="submit" id="submitBtn" class="btn btn-info">Submit</button>
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
