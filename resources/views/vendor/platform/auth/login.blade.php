@extends('platform::auth')
@section('title',__('Sign in to your account'))

@section('content')
    <div class="card-group d-block d-md-flex row">
        <div class="card col-md-7 p-4 mb-0">
            <div class="card-body">
                <p class="text-medium-emphasis">{{__('Sign in to your account')}}</p>

                <form class="m-t-md"
                      role="form"
                      method="POST"
                      data-controller="form"
                      data-form-need-prevents-form-abandonment-value="false"
                      data-action="form#submit"
                      action="{{ route('platform.login.auth') }}">
                    @csrf

                    @includeWhen($isLockUser,'platform::auth.lockme')
                    @includeWhen(!$isLockUser,'platform::auth.signin')
                </form>
            </div>
        </div>
    </div>
                
@endsection