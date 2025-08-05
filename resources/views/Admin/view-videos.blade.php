<!DOCTYPE html>
<html lang="en">

@include('admin.includes.head')
<style>
    .custome-btn{
        background: linear-gradient(91.57deg, #42C8DF 0%, #EE3678 100%);
        border: unset;
    }
    .custome-btn i{
        color: white;
    }
    .page-item.active .page-link {
        z-index: 3;
        color: #fff;
        background: linear-gradient(
            91.57deg
            , #42C8DF 0%, #EE3678 100%);
    }
    .page-item:first-child .page-link{
        margin-left: 0;
        border-top-left-radius: .35rem;
        border-bottom-left-radius: .35rem;
        background: #111;
        color: gray;
    }
    .page-item:last-child .page-link {
        border-top-right-radius: .35rem;
        border-bottom-right-radius: .35rem;
        background: #111;
        color: gray;
    }
    .page-link {
        position: relative;
        display: block;
        padding: .5rem .75rem;
        margin-left: -1px;
        line-height: 1.25;
        color: #4e73df;
        border: 1px solid #dddfeb;
        background: #333;
        color: gray;
    }
    form#fileUpdate {
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
                    <h1 class="h3 mb-0 text-white">All Videos</h1>
                    <a href="{{ route('add-video') }}" class="d-none d-sm-inline-block btn btn-sm shadow-sm" style="background: linear-gradient(117.04deg, #42C8DF 8.53%, #EE3678 88.82%); color: white;border: unset;"><i
                            class="fas fa-plus fa-sm text-white"></i> Add New</a>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        @if(Session::has('success'))<div class="alert alert-success">{{ Session::get('success') }}</div>@endif
                        @if(Session::has('error'))<div class="alert alert-danger">{{ Session::get('error') }}</div>@endif
                        <table class="table table-borderless table-responsive text-white">
                            <thead>
                            <th scope="col">#</th>
                            <th scope="col">Category Name (E)</th>
                            <th scope="col">Category Name (S)</th>
                            <th scope="col">Category Name (F)</th>
                            <th scope="col">Video Title (E)</th>
                            <th scope="col">Video Title (S)</th>
                            <th scope="col">Video Title (F)</th>
                            <th scope="col">Video Thumbnail</th>
                            <th scope="col">Video</th>
                            <th scope="col">Description (E)</th>
                            <th scope="col">Description (S)</th>
                            <th scope="col">Description (F)</th>
                            <th scope="col">Action</th>
                            </thead>
                            @php $i = 0; @endphp
                            @foreach($videos as $key=>$val)
                                <tbody id="myTable">
                                <th scope="row">{{ $videos->firstItem()+$i }}</th>
                                <td scope="row">{{ $val->category->name }}</td>
                                <td scope="row">{{ $val->category->name_spanish }}</td>
                                <td scope="row">{{ $val->category->name_french }}</td>
                                <td scope="row">{{ $val->title }}</td>
                                <td scope="row">{{ $val->title_spanish }}</td>
                                <td scope="row">{{ $val->title_french }}</td>
                                <td scope="row"><a href="{{ asset($val->thumbnail) }}" target="_blank"><img src="{{ asset($val->thumbnail) }}" alt="thumbnail" height="50px" width="50px"></a></td>
                                <td scope="row">
                                    <button class="btn custome-btn btn-sm" data-toggle="modal" data-target="#videoPlayModal{{ $val->id }}" title="Play Video"><i class="fas fa-play"></i></button>
                                    <!-- Start Play Video Modal-->
                                    <div class="modal fade" id="videoPlayModal{{ $val->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                         aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-dark" id="exampleModalLabel">{{ $val->title }}</h5>
                                                    <button class="close stopVideo" value="video{{ $val->id }}" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <video class="video" width="100%" controls>
                                                        <source src="{{ asset($val->attachment) }}" type="video/mp4">
                                                        <source src="movie.ogg" type="video/ogg">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary stopVideo" value="video{{ $val->id }}" type="button" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--- End Play Video modal --->
                                </td>
                                <td scope="row">{{ $val->description }}</td>
                                <td scope="row">{{ $val->description_spanish }}</td>
                                <td scope="row">{{ $val->description_french }}</td>
                                <td scope="row">
                                    <button class="btn custome-btn btn-sm" data-toggle="modal" data-target="#deleteModal{{ $val->id }}" title="Delete"><i class="fas fa-trash"></i></button>
                                    <a class="btn custome-btn btn-sm" title="upload new video" href="{{ route('edit-video-view',$val->id) }}"><i class="fas fa-video"></i></a>
                                    <button class="btn custome-btn btn-sm" data-toggle="modal" data-target="#editModal{{ $val->id }}" title="Edit"><i class="far fa-edit"></i></button>
                                    <!-- Start Delete Modal-->
                                    <div class="modal fade" id="deleteModal{{ $val->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                         aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-dark" id="exampleModalLabel">Ready to Delete?</h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-danger text-center">Are You Sure You Want to Delete this Video?</div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                    <a class="btn btn-danger" href="{{ route('delete-video',$val->id) }}">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--- end delete modal --->

                                    <!-- start edit modal -->
                                    <div class="modal fade" id="editModal{{ $val->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                         aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-dark" id="exampleModalLabel">Ready to Update?</h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('edit-video') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label class="text-dark" for="category-name">Category Name</label>
                                                            <select name="category_id" id="" class="form-control">
                                                                <option value="">---SELECT---</option>
                                                                @foreach($categories as $cat)
                                                                    <option value="{{ $cat->id }}">{{ $cat->name }} (E) || {{ $cat->name_spanish }} (S) || {{ $cat->name_french }} (F)</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="text-dark" for="video-title">Video Title (English)</label>
                                                            <input type="text" name="title" class="form-control" value="{{ $val->title }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="text-dark" for="video-title-spanish">Video Title (Spanish)</label>
                                                            <input type="text" name="title_spanish" class="form-control" value="{{ $val->title_spanish }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="text-dark" for="video-title-french">Video Title (French)</label>
                                                            <input type="text" name="title_french" class="form-control" value="{{ $val->title_french }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="text-dark" for="thumbnail">Thumbnail</label>
                                                            <input type="file" name="thumbnail" class="form-control">
                                                        </div>
{{--                                                        <div class="form-group">--}}
{{--                                                            <label class="text-dark" for="attachment">Attachment</label>--}}
{{--                                                            <input type="file" name="attachment" class="form-control">--}}
{{--                                                        </div>--}}
                                                        <div class="form-group">
                                                            <label class="text-dark" for="description">Video Descriptions (English)</label>
                                                            <textarea name="description" id="" cols="30" rows="3" class="form-control" required>{{ $val->description }}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="text-dark" for="description-spanish">Video Descriptions (Spanish)</label>
                                                            <textarea name="description_spanish" id="" cols="30" rows="3" class="form-control" required>{{ $val->description_spanish }}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="text-dark" for="description-french">Video Descriptions (French)</label>
                                                            <textarea name="description_french" id="" cols="30" rows="3" class="form-control" required>{{ $val->description_french }}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="text-dark" for="subtitle-english">Subtitle (English)</label>
                                                            <input type="file" name="subtitle_eng" class="form-control Inputs">
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="text-dark" for="subtitle-spanish">Subtitle (Spanish)</label>
                                                            <input type="file" name="subtitle_spanish" class="form-control Inputs">
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="text-dark" for="subtitle-french">Subtitle (French)</label>
                                                            <input type="file" name="subtitle_french" class="form-control Inputs">
                                                        </div>
                                                        <input type="hidden" name="video_id" value="{{ $val->id }}">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-warning">Edit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end edit modal -->
                                </td>
                                </tbody>
                                @php $i++; @endphp
                                @endforeach
                        </table>
                            <div class="d-flex flex-row-reverse">
                                {!! $videos->links() !!}
                            </div>
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
