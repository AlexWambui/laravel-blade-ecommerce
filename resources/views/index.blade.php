<x-guest-layout class="HomePage">
    <x-slot name="head">
        <title>Home | {{ config('globals.app_name') }}</title>
        <meta name="description" content="Home page description">
        <meta name="keywords" content="home, website, example">
    </x-slot>

    <section class="Hero">
        <div class="container">
            <div class="text">
                <p class="title">{{ config("globals.app_name") }}</h1>
                <p class="sub_title">{{ config("globals.app_slogan") }}</p>
                <div class="btns">
                    <a href="#">Get Started</a>
                </div>
            </div>

            <div class="image">
                <img src="../../_assets/images/hero.jpg" alt="Hero Image" width="400px" height="400px">
            </div>
        </div>
    </section>
</x-guest-layout>
