<x-guest-layout class="Authentication">
    <x-slot name="head">
        <title>Reset Password | {{config('globals.app_name') }}</title>
    </x-slot>

    <section class="ResetPassword">
        <div class="container">
            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <div class="header">
                    <p>Reset Password</p>
                </div>
        
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
        
                <div class="inputs">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $request->email) }}">
                    <x-input-error field="email" />
                </div>
        
                <div class="inputs">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password">
                    <x-input-error field="password" />
                </div>
        
                <div class="inputs">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation">
                    <x-input-error field="password_confirmation" />
                </div>
        
                <button type="submit">Reset Password</button>
            </form>
        </div>
    </section>
</x-guest-layout>
