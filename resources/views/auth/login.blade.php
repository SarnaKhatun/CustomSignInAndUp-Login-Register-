@extends('layout.app')
@section('title')
    Login Page
@endsection

@section('body')
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-center text-capitalize">login form</h4>
                        </div>
                        <div class="card-body">
                            <div>
                                @if($errors->any())
                                    <ul class="bg-danger">
                                        @foreach($errors->all() as $errorsS)
                                            <li>{{$errorsS}}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>

                            <h5 class="text-capitalize text-center text-success">{{Session::has('message') ? Session::get('message') : ''}}</h5>
                            <h5 class="text-capitalize text-center text-danger">{{Session::has('error') ? Session::get('error') : ''}}</h5>
                            <form action="{{route('login.submit')}}" method="post">
                                @csrf
                                <div class="row mt-3">
                                    <label for="" class="col-md-4">Email</label>
                                    <div class="col-md-8">
                                        <input type="text" name="email" class="form-control" />
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <label for="" class="col-md-4">Password</label>
                                    <div class="col-md-8">
                                        <input type="password" name="password" class="form-control" />
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <label for="" class="col-md-4"></label>
                                    <div class="col-md-8">
                                        <input type="submit" class="btn btn-success" value="login" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
