<section class="AdminDashboard">
    <div class="section stats">
        <div class="stat">
            <span>{{ $count_users }}</span>
            <span>Out of {{ $count_all_users }} users</span>
        </div>

        <div class="stat">
            <span>{{ $count_products }}</span>
            <span>Products and {{ $count_product_categories }} categories</span>
        </div>

        <div class="stat">
            <span>{{ $count_sales }}</span>
            <span>Total Sales</span>
        </div>

        <div class="stat">
            <span>{{ $count_locations }}</span>
            <span>Locations and {{ $count_areas }} areas</span>
        </div>

        <div class="stat">
            <span>{{ $count_all_messages }}</span>
            <span>Total Messages</span>
        </div>
    </div>

    <div class="section stats sales">
        <div class="stat">
            <span>{{ number_format($gross_sales, 0) }}</span>
            <span>Gross Sales</span>
        </div>

        <div class="stat">
            <span>{{ number_format($net_sales, 0) }}</span>
            <span>Net Sales</span>
        </div>

        <div class="stat">
            <span>{{ number_format($cost_of_sales, 0) }}</span>
            <span>Cost of Sales</span>
        </div>

        <div class="stat">
            <span>{{ number_format($gross_profit, 0) }}</span>
            <span>Gross Profit</span>
        </div>
    </div>

    <div class="section charts">
        <div class="charts">
            <div class="chart">
                <h2>Sales</h2>
                <canvas id="salesChart"></canvas>
            </div>

            <div class="chart">
                <h2>Order Locations</h2>
                <canvas id="citiesChart"></canvas>
            </div>
        </div>
    </div>

    <div class="section messages">
        <p class="title">Unread Messages</p>
        @forelse($messages as $message)
            <div class="message">
                <p class="stack">
                    <a href="{{ route('messages.edit', $message->id) }}">
                        {{ $message->excerpt }}
                    </a>
                    <span>{{ $message->name }}</span>
                </p>
            </div>
        @empty
            <p>There's not unread messages</p>
        @endforelse
    </div>

    <x-slot name="scripts">
        <script src="{{ asset('assets/js/chart.js') }}"></script>
        <script>
            const ctx = document.getElementById('salesChart');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Amount',
                        data: {!! json_encode($sales_data) !!},
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                }
            });

            const cities = document.getElementById('citiesChart');
            new Chart(cities, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($locations_labels) !!},
                    datasets: [{
                        label: 'Orders',
                        data: {!! json_encode($locations_orders) !!},
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'right',
                        }
                    }
                }
            });
        </script>
    </x-slot>
</section>