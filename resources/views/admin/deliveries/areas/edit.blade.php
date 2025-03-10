<x-authenticated-layout>
    <x-slot name="head">
        <title>Area | Update</title>
    </x-slot>

    <section class="Locations">
        <div class="custom_form">
            <div class="header">
                <div class="icon">
                    <a href="{{ route('areas.index') }}">
                        <span class="fas fa-arrow-left"></span>
                    </a>
                </div>
                <p>Update Area</p>
            </div>

            <form action="{{ route('areas.update', $area->id) }}" method="post">
                @csrf
                @method('patch')

                <div class="input_group_3">
                    <div class="inputs">
                        <label for="delivery_location_id">Location</label>
                        <select name="delivery_location_id" id="delivery_location_id">
                            <option value="">Select Location</option>
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}" {{ old('delivery_location_id', $area->delivery_location_id) == $location->id ? "selected" : "" }}>{{ $location->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error field="delivery_location_id" />
                    </div>

                    <div class="inputs">
                        <label for="name">Area Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $area->name) }}">
                        <x-input-error field="name" />
                    </div>

                    <div class="inputs">
                        <label for="price">Price (Kshs)</label>
                        <input type="number" name="price" id="price" value="{{ old('price', $area->price) }}">
                        <x-input-error field="price" />
                    </div>
                </div>

                <div class="buttons">
                    <button type="submit">Update Area</button>

                    <button type="button" class="btn_danger" onclick="deleteItem({{ $area->id }}, 'area');"
                        form="deleteForm_{{ $area->id }}">
                        <i class="fas fa-trash-alt delete"></i>
                        <span>Delete Area</span>                        
                    </button>
                </div>
            </form>

            <form id="deleteForm_{{ $area->id }}" action="{{ route('areas.destroy', $area->id) }}" method="post"
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
