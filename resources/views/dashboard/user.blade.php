<section class="UserDashboard Dashboard">
    <div class="section stats">
        <div class="stat">
            <span>{{ $count_user_purchases }}</span>
            <span>Total {{ Str::plural('Purchase', $count_user_purchases) }}</span>
        </div>
    </div>

    <div class="section purchases">
        @forelse($user_purchases as $purchase)
            <div class="purchase">
                <p class="title">{{ $purchase->order_number }}</p>
                <p>Amount: {{ number_format($purchase->total_amount, 2) }}</p>
                <p>
                    @if($purchase->amount_paid - $purchase->total_amount >= 0)
                        <span class="success">Paid <i class="fa fa-check-circle"></i></span>
                    @else
                        <span class="danger">Not yet paid.</span>
                    @endif
                </p>

                <p>
                    @if($purchase->delivery?->delivery_status === 'pending' && $purchase->delivery?->location === 'Shop')
                        <span class="danger">Awaiting you to pickup from the shop.</span>
                    @elseif($purchase->delivery?->delivery_status === 'pending' && $purchase->delivery?->location != 'Shop')
                        <span class="danger">The delivery is on its way to {{ $purchase->delivery?->location . ', ' . $purchase->delivery?->area . ', ' . $purchase->delivery?->address  }}</span>
                    @else
                        <span class="success">Delivered <i class="fa fa-check-circle"></i></span>
                    @endif
                </p>
            </div>
        @empty
            <div>
                <p>You've not yet made any purchases.</p>
                <a href="{{ route('shop-page') }}">Start Shopping Now</a>
            </div>
        @endforelse
    </div>
</section>