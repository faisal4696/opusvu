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
                    <h1 class="h3 mb-0 text-white">Advertisements</h1>
                    <a href="" class="d-none d-sm-inline-block btn btn-sm shadow-sm" data-toggle="modal" data-target="#addModal" title="Add New Advertisement" style="background: linear-gradient(117.04deg, #42C8DF 8.53%, #EE3678 88.82%); color: white;border: unset;"><i
                            class="fas fa-plus fa-sm text-white"></i> Add New</a>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        @if(Session::has('success'))<div class="alert alert-success">{{ Session::get('success') }}</div>@endif
                        @if(Session::has('error'))<div class="alert alert-danger">{{ Session::get('error') }}</div>@endif
                        <table class="table table-borderless table-responsive-md text-white">
                            <thead>
                            <th scope="col">#</th>
                            <th scope="col">Image</th>
                            <th scope="col">Place</th>
                            <th scope="col">Link</th>
                            <th scope="col">Action</th>
                            </thead>
                            @php $i = 0; @endphp
                            @foreach($advertisements as $key=>$val)
                                <tbody id="myTable">
                                <th scope="row">{{ $advertisements->firstItem()+$i }}</th>
                                <td scope="row"><a href="{{ asset($val->image) }}" target="_blank"><img src="{{ asset($val->image) }}" alt="image" height="50px" width="50px"></a></td>
                                <td scope="row">{{ $val->place }}</td>
                                <td scope="row">{{ $val->link }}</td>
                                <td scope="row">
                                    <button class="btn custome-btn btn-sm" data-toggle="modal" data-target="#deleteModal{{ $val->id }}" title="Delete"><i class="fas fa-trash"></i></button>
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
                                                <div class="modal-body text-danger text-center">Are You Sure You Want to Delete this Advertisement ?</div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                    <a class="btn btn-danger" href="{{ route('delete-advertisement',$val->id) }}">Delete</a>
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
                                                <form action="{{ route('edit-advertisement') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label class="text-dark" for="image">Image</label>
                                                            <input type="file" class="form-control" name="image">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="text-dark" for="place">place</label>
                                                            <select name="place" class="form-control" id="">
                                                                <option value="">---select---</option>
                                                                <option value="banner">Banner</option>
                                                                <option value="bottom">Bottom</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="text-dark" for="link">Link</label>
                                                            <input type="text" name="link" class="form-control" value="{{ $val->link }}">
                                                        </div>
                                                        <input type="hidden" name="advertisement_id" value="{{ $val->id }}">
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
                            {!! $advertisements->links() !!}
                        </div>
                    </div>

                    <!-- start edit modal -->
                    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-dark" id="exampleModalLabel">Add New Advertisement</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                @if(count($errors) > 0)
                                    @foreach($errors->all() as $error)
                                        <div class="alert alert-danger">{{ $error }}</div>
                                    @endforeach
                                @endif
                                <form action="{{ route('add-advertisement') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label class="text-dark" for="image">Image</label>
                                            <input type="file" class="form-control" name="image" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-dark" for="place">place</label>
                                            <select name="place" class="form-control" id="" required>
                                                <option value="">---select---</option>
                                                <option value="banner">Banner</option>
                                                <option value="bottom">Bottom</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-dark" for="link">Link</label>
                                            <input type="text" name="link" class="form-control" required>
                                        </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-warning">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- end edit modal -->

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
