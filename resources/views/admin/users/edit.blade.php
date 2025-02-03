<x-authenticated-layout>
    <x-slot name="head">
        <title>User | Edit</title>
    </x-slot>

    <section class="Users">
        <div class="custom_form">
            <div class="header">
                <div class="icon">
                    <a href="{{ route('users.index') }}">
                        <span class="fas fa-arrow-left"></span>
                    </a>
                </div>
                <p>Update User</p>
            </div>

            <form action="{{ route('users.update', $user->id) }}" method="post">
                @csrf
                @method('patch')

                <div class="details">
                    <div class="image">
                        @if($user->image)
                            <img id="previewImage" src="{{ asset('storage/' . $user->image) }}" alt="User" width="100" height="100">
                        @else
                            <x-default-profile-image />
                        @endif
                    </div>
                    <p class="title">{{ $user->full_name }}</p>
                    <p>{{ $user->email }}</p>
                    <p>{{ $user->phone_numbers }}</p>
                </div>
                
                <div class="input_group">
                    <div class="inputs">
                        <label for="password">Password</label>
                        <input type="text" name="password" id="password" placeholder="Password">
                        <x-input-error field="password" />
                    </div>
    
                    <div class="inputs">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="text" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
                        <x-input-error field="password confirmation" />
                    </div>
                </div>

                <div class="input_group">
                    <div class="inputs">
                        <label for="user_level">User Level</label>
                        <div class="custom_radio_buttons">
                            @foreach(App\Models\User::USERLEVELS as $key => $label)
                                <label>
                                    <input class="option_radio" 
                                        type="radio" 
                                        name="user_level" 
                                        value="{{ $key }}"
                                        {{ old('user_level', $user->user_level) == $key ? 'checked' : '' }}>
                                    <span>{{ ucfirst($label) }}</span>
                                </label>
                            @endforeach
                        </div>
                        <x-input-error field="user_level" />
                    </div>

                    <div class="inputs">
                        <label for="user_status">User Status</label>
                        <div class="custom_radio_buttons">
                            @foreach(App\Models\User::USERSTATUS as $key => $label)
                                <label>
                                    <input class="option_radio" 
                                        type="radio" 
                                        name="user_status" 
                                        value="{{ $key }}"
                                        {{ old('user_status', $user->user_status) == $key ? 'checked' : '' }}>
                                    <span>{{ ucfirst($label) }}</span>
                                </label>
                            @endforeach
                        </div>
                        <x-input-error field="user_status" />
                    </div>
                </div>

                @can('update-user', $user)
                    <div class="buttons">
                        <button type="submit">Update User</button>
                        
                        <button type="button" class="btn_danger" onclick="deleteItem({{ $user->id }}, 'user');"
                            form="deleteForm_{{ $user->id }}">
                            <i class="fas fa-trash-alt delete"></i>
                            <span>Delete User</span>
                        </button>
                    </div>
                @endcan
            </form>

            <form id="deleteForm_{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="post"
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