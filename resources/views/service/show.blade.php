@extends('layouts.app')

@section('content')
    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="col-md-12 my-4 card-body">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-md-12 text-center">
                                    {{ __('Place your Order Now!') }}
                                </div>
                                @if ($message = Session::get('success'))
                                    <div class="col-md-12 alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>{{ $message  }}</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>

                                @elseif($message = Session::get('error'))
                                    <div class="col-md-12 alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>{{ $message  }}</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('order_submit') }}" enctype="multipart/form-data">
                                @csrf

                                {{--Enter name--}}
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="name" class="form-label ml-1">{{ __('Name') }} <span class="text-danger">*</span></label>
                                        <input id="name" type=text class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autofocus>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                {{--Enter email--}}
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="email" class="form-label ml-1">{{ __('E-Mail Address') }} <span class="text-danger">*</span></label>
                                        @if (Auth::check() && Auth::user()->isAdmin())
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="<?= \Illuminate\Support\Facades\Auth::user()->email ?>" autocomplete="email" autofocus>
                                        @else
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="" autocomplete="email" autofocus>

                                        @endif
                                        {{-- @can('isUser') --}}
                                        {{-- @endcan --}}

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                </div>

                                {{--Enter subject--}}
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="subject" class="form-label ml-1">{{ __('Enter Subject') }} <span class="text-danger">*</span></label>
                                        <input id="subject" type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" value="{{ old('subject') }}"  autofocus>

                                        @error('subject')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                {{--Enter deadline--}}
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="deadline" class="form-label ml-1">{{ __('Deadline') }} <span class="text-danger">*</span></label>
                                        <input id="deadline" type="datetime-local" class="form-control @error('deadline') is-invalid @enderror" name="deadline" value="{{ old('deadline') }}" autocomplete="email" autofocus>

                                        @error('deadline')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                {{--Enter number of pages--}}
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="no_pages" class="form-label ml-1">{{ __('Number of Pages') }} <span class="text-danger">*</span></label>
                                        <input id="no_pages" type=number min="1" class="form-control @error('no_pages') is-invalid @enderror" name="no_pages" value="{{ old('no_pages') }}" autofocus>
                                        @error('no_pages')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span class="text-success" id="wordscount">250 Words</span>
                                            <div class="mt-3">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <p>No Words Limit</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{--Enter contact number--}}
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="number" class="form-label ml-1">{{ __('Contact Number') }} <span class="text-danger">*</span></label>
                                        <input id="number" type="text" class="form-control @error('number') is-invalid @enderror" name="number" value="{{ old('number') }}"  autofocus>

                                        @error('number')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary d-block mx-auto">
                                            {{ __('ORDER NOW') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid col-md-8">
                <div class="row">

                    <div class="col-12">
                        <div class="my-4" style="border:none;" >
                            <div class="card-body pb-0">
                                <img src="/service/{!! $service->image_path !!}" class="card-img-top" alt="..." style="max-height: 400px;">
                                <p class="card-text">{!! $service->description !!}</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    </section>

@endsection

<script>
    window.onload = () => {
        document.getElementById('remember').checked = false;

        document.getElementById('remember').addEventListener('change', function(){
            if(this.checked){
                document.getElementById('no_pages').setAttribute('disabled','disabled');
            }else{
                document.getElementById('no_pages').removeAttribute('disabled');
            }
        });

        document.getElementById('no_pages').addEventListener('input', function(){
            const wordCount = this.value;
            if(wordCount != ''){
                document.getElementById('wordscount').innerText = (wordCount * 250) + " Words";
            }else{
                document.getElementById('wordscount').innerText = "250 Words";
            }
        });
    }

</script>
