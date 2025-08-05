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
                    <h1 class="h3 mb-0 text-white">Add New Video</h1>
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
                            </div>
                            <div id="details">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="name">Select Category</label>
                                    <select name="category_id" class="form-control form-select form-select-sm Inputs" required>
                                        <option value="">---SELECT---</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }} (E) || {{ $cat->name_spanish }} (S) || {{ $cat->name_french }} (F)</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="title-english">Video Title (English)</label>
                                    <input type="text" name="title" placeholder="Enter Video Title in English" class="form-control Inputs" required>
                                </div>
                                <div class="form-group">
                                    <label for="title-spanish">Video Title (Spanish)</label>
                                    <input type="text" name="title_spanish" placeholder="Enter Video Title in Spanish" class="form-control Inputs" required>
                                </div>
                                <div class="form-group">
                                    <label for="title-french">Video Title (French)</label>
                                    <input type="text" name="title_french" placeholder="Enter Video Title in French" class="form-control Inputs" required>
                                </div>
                                <div class="form-group">
                                    <label for="thumbnail">Thumbnail</label>
                                    <input type="file" id="thumb" name="thumb" class="form-control Inputs" required>
                                </div>
{{--                                <div class="form-group">--}}
{{--                                    <label for="attachment">Attachment</label>--}}
{{--                                    <input type="file" name="attachment" class="form-control Inputs" required>--}}
{{--                                </div>--}}
                                <div class="form-group">
                                    <label for="description-english">Video Descriptions (English)</label>
                                    <textarea name="description" id="" cols="30" rows=3 class="form-control Inputs" placeholder="Write Video Descriptions in English..." required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="description-spanish">Video Descriptions (Spanish)</label>
                                    <textarea name="description_spanish" id="" cols="30" rows=3 class="form-control Inputs" placeholder="Write Video Descriptions in Spanish..." required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="description-french">Video Descriptions (French)</label>
                                    <textarea name="description_french" id="" cols="30" rows=3 class="form-control Inputs" placeholder="Write Video Descriptions in French..." required></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="subtitle-english">Subtitle (English)</label>
                                            <input type="file" id="subtitle_eng" name="subtitle_eng" class="form-control Inputs">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="subtitle-spanish">Subtitle (Spanish)</label>
                                            <input type="file" id="subtitle_spanish" name="subtitle_spanish" class="form-control Inputs">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="subtitle-french">Subtitle (French)</label>
                                            <input type="file" id="subtitle_french" name="subtitle_french" class="form-control Inputs">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" id="submitBtn"  class="btn btn-sm custome-btn px-4" style="border: unset;">Submit</button>
                            </div>


                            <div class="form-group">
                                <input type="hidden" class="form-control" id="name" name="name" value="name">
                            </div>

{{--                                <div class="form-group">--}}
{{--                                    <label for="thumb">Thumb :</label>--}}
{{--                                    <input type="file" class="form-control" id="thumb" name="thumb" >--}}
{{--                                </div>--}}

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
