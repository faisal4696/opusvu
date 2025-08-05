<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">

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
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
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
                    <h1 class="h3 mb-0 text-white">Video Promotion</h1>
                    <a href="{{ URL::previous() }}" class="d-none d-sm-inline-block btn btn-sm shadow-sm" style="background: linear-gradient(117.04deg, #42C8DF 8.53%, #EE3678 88.82%); color: white;border: unset;"><i
                            class="fas fa-backward fa-sm text-white"></i> Back</a>
                </div>

                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        @if(Session::has('success'))<div class="alert alert-success">{{ Session::get('success') }}</div>@endif
                        @if(Session::has('error'))<div class="alert alert-danger">{{ Session::get('error') }}</div>@endif
                            @if($promotion != null)
                                <form action="{{ route('update-promotion') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="promotion_id" value="{{ $promotion->id }}">
                                    <div class="form-group">
                                        <label for="select-video">Select Promotion Video</label>
                                        <select name="video_id" id="" class="form-control Inputs">
                                            <option value="">---select---</option>
                                            @foreach($videos as $video)
                                                <option value="{{ $video->id }}">{{ $video->title }} (E) || {{ $video->title_spanish }} (S) || {{ $video->title_french }} (F)</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Title (English)</label>
                                        <input type="text" name="title" class="form-control Inputs" value="{{ $promotion->title }}"><br>
                                    </div>
                                    <div class="form-group">
                                        <label for="title-spanish">Title (Spanish)</label>
                                        <input type="text" name="title_spanish" class="form-control Inputs" value="{{ $promotion->title_spanish }}"><br>
                                    </div>
                                    <div class="form-group">
                                        <label for="title-french">Title (French)</label>
                                        <input type="text" name="title_french" class="form-control Inputs" value="{{ $promotion->title_french }}"><br>
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <img src="{{ asset($promotion->image) }}" alt="img" width="100%">
                                        <input type="file" name="image" class="form-control Inputs"><br>
                                    </div>
                                    {{--                                <div class="form-group">--}}
                                    {{--                                    <label for="video">Video</label>--}}
                                    {{--                                    <video class="video" width="100%" controls>--}}
                                    {{--                                        <source src="{{ asset($promotion->video) }}" type="video/mp4">--}}
                                    {{--                                        <source src="movie.ogg" type="video/ogg">--}}
                                    {{--                                        Your browser does not support the video tag.--}}
                                    {{--                                    </video>--}}
                                    {{--                                    <input type="file" name="video" class="form-control Inputs"><br>--}}
                                    {{--                                    <a class="btn custome-btn btn-sm" title="upload new promotion video" href="{{ route('edit-promotion-video-view',$promotion->id) }}">Upload New Video</a>--}}
                                    {{--                                </div>--}}
                                    {{--                                <div class="form-group">--}}
                                    {{--                                    <label for="description">Description (English)</label>--}}
                                    {{--                                    <textarea name="description" id="" cols="30" rows="5" class="form-control Inputs">{{ $promotion->description }}</textarea>--}}
                                    {{--                                </div>--}}
                                    {{--                                <div class="form-group">--}}
                                    {{--                                    <label for="description-spanish">Description (Spanish)</label>--}}
                                    {{--                                    <textarea name="description_spanish" id="" cols="30" rows="5" class="form-control Inputs">{{ $promotion->description_spanish }}</textarea>--}}
                                    {{--                                </div>--}}
                                    {{--                                <div class="form-group">--}}
                                    {{--                                    <label for="description-french">Description (French)</label>--}}
                                    {{--                                    <textarea name="description_french" id="" cols="30" rows="5" class="form-control Inputs">{{ $promotion->description_french }}</textarea>--}}
                                    {{--                                </div>--}}
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        @if($promotion->status == 'on')
                                            <label class="switch">
                                                <input type="checkbox" name="status" checked>
                                                <span class="slider round"></span>
                                            </label>
                                        @elseif($promotion->status == 'off')
                                            <label class="switch">
                                                <input type="checkbox" name="status">
                                                <span class="slider round"></span>
                                            </label>
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-sm custome-btn" style="border: unset;">Save</button>
                                </form><br>
                            @else
                                <form action="{{ route('add-promotion-video') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="select-video">Select Promotion Video</label>
                                        <select name="video_id" id="" class="form-control Inputs" required>
                                            <option value="">---select---</option>
                                            @foreach($videos as $video)
                                                <option value="{{ $video->id }}">{{ $video->title }} (E) || {{ $video->title_spanish }} (S) || {{ $video->title_french }} (F)</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Title (English)</label>
                                        <input type="text" name="title" class="form-control Inputs"><br>
                                    </div>
                                    <div class="form-group">
                                        <label for="title-spanish">Title (Spanish)</label>
                                        <input type="text" name="title_spanish" class="form-control Inputs"><br>
                                    </div>
                                    <div class="form-group">
                                        <label for="title-french">Title (French)</label>
                                        <input type="text" name="title_french" class="form-control Inputs"><br>
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input type="file" name="image" class="form-control Inputs"><br>
                                    </div>
                                    {{--                                <div class="form-group">--}}
                                    {{--                                    <label for="video">Video</label>--}}
                                    {{--                                    <video class="video" width="100%" controls>--}}
                                    {{--                                        <source src="{{ asset($promotion->video) }}" type="video/mp4">--}}
                                    {{--                                        <source src="movie.ogg" type="video/ogg">--}}
                                    {{--                                        Your browser does not support the video tag.--}}
                                    {{--                                    </video>--}}
                                    {{--                                    <input type="file" name="video" class="form-control Inputs"><br>--}}
                                    {{--                                    <a class="btn custome-btn btn-sm" title="upload new promotion video" href="{{ route('edit-promotion-video-view',$promotion->id) }}">Upload New Video</a>--}}
                                    {{--                                </div>--}}
                                    {{--                                <div class="form-group">--}}
                                    {{--                                    <label for="description">Description (English)</label>--}}
                                    {{--                                    <textarea name="description" id="" cols="30" rows="5" class="form-control Inputs">{{ $promotion->description }}</textarea>--}}
                                    {{--                                </div>--}}
                                    {{--                                <div class="form-group">--}}
                                    {{--                                    <label for="description-spanish">Description (Spanish)</label>--}}
                                    {{--                                    <textarea name="description_spanish" id="" cols="30" rows="5" class="form-control Inputs">{{ $promotion->description_spanish }}</textarea>--}}
                                    {{--                                </div>--}}
                                    {{--                                <div class="form-group">--}}
                                    {{--                                    <label for="description-french">Description (French)</label>--}}
                                    {{--                                    <textarea name="description_french" id="" cols="30" rows="5" class="form-control Inputs">{{ $promotion->description_french }}</textarea>--}}
                                    {{--                                </div>--}}
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <label class="switch">
                                            <input type="checkbox" name="status" checked>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-sm custome-btn" style="border: unset;">Save</button>
                                </form><br>
                            @endif
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
