@extends('layouts.app')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12">

                 
                 <div class="my-4" style="border:none;" >
                            <img src="{{URL::asset('/post/'.$post->image_path)}}" class="card-img-top" alt="..." style="max-height: 400px;">
                            <div class="card-body pb-0">
                                <p class="card-text">{!! $post->description !!}</p>
                                <div class="pt-0 mb-3" style="display: flex; flex-direction: row; align-items: center;">
                                    <img class="d-block" src="https://cdn-icons-png.flaticon.com/128/945/945226.png?uid=R76116723&ga=GA1.2.701253051.1658765313" height="70px" alt="">
                                    <span class="ml-3">
                                        <p class="text-sm mb-0 mt-2">{{$post->user->name}}</p>
                                        <p class="text-sm mt-1">{{ $post->updated_at->format('Y-m-d')  }}</p>
                                    </span>
                                </div>
                            </div>

                </div>
                    
                </div>
            </div>


        </div>
    </section>

@endsection
