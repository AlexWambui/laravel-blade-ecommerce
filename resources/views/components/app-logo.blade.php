@if(!empty($appSettings['school_logo']))
    <img src="{{ asset('storage/'.$appSettings['school_logo']) }}" alt="School Logo">
@else
    <img src="{{ Vite::asset('resources/images/default_image.jpg') }}" alt="School Logo">
@endif