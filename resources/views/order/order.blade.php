@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h3 class="text-center pt-4">Place your order now</h3>

            <div class="col-md-12 p-5">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                {{ __('Place Order') }}
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
                        <form method="POST" action="{{ route('order_submit') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">

                                <div class="col-md-4">
                                    <label for="name" class="form-label ml-1">{{ __('Name') }} <span class="text-danger">*</span></label>
                                    <input id="name" type=text class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-4">
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

                                <div class="col-md-4">
                                    <label for="subject_title" class="form-label ml-1">{{ __('Subject Title') }} <span class="text-sm">(optional)</span></label>
                                    <input id="subject_title" type=text class="form-control @error('subject_title') is-invalid @enderror" name="subject_title" value="{{ old('subject_title') }}" autofocus>

                                    @error('subject_title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="deadline" class="form-label ml-1">{{ __('Deadline') }} <span class="text-danger">*</span></label>
                                    <input id="deadline" type="datetime-local" class="form-control @error('deadline') is-invalid @enderror" name="deadline" value="{{ old('deadline') }}" autocomplete="email" autofocus>

                                    @error('deadline')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="timezone" class="form-label ml-1">{{ __('Timezone') }} <span class="text-sm">(optional)</span></label>
                                    <select name="timezone" id="timezone" class="form-select">
                                        <option value="" selected>--Choose TimeZone--</option>
                                        <?php
                                           if(count($timeZones) > 0){
                                          foreach($timeZones as $timeZone){
                                        ?>
                                        <option value="<?= $timeZone['countryCode'] ?>"><?= $timeZone['zoneName'] ?></option>
                                        <?php
                                            }
                                           }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">

                                <div class="col-md-4">
                                    <label for="ref_code" class="form-label ml-1">{{ __('Referral Code') }} <span class="text-sm">(optional)</span></label>
                                    <input id="ref_code" type=text class="form-control @error('ref_code') is-invalid @enderror" name="ref_code" value="{{ old('ref_code') }}" autofocus>

                                    @error('ref_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="requirement" class="form-label ml-1">{{ __('Requirement') }} <span class="text-sm">(optional)</span></label>
                                    <select name="requirement" id="requirement" class="form-select">
                                        <option value="" selected disabled>--Choose Requirement--</option>
                                        <option value="<?= \App\Models\Order::EXECUTABLE_CODE ?>">Executable Code</option>
                                        <option value="<?= \App\Models\Order::WELL_COMMENTED_CODE ?>">Well Commented Code</option>
                                        <option value="<?= \App\Models\Order::EXECUTABLE_CODE_REPORT ?>">Executable Code & Report</option>
                                    </select>
                                    @error('requirement')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="academic" class="form-label ml-1">{{ __('Academic Level') }} <span class="text-sm">(optional)</span></label>
                                    <select name="academic" id="academic" class="form-select">
                                        <option value="" selected disabled>--Choose Academic Level--</option>
                                        <option value="<?= \App\Models\Order::UNDERGRADUATE ?>">Undergraduate</option>
                                        <option value="<?= \App\Models\Order::GRADUATE ?>">Graduate</option>
                                        <option value="<?= \App\Models\Order::MASTERS ?>">Masters</option>
                                        <option value="<?= \App\Models\Order::PHD ?>">PhD</option>
                                    </select>
                                    @error('academic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">

                                <div class="col-md-4">
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

                                <div class="col-md-4">
                                    <label for="assignment_file" class="form-label ml-1">{{ __('Add Assignment File') }} <span class="text-sm">(optional)</span></label>
                                    <input id="assignment_file" type="file" multiple class="form-control @error('assignment_file') is-invalid @enderror" name="assignment_file" value="{{ old('assignment_file') }}" autofocus>

                                    @error('assignment_file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="number" class="form-label ml-1">{{ __('Contact Number') }} <span class="text-danger">*</span></label>
                                    <input id="number" type="text" class="form-control @error('number') is-invalid @enderror" name="number" value="{{ old('number') }}"  autofocus>

                                    @error('number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="description" class="form-label ml-1">{{ __('Enter your Assignment Description') }} <span class="text-sm">(optional)</span></label>
                                    <textarea id="description" rows="3" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" autofocus></textarea>

                                    @error('description')
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
    </div>
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
