@extends('layouts.master')

@section('title')
    Welcome
    @endsection

@section('content')
  @include('includes.errorCheck')
    <div class="row">
        <div class="col-md-6">
            <h3>Sign UP</h3>
            <form action="{{route('signup')}}" method="POST">
                <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                    <label for="email">Your E-mail</label>
                    <input class="form-control" type="text" name = "email" id = "email" value="{{Request::old('email')}}">
                </div>

                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input class="form-control" type="text" name = "first_name" id = "first_name">
                </div>

                <div class="form-group">
                    <label for="email">Password</label>
                    <input class="form-control" type="password" name = "password" id = "password">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                <input type="hidden" name="_token" value="{{Session::token()}}">
            </form>

        </div>

        <div class="col-md-6">
            <h3>Sign In</h3>
            <form action="signin" method="POST">
                <div class="form-group">
                    <label for="email">Your E-mail</label>
                    <input class="form-control" type="text" name = "email" id = "email">
                </div>


                <div class="form-group">
                    <label for="email">Password</label>
                    <input class="form-control" type="password" name = "password" id = "password">
                </div>

                <input type="hidden" name="_token" value="{{Session::token()}}">
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>


    </div>
    @endsection