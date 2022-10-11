@extends('layouts.app')
<?php
$title = 'Registration';
?>

@section('title-block'){{$title}}@endsection
@section('content')
    <section class="form">
        <form action="{{route('user.registration')}}" method="POST">
            <h4>If you are registered, <a href="/login">log in</a></h4>
            @include('inc.form')
            <div class="button">
                <button type="submit" name="sendMe" value="1" class="form__button">Register</button>
            </div>
            @include('inc.back')
        </form>
    </section>
@endsection
