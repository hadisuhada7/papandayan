@extends('adminlte::page')

@section('title', 'Enable Two-Factor Authentication')

@section('content_header')
    <h1>Enable Two-Factor Authentication</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Scan QR Code</h3>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <h5><i class="icon fas fa-info-circle"></i> Steps:</h5>
                    <ol>
                        <li>Open Google Authenticator app on your smartphone</li>
                        <li>Tap the "+" button or "Add account"</li>
                        <li>Select "Scan QR code"</li>
                        <li>Scan the QR code below</li>
                        <li>Enter the 6-digit code that appears in the app</li>
                    </ol>
                </div>

                <div class="text-center mb-4">
                    <div style="display: inline-block; padding: 20px; background: white; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                        {!! $qrCodeSvg !!}
                    </div>
                </div>

                <div class="alert alert-secondary">
                    <h6><strong>Or enter the code manually:</strong></h6>
                    <code style="font-size: 16px;">{{ $secret }}</code>
                    <p class="mb-0 mt-2 text-muted"><small>Save this code in a safe place if you need to setup again.</small></p>
                </div>

                <form action="{{ route('account.two-factor.verify') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="one_time_password">Enter OTP Code for Verification</label>
                        <input type="text" name="one_time_password" 
                               class="form-control @error('one_time_password') is-invalid @enderror" 
                               placeholder="000000" 
                               maxlength="6"
                               required
                               autofocus>
                        @error('one_time_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <small class="form-text text-muted">Enter the 6-digit code from your authenticator app.</small>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <a href="{{ route('account.two-factor.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back
                            </a>
                        </div>
                        <div class="col-6 text-right">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-check"></i> Verify & Activate
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
    // Auto-submit form when 6 digits are entered
    document.querySelector('input[name="one_time_password"]').addEventListener('input', function(e) {
        if (this.value.length === 6) {
            // Optional: uncomment to auto-submit
            // this.closest('form').submit();
        }
    });
</script>
@stop
