<x-guest-layout class="ContactPage">
    <x-slot name="head">
        <title>Contact Us | {{ config('globals.app_name') }}</title>
        <meta name="description" content="Home page description">
        <meta name="keywords" content="home, website, example">
    </x-slot>

    <section class="Hero">
        <div class="container">
            <div class="text">
                <p class="title">Get in Touch</p>

                <p class="content">
                    <span>{{ config('globals.app_phone_number') }}</span>
                    <span>{{ config('globals.app_email') }}</span>
                </p>
            </div>

            <div class="custom_form">
                <form action="{{ route('messages.store') }}" method="post">
                    @csrf

                    <div class="inputs">
                        <label for="name">Full Name</label>
                        <input type="text" name="name" id="name" placeholder="Full Name" value="{{ old('name') }}">
                        <x-input-error field="name" />
                    </div>

                    <div class="inputs">
                        <label for="email">Email Address</label>
                        <input type="email" name="email" id="email" placeholder="Email Address" value="{{ old('email') }}">
                        <x-input-error field="email" />
                    </div>

                    <div class="inputs">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" name="phone_number" id="phone_number" placeholder="Phone Number" value="{{ old('phone_number') }}">
                        <x-input-error field="phone_number" />
                    </div>

                    <div class="inputs">
                        <label for="message">Message</label>
                        <textarea name="message" id="message" cols="30" rows="7" placeholder="Enter your message">{{ session('success') ? '' : request('message', old('message')) }}</textarea>
                        <x-input-error field="message" />
                    </div>

                    <button type="submit">Send Message</button>
                </form>
            </div>
        </div>
    </section>
</x-guest-layout>
