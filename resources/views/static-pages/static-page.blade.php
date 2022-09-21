@extends('layouts.app')
@section('content')
    <div class="container my-5">
        <h1 class="text-center">{{$page->title}}</h1>
        <p class="my-5 text-md">{{$page->description}}</p>
    </div>
@endsection
