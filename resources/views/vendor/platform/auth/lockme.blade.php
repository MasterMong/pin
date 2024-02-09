<div class="mb-3 d-flex align-items-center">
    <div class="avatar avatar-md">
        <img src="{{ $lockUser->presenter()->image() }}" class="avatar-img" alt="test">
    </div>
    <span style="width:125px;" class="small">
        <span class="text-ellipsis">{{ $lockUser->presenter()->title() }}</span>
        <span class="text-muted d-block text-ellipsis">{{ $lockUser->presenter()->subTitle() }}</span>
    </span>
    <input type="hidden" name="email" required value="{{ $lockUser->email }}">
</div>

@error('email')
    <span class="d-block invalid-feedback text-danger">
            {{ $errors->first('email') }}
    </span>
@enderror

<div class="mb-3">
    <input type="hidden" name="remember" value="true">

    {!!  \Orchid\Screen\Fields\Password::make('password')
            ->required()
            ->autocomplete('current-password')
            ->tabindex(1)
            ->autofocus()
            ->placeholder(__('Enter your password'))
    !!}
</div>

<div class="row align-items-center">
    <div class="col-md-6 col-xs-12">
        <a href="{{ route('platform.login.lock') }}" class="small">
            {{__('Sign in with another user.')}}
        </a>
    </div>
    <div class="col-md-6 col-xs-12">
        <button id="button-login" type="submit" class="btn btn-primary" tabindex="2">
            <x-orchid-icon path="bs.box-arrow-in-right" class="small me-2"/>
            {{__('Login')}}
        </button>
    </div>
</div>