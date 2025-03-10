<x-authenticated-layout>
    <x-slot name="head">
        <title>Location | Update</title>
    </x-slot>

    <section class="Locations">
        <div class="custom_form">
            <div class="header">
                <div class="icon">
                    <a href="{{ route('locations.index') }}">
                        <span class="fas fa-arrow-left"></span>
                    </a>
                </div>
                <p>Update Location</p>
            </div>

            <form action="{{ route('locations.update', $location->id) }}" method="post">
                @csrf
                @method('patch')

                <div class="inputs">
                    <label for="name">Location Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $location->name) }}">
                    <x-input-error field="name" />
                </div>

                <div class="buttons">
                    <button type="submit">Update Location</button>

                    <button type="button" class="btn_danger" onclick="deleteItem({{ $location->id }}, 'location and its areas');"
                        form="deleteForm_{{ $location->id }}">
                        <i class="fas fa-trash-alt delete"></i>
                        <span>Delete Location</span>                        
                    </button>
                </div>
            </form>

            <form id="deleteForm_{{ $location->id }}" action="{{ route('locations.destroy', $location->id) }}" method="post"
                style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </section>

    <x-slot name="scripts">
        <x-sweetalert />
    </x-slot>
</x-authenticated-layout>
