<x-authenticated-layout>
    <x-slot name="head">
        <title>Areas</title>
    </x-slot>

    <section class="Locations">
        <div class="system_nav">
            <a href="{{ route('locations.index') }}">Locations</a>
            <span>Areas</span>
        </div>

        <div class="body row_container">
            <div class="column">
                @if ($areas->isNotEmpty())
                    <div class="table list_items">
                        <div class="header">
                            <div class="details">
                                <p class="title">Areas</p>
                                <p class="stats">
                                    <span>{{ $count_areas }} {{ Str::plural('Area', $count_areas) }}</span>
                                </p>
                            </div>
        
                            <x-search-input />
                        </div>
        
                        <table>
                            <thead>
                                <tr>
                                    <th class="center">#</th>
                                    <th>Area</th>
                                    <th>Price</th>
                                    <th class="actions center">Actions</th>
                                </tr>
                            </thead>
                
                            <tbody>
                                @foreach ($areas as $area)
                                    <tr class="searchable">
                                        <td class="center">{{ $loop->iteration }}</td>
                                        <td>{{ $area->name }}</td>
                                        <td>{{ $area->price }}</td>
                                        <td class="actions center">
                                            <div class="action_buttons">
                                                <div class="action">
                                                    <a href="{{ route('areas.edit', $area->id) }}">
                                                        <span class="fas fa-eye"></span> 
                                                    </a> 
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p>No areas added yet.</p>
                @endif
            </div>

            <div class="column">
                <div class="custom_form">
                    <div class="header">
                        <p>New Area</p>
                    </div>

                    <form action="{{ route('areas.store') }}" method="post">
                        @csrf

                        <div class="inputs">
                            <label for="delivery_location_id">Location</label>
                            <select name="delivery_location_id" id="delivery_location_id">
                                <option value="">Select Location</option>
                                @foreach($locations as $location)
                                    <option value="{{ $location->id }}" {{ old('delivery_location_id') == $location->id ? "selected" : "" }}>{{ $location->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error field="delivery_location_id" />
                        </div>

                        <div class="inputs">
                            <label for="name">Area Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}">
                            <x-input-error field="name" />
                        </div>

                        <div class="inputs">
                            <label for="price">Price (Kshs)</label>
                            <input type="number" name="price" id="price" value="{{ old('price') }}">
                            <x-input-error field="price" />
                        </div>

                        <button type="submit">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <x-slot name="scripts">
        <x-search />
    </x-slot>
</x-authenticated-layout>
