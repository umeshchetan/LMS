<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<div class="container-fluid">
    <div class="row justify-content-md-center" id="">
        <div class="col-md-6" id="leftLogin">
            <div>
                <a href="{{route('intialPage')}}"><img src="{{asset('assets/loginLogo.svg')}}" alt="logo"></a>
            </div>
            <div class="innerLogin px-5 py-3 w-75">
                <h1 class="" style="text-align:center;color:#fff;font-weight:700">WELCOME</h1>
                <div class="form-div  mt-5">
                    @if (Session::has('error'))
                    <p class="text-danger">{{ Session::get('error') }}</p>
                    @endif
                    @if (Session::has('success'))
                    <p class="text-success">{{ Session::get('success') }}</p>
                    @endif

                    <form action="{{ route('postLogin') }}" method="post">
                        @csrf
                        <div class="form-section">
                            <label>E-Mail Address</label>
                            <input type="email" name="email" value="{{old('email')}}" class="form-control mb-3"
                                placeholder="Email" />
                            @if ($errors->has('email'))
                            <p class="text-danger">{{ $errors->first('email') }}</p>
                            @endif
                        </div>
                        <div class="form-section">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control mb-3" placeholder="Password" />
                            @if ($errors->has('password'))
                            <p class="text-danger">{{ $errors->first('password') }}</p>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-8 text-left">
                                <a href="" class="btn btn-link" id="loginAnchor">Forgot
                                    Password?</a>
                            </div>
                            <div class="col-4 text-right">
                                <input type="submit" class="btn btn-primary" value=" Login " />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div>
                <label style="margin-left: 100px;color:#fff" for="">DON'T HAVE AN ACCOUNT ? <a
                        href="{{route('register')}}" id="loginAnchor">REGISTER HERE</a></label>
            </div>
        </div>
        <div class="col-md-6" id="rightLogin"></div>

    </div>
</div>