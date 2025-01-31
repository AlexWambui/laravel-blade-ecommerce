<x-app-layout>
    <x-slot name="head">
        {{ $head ?? '' }}
    </x-slot>

    
    <main {{ $attributes->merge(['class' => 'MainApp']) }}>
        @include('partials.aside')

        <div class="app_content">
            @include('partials.messages')
            
            {{ $slot }}
        </div>
    </main>

    <x-slot name="scripts">
        {{ $scripts ?? '' }}
        <script src="{{ asset('assets/js/alert.js') }}"></script>
    </x-slot>
</x-app-layout>
