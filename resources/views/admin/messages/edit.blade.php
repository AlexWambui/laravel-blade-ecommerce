<x-authenticated-layout>
    <section class="UserMessage">
        <div class="custom_form">
            <div class="header">
                <div class="icon">
                    <a href="{{ route('messages.index') }}">
                        <span class="fas fa-arrow-left"></span>
                    </a>
                </div>
                <p class="stack">
                    <span>{{ $message->name }}</span>
                    <span>{{ $message->email }}</span>
                    <span>{{ $message->phone_number }}</span>
                </p>
            </div>

            <div class="body">
                <div class="details">
                    <div class="message_details">
                        <p class="time">{{ formatted_date($message->created_at) }}</p>
                        <p class="user_message">{{ $message->message }}</p>
                    </div>
    
                    <a href="mailto:{{ $message->email }}" class="btn">Email this user</a>
                </div>
    
                <form id="deleteForm_{{ $message->id }}" action="{{ route('messages.destroy', $message->id) }}" method="post">
                    @csrf
                    @method('DELETE')
    
                    <button type="button" class="btn_danger"
                        onclick="deleteItem({{ $message->id }}, 'user message');">
                        <i class="fas fa-trash-alt delete"></i>
                        <span>Delete</span>
                    </button>
                </form>
            </div>
        </div>
    </section>

    <x-slot name="scripts">
        <x-sweetalert />
    </x-slot>
</x-authenticated-layout>
