@extends('layouts.app')

<?php
$title = 'Home Page';
?>

@section('title-block'){{$title}}@endsection

@section('content')
    <section class="home">
        <div class="container">
            <div class="home__wrapper">
                <h1>Welcome to the app</h1>
                <h4><a href="/login">Log in</a> to the app or <a href="/registration">register</a></h4>
            </div>
        </div>
    </section>
@endsection
