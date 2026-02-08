 <!-- Main Content Area -->
    {{-- <div class="main-content">
        <h1>Welcome to Admin Dashboard</h1>

        <!-- Profile Management Section -->
        <div class="profile-management">
            <h3>Profile Management</h3>
            <p>Admin Name: {{ auth()->user()->name }}</p>
            <p>Admin Email: {{ auth()->user()->email }}</p>
            <button class="logout-button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </button>
        </div>

        <!-- Dashboard Cards -->
        <div class="dashboard-cards">
            <div class="card">
                <h3>Total Users</h3>
                <p>1,234</p>
            </div>
            <div class="card">
                <h3>Total Orders</h3>
                <p>567</p>
            </div>
            <div class="card">
                <h3>Total Products</h3>
                <p>320</p>
            </div>
        </div>

        <!-- Chart Section -->
        <div class="chart-container">
            <canvas id="userChart"></canvas>
        </div>

        <div class="chart-container">
            <canvas id="ordersChart"></canvas>
        </div>

        <!-- Logout Form (Hidden) -->
        <form id="logout-form" action="{{ route('admin_logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>

    <!-- Chart.js Library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Chart Initialization -->
    <script>
        // Chart for Total Users Growth
        const ctxUserChart = document.getElementById('userChart').getContext('2d');
        const userChart = new Chart(ctxUserChart, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                datasets: [{
                    label: 'Users Growth',
                    data: [100, 300, 400, 500, 800, 1200],
                    backgroundColor: 'rgba(77, 154, 148, 0.5)',
                    borderColor: '#4D9A94',
                    borderWidth: 2,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // Chart for Total Orders
        const ctxOrdersChart = document.getElementById('ordersChart').getContext('2d');
        const ordersChart = new Chart(ctxOrdersChart, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                datasets: [{
                    label: 'Total Orders',
                    data: [50, 100, 150, 200, 300, 500],
                    backgroundColor: '#4D9A94',
                    borderColor: '#333',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script> --}}