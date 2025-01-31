<x-authenticated-layout class="Dashboard">
    <x-slot name="head">
        <title>Dashboard</title>
    </x-slot>

    <section class="AdminDashboard">
        <div class="stats">
            <div class="stat">
                <span>{{ $count_users }}</span>
                <span>Out of {{ $count_all_users }} users</span>
            </div>

            <div class="stat">
                <span>{{ $count_users }}</span>
                <span>Out of {{ $count_all_users }} users</span>
            </div>

            <div class="stat">
                <span>{{ $count_users }}</span>
                <span>Out of {{ $count_all_users }} users</span>
            </div>

            <div class="stat">
                <span>{{ $count_users }}</span>
                <span>Out of {{ $count_all_users }} users</span>
            </div>

            <div class="stat">
                <span>{{ $count_users }}</span>
                <span>Out of {{ $count_all_users }} users</span>
            </div>
        </div>

        <div class="columns">
            <div class="column">
                <div class="messages">
                    <p class="title">Messages</p>
                    @foreach($messages as $message)
                        <div class="message">
                            <p>
                                <span>{{ $message->name }}</span>
                                <span>{{ $message->email }}</span>
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</x-authenticated-layout>
