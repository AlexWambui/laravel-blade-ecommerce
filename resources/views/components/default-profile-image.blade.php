<img src="{{ $src ?? Vite::asset('resources/images/default_profile.jpg') }}" 
     alt="Default Profile Image" 
     width="{{ $attributes->get('width', 50) }}" 
     height="{{ $attributes->get('height', 50) }}">