<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">

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
                    <h1 class="h3 mb-0 text-white">All Categories</h1>
                    <a href="" data-toggle="modal" data-target="#categoryModal" class="d-none d-sm-inline-block btn btn-sm shadow-sm" style="background: linear-gradient(117.04deg, #42C8DF 8.53%, #EE3678 88.82%); color: white;border: unset;"><i
                            class="fas fa-plus fa-sm text-white"></i> Add New</a>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        @if(Session::has('success'))<div class="alert alert-success">{{ Session::get('success') }}</div>@endif
                        @if(Session::has('error'))<div class="alert alert-danger">{{ Session::get('error') }}</div>@endif
                        <table class="table table-borderless table-responsive-md text-white">
                            <thead>
                            <th scope="col">#</th>
                            <th scope="col">Category Name (E)</th>
                            <th scope="col">Category Name (S)</th>
                            <th scope="col">Category Name (F)</th>
                            <th scope="col">Action</th>
                            </thead>
                            @php $i = 0; @endphp
                            @foreach($categories as $key=>$val)
                            <tbody id="myTable">
                            <th scope="row">{{ $categories->firstItem()+$i }}</th>
                            <td scope="row">{{ $val->name }}</td>
                            <td scope="row">{{ $val->name_spanish }}</td>
                            <td scope="row">{{ $val->name_french }}</td>
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
                                            <div class="modal-body text-danger text-center">Are You Sure You Want to Delete this Category?<br>Category Name: <strong>{{ $val->name }}</strong></div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                <a class="btn btn-danger" href="{{ route('delete-category',$val->id) }}">Delete</a>
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
                                            <form action="{{ route('edit-category') }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label class="text-dark" for="name-english">Category Name (English)</label>
                                                        <input type="text" name="name" class="form-control" value="{{ $val->name }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="text-dark" for="name-spanish">Category Name (Spanish)</label>
                                                        <input type="text" name="name_spanish" class="form-control" value="{{ $val->name_spanish }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="text-dark" for="name-french">Category Name (French)</label>
                                                        <input type="text" name="name_french" class="form-control" value="{{ $val->name_french }}" required>
                                                    </div>
                                                    <input type="hidden" name="category_id" value="{{ $val->id }}">
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
                                {!! $categories->links() !!}
                            </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>

                <!-- start add new category Modal-->
                <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-dark" id="exampleModalLabel">Add New Category</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <form action="{{ route('new-category') }}" method="POST">
                            <div class="modal-body">
                                @csrf
                                <div class="form-group">
                                    <label for="name-english">Category Name (English)</label>
                                    <input type="text" name="name" class="form-control categoryInput" placeholder="Enter Category Name in English" required>
                                </div>
                                <div class="form-group">
                                    <label for="name-spanish">Category Name (Spanish)</label>
                                    <input type="text" name="name_spanish" class="form-control categoryInput" placeholder="Enter Category Name in Spanish" required>
                                </div>
                                <div class="form-group">
                                    <label for="name-french">Category Name (French)</label>
                                    <input type="text" name="name_french" class="form-control categoryInput" placeholder="Enter Category Name in French" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--- end add new category modal --->

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
