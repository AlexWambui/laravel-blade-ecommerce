<x-authenticated-layout>
    <x-slot name="head">
        <title>Locations</title>
    </x-slot>

    <section class="Locations">
        <div class="system_nav">
            <a href="{{ route('areas.index') }}">Areas</a>
            <span>Locations</span>
        </div>

        <div class="body row_container">
            <div class="column">
                @if ($locations->isNotEmpty())
                    <div class="table list_items">
                        <div class="header">
                            <div class="details">
                                <p class="title">Locations</p>
                                <p class="stats">
                                    <span>{{ $count_locations }} {{ Str::plural('Location', $count_locations) }}</span>
                                </p>
                            </div>
        
                            <x-search-input />
                        </div>
        
                        <table>
                            <thead>
                                <tr>
                                    <th class="center">#</th>
                                    <th>Location</th>
                                    <th>Areas</th>
                                    <th class="actions center">Actions</th>
                                </tr>
                            </thead>
                
                            <tbody>
                                @foreach ($locations as $location)
                                    <tr class="searchable">
                                        <td class="center">{{ $loop->iteration }}</td>
                                        <td>{{ $location->name }}</td>
                                        <td>
                                            @forelse($location->areas as $area)
                                                <p>{{ $area->name }} - {{ $area->price }}</p>
                                            @empty
                                                <p>None added.</p>
                                            @endforelse
                                        </td>
                                        <td class="actions center">
                                            <div class="action_buttons">
                                                <div class="action">
                                                    <a href="{{ route('locations.edit', $location->id) }}">
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
                    <p>No locations added yet.</p>
                @endif
            </div>

            <div class="column">
                <div class="custom_form">
                    <div class="header">
                        <p>New Location</p>
                    </div>

                    <form action="{{ route('locations.store') }}" method="post">
                        @csrf

                        <div class="inputs">
                            <label for="name">Location Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}">
                            <x-input-error field="name" />
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
