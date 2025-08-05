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
                    <h1 class="h3 mb-0 text-white">All Users</h1>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        @if(Session::has('success'))<div class="alert alert-success">{{ Session::get('success') }}</div>@endif
                        @if(Session::has('error'))<div class="alert alert-danger">{{ Session::get('error') }}</div>@endif
                        <table class="table table-borderless table-responsive-md text-white">
                            <thead>
                            <th scope="col">#</th>
                            <th scope="col">User Name</th>
                            <th scope="col">User Email</th>
                            <th scope="col">Date-of-Birth</th>
                            <th scope="col">User Image</th>
                            <th scope="col">Action</th>
                            </thead>
                            @php $i = 0; @endphp
                            @foreach($users as $key=>$val)
                                <tbody id="myTable">
                                <th scope="row">{{ $users->firstItem()+$i }}</th>
                                <td scope="row">{{ $val->name }}</td>
                                <td scope="row">{{ $val->email }}</td>
                                <td scope="row">{{ $val->date_of_birth }}</td>
                                <td scope="row">@if($val->image) <a href="{{ asset('uploads/users/'.$val->image) }}" target="_blank"><img src="{{ asset('uploads/users/'.$val->image) }}" alt="user-img" style="height: 50px; width: 50px;"></a> @else N/A @endif</td>
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
                                                <div class="modal-body text-danger text-center">Are You Sure You Want to Delete this User?<br>User Name: <strong>{{ $val->name }}<br>User Email: <strong>{{ $val->email }}</strong></strong></div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                    <a class="btn btn-danger" href="{{ route('delete-user',$val->id) }}">Delete</a>
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
                                                <form action="{{ route('edit-user') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label class="text-dark" for="user-name">User Name</label>
                                                            <input type="text" name="name" class="form-control" value="{{ $val->name }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="text-dark" for="date-of-birth">Date of Birth</label>
                                                            <input type="date" name="date_of_birth" class="form-control" value="{{ $val->date_of_birth }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="text-dark" for="image">Image</label>
                                                            <input type="file" name="image" class="form-control">
                                                        </div>
                                                        <input type="hidden" name="user_id" value="{{ $val->id }}">
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
                                {!! $users->links() !!}
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
