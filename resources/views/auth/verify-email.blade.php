<x-guest-layout class="Authentication">
    <x-slot name="head">
        <title>Verify Email | {{ config('globals.app_name') }}</title>
    </x-slot>

    <section class="VerifyEmail">
        <div class="container">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div class="header">
                    <p>Verify your Email</p>
                </div>

                <p>Kindly verify your email address before getting started.</p>
                <p>If you didn't receive an email address, we will gladly send you another one.</p>
    
                <button type="submit">Resend Verification Email</button>
            </form>
    
            <form method="POST" action="{{ route('logout') }}">
                @csrf
    
                <button type="submit">Logout</button>
            </form>
        </div>
    </section>
</x-guest-layout>
