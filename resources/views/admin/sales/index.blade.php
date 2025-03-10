<x-authenticated-layout>
    <x-slot name="head">
        <title>Sales</title>
    </x-slot>

    <section class="Sales">
        <div class="body">
            @if ($sales->isNotEmpty())
                <div class="table">
                    <div class="header">
                        <div class="details">
                            <p class="title">Sales</p>
                            <p class="stats">
                                <span>{{ $count_sales }} {{ Str::plural('Sale', $count_sales) }}</span>
                            </p>
                        </div>
    
                        <x-search-input />
                    </div>
    
                    <table>
                        <thead>
                            <tr>
                                <th class="center">#</th>
                                <th>Order</th>
                                <th>Customer</th>
                                <th>Location</th>
                                <th>Amount</th>
                                <th class="center">Payment</th>
                                <th class="center">Delivery</th>
                                <th class="actions center">Actions</th>
                            </tr>
                        </thead>
            
                        <tbody>
                            @foreach ($sales as $sale)
                                <tr class="searchable {{ ($sale->amount_paid >= $sale->total_amount && $sale->delivery?->delivery_status === 'delivered') ? 'read' : '' }}">
                                    <td class="center">{{ $loop->iteration }}</td>
                                    <td>{{ $sale->order_number }}</td>
                                    <td>
                                        <p>{{ $sale->delivery->full_name ?? '-' }}</p>
                                        <p>{{ $sale->delivery->phone_number ?? '-' }}</p>
                                    </td>
                                    <td>{{ $sale->delivery->location ?? '-' }}</td>
                                    <td>{{ $sale->total_amount ?? '-' }}</td>
                                    <td class="center">
                                        @if($sale->amount_paid >= $sale->total_amount)
                                            <i class="fa fa-check-circle success"></i>
                                        @else
                                            <i class="fa fa-times-circle danger"></i>
                                        @endif
                                    </td>
                                    <td class="center">
                                        @if($sale->delivery?->delivery_status == 'pending')
                                            <i class="fa fa-times-circle danger"></i>
                                        @else
                                            <i class="fa fa-check-circle success"></i>
                                        @endif
                                    </td>
                                    <td class="actions center">
                                        <div class="action">
                                            <a href="{{ route('sales.edit', $sale->id) }}">
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
                <p>No users yet.</p>
            @endif
        </div>
    </section>

    <x-slot name="scripts">
        <x-search />
    </x-slot>
</x-authenticated-layout>
