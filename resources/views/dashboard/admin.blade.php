<section class="AdminDashboard">
    <div class="section stats">
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

    <div class="section messages">
        <p class="title">Unread Messages</p>
        @foreach($messages as $message)
            <div class="message">
                <p class="stack">
                    <a href="{{ route('messages.edit', $message->id) }}">
                        {{ $message->excerpt }}
                    </a>
                    <span>{{ $message->name }}</span>
                </p>
            </div>
        @endforeach
    </div>
</section>