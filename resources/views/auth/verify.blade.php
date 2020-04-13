@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-light">{{ __('auth.Verify-Your-Email-Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('auth.freshEmailWasSent') }}
                        </div>
                    @endif

                    {{ __('auth.BeforeBroccesing') }}
                    {{ __('auth.If-you-did-not-receive-the-email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('auth.click-here-to-request-another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
