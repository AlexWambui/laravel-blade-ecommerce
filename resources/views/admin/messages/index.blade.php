<x-authenticated-layout class="Contact">
    <x-slot name="head">
        <title>Messages</title>
    </x-slot>

    <div class="body">
        @if ($messages->isNotEmpty())
            <div class="table">
                <div class="header">
                    <div class="details">
                        <p class="title">Messages</p>
                        <p class="stats">
                            <span>{{ $unread_messages }} {{ Str::plural('unread message', $unread_messages) }}</span>
                        </p>
                    </div>

                    <x-search-input />
                </div>

                <table>
                    <thead>
                        <tr>
                            <th class="center">#</th>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>Message</th>
                            <th>Time</th>
                            <th class="actions">Actions</th>
                        </tr>
                    </thead>
        
                    <tbody>
                        @foreach ($messages as $message)
                            <tr class="searchable {{ $message->status == 1 ? 'read' : '' }}">
                                <td class="center">{{ $loop->iteration }}</td>
                                <td>{{ $message->name }}</td>
                                <td class="stack">
                                    <span>{{ $message->email }}</span>
                                    <span>{{ $message->phone_number }}</span>
                                </td>
                                <td>{{ $message->excerpt }}</td>
                                <td>{{ formatted_date($message->created_at) }}</td>
                                <td class="actions center">
                                    <div class="action">
                                        <a href="{{ route('messages.edit', $message->id) }}">
                                            <span class="fas fa-eye"></span> 
                                        </a> 
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p>No messages yet.</p>
        @endif
    </div>

    <x-slot name="scripts">
        <x-search />
    </x-slot>
</x-authenticated-layout>
