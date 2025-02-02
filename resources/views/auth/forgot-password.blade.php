<x-guest-layout class="Authentication">
    <x-slot name="head">
        <title>Forgot Password | {{ config('globals.app_name') }}</title>
    </x-slot>

    <section class="ForgotPassword">
        <div class="container">
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="header">
                    <p>Forgot your password?</p>
                </div>

                <p>Just enter your email address to receive a  password reset link.</p>
        
                <div class="inputs">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" autofocus>
                    <x-input-error field="email" />
                </div>
        
                <button type="submit">Email Password Reset Link</button>
            </form>
        </div>
    </section>
</x-guest-layout>
