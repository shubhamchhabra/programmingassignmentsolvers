@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h3 class="text-center pt-4">Contact us</h3>

            <div class="col-md-12 p-5">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                {{ __('Connect with us') }}
                            </div>
                            @if ($message = Session::get('success'))
                                <div class="w-50 col-md- 8 alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>{{ $message  }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>

                            @elseif($message = Session::get('error'))
                                <div class="w-50 col-md- 8 alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{ $message  }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('contact_submit') }}">
                            @csrf

                            <div class="form-group row">

                                <div class="col-md-4">
                                    <label for="name" class="form-label ml-1">{{ __('Your name') }} <span class="text-danger">*</span></label>
                                    <input id="name" type=text class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="email" class="form-label ml-1">{{ __('Your E-Mail Address') }} <span class="text-danger">*</span></label>
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

                                <div class="col-md-4">
                                    <label for="subject" class="form-label ml-1">{{ __('Enter Subject') }} <span class="text-danger">*</span></label>
                                    <input id="subject" type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" value="{{ old('subject') }}"  autofocus>

                                    @error('subject')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="message" class="form-label ml-1">{{ __('Message') }} <span class="text-danger">*</span></label>
                                    <textarea id="message" rows="3" class="form-control @error('message') is-invalid @enderror" name="message" value="{{ old('message') }}" autofocus></textarea>

                                    @error('message')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- <div class="form-group row"> --}}
                                {{-- <div class="col-md-12">
                                    <div class="g-recaptcha @error('g-recaptcha-response') is-invalid @enderror" id="feedback-recaptcha"
                                         data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}">
                                    </div>
                                    @error('g-recaptcha-response')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> --}}

                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary d-block mx-auto">
                                        {{ __('Send Message') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
