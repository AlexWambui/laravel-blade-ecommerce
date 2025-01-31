@props(['field'])

@if ($errors->has($field))
    <span class="inline_alert">{{ $errors->first($field) }}</span>
@endif
