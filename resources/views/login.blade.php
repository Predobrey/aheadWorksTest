@extends('layouts.app')
<?php
$title = 'Log IN';
?>

@section('title-block'){{$title}}@endsection
@section('content')
    <section class="form">
        <form action="{{route('user.login')}}" method="POST">
            <h4>Log in to the app or <a href="/registration">register</a></h4>
            @include('inc.form')
            <div class="button">
                <button type="submit" name="sendMe" value="1" class="form__button">Log In</button>
            </div>
            @include('inc.back')
        </form>
    </section>
    @endsection
    </body>
    </html>
