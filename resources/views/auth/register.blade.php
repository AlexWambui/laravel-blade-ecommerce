<x-guest-layout class="Authentication">
    <x-slot name="head">
        <title>Register | {{ config('globals.app_name') }}</title>
    </x-slot>

    <section class="Signup">
        <div class="container">
            <form action="{{ route('register') }}" method="post">
                @csrf

                <div class="header">
                    <p>Sign up</p>
                </div>
    
                <div class="input_group">
                    <div class="inputs">
                        <label for="first_name" class="required">First Name</label>
                        <input type="text" name="first_name" id="first_name" placeholder="First Name" value="{{ old('first_name') }}">
                        <x-input-error field="first_name" />
                    </div>
    
                    <div class="inputs">
                        <label for="last_name" class="required">Last Name</label>
                        <input type="text" name="last_name" id="last_name" placeholder="Last Name" value="{{ old('last_name') }}">
                        <x-input-error field="last_name" />
                    </div>
                </div>
    
                <div class="input_group">
                    <div class="inputs">
                        <label for="email" class="required">Email Address</label>
                        <input type="email" name="email" id="email" placeholder="Email Address" value="{{ old('email') }}">
                        <x-input-error field="email" />
                    </div>
    
                    <div class="inputs">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" name="phone_number" id="phone_number" placeholder="Phone Number" value="{{ old('phone_number') }}">
                        <x-input-error field="phone_number" />
                    </div>
                </div>
    
                <div class="inputs">
                    <label for="password" class="required">Password</label>
                    <input type="password" name="password" id="password" placeholder="Password" value="{{ old('password') }}">
                    <x-input-error field="password" />
                </div>
    
                <div class="inputs">
                    <label for="password_confirmation" class="required">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" value="{{ old('password_confirmation') }}">
                    <x-input-error field="password_confirmation" />
                </div>
    
                <button type="submit">Signup</button>
    
                <p>Already have an account?
                    <a href="{{ route('login') }}">Login</a>
                </p>
            </form>
        </div>
    </section>
</x-guest-layout>
