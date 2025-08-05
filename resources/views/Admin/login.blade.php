<!DOCTYPE html>
<html lang="en">

@include('admin.includes.head')
<style>
    input#exampleInputEmail , input#exampleInputPassword {
        background: transparent;
        border-radius: unset;
        border: unset;
        border-bottom: 1px solid #4F4F4F;
        padding: unset;
    }
    input#exampleInputEmail:focus , input#exampleInputPassword:focus {
        box-shadow: none;
    }
    label {
        color: #39D1E5;
    }
</style>
<body style="background: #000000">

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">

                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div class="p-5 mt-5">
                                <div class="text-center">
                                    <img src="{{ asset('img/logo.png') }}" alt="logo" style="width: 100px;padding-bottom: 20px;"><br>
                                </div>
                                <form class="user" action="{{ route('log-in') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control"
                                               id="exampleInputEmail" aria-describedby="emailHelp"
                                               placeholder="Enter Email Address..." name="email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control"
                                               id="exampleInputPassword" placeholder="Enter Your Password" name="password" required>
                                    </div>
                                    <button type="submit" class="btn btn-block" style="background: linear-gradient(91.57deg, #42c8df 0%, #ee3678 100%);color: #ffffff;font-weight: bold;border-left: none;border-right: none;">
                                        Login
                                    </button>
                                </form>

                            </div>
                            @if(Session::has('success'))<div class="alert alert-success">{{ Session::get('success') }}</div>@endif
                            @if(Session::has('error'))<div class="alert alert-danger">{{ Session::get('error') }}</div>@endif
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
        </div>

    </div>

</div>

@include('admin.includes.script')

</body>

</html>
