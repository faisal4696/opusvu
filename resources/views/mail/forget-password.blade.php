@extends('layout.mail-layout')
@section('title','Forget Password')
@section('body')


    <div class="mail-wrap">
        <div class="mail-container">
            <div class="mail-head">
                <span>OPUSVU</span>
            </div>
            <div class="mail-body">
                <h2>Hi, {{$name}}</h2>
                <p> {{$name}} to reset your password. Your new Password is {{$password}} </p>
                <br><br>
                <p>Best Regards<br>
                    <a href="#">Team Opusvu</a>
                </p>
            </div>

            <div class="mail-footer">
                <p>Copyright 2021 Opusvu</p>
            </div>
        </div>
    </div>
@endsection
