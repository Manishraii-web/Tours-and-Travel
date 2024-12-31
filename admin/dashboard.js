// Replace with your actual API endpoints or data sources
const apiEndpoints = {
    users: '/api/users',
    bookings: '/api/bookings',
    tours: '/api/tours',
    revenue: '/api/revenue',
};

// Fetch data from API endpoints
async function fetchData() {
    try {
        const responses = await Promise.all([
            fetch(apiEndpoints.users),
            fetch(apiEndpoints.bookings),
            fetch(apiEndpoints.tours),
            fetch(apiEndpoints.revenue),
        ]);

        const [usersData, bookingsData, toursData, revenueData] = await Promise.all(
            responses.map(response => response.json())
        );

        // Update UI with fetched data
        document.getElementById('totalUsers').textContent = usersData.length;
        document.getElementById('totalBookings').textContent = bookingsData.length;
        document.getElementById('availableTours').textContent = toursData.length;
        document.getElementById('totalRevenue').textContent = `$${revenueData.total}`;

        // Populate recent bookings table
        const bookingsTableBody = document.querySelector('#bookingsTable tbody');
        bookingsTableBody.innerHTML = '';
        bookingsData.slice(0, 5).forEach(booking => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${booking.id}</td>
                <td>${booking.user.name}</td>
                <td>${booking.tour.name}</td>
                <td>$${booking.amount}</td>
                <td>${new Date(booking.date).toLocaleDateString()}</td>
            `;
            bookingsTableBody.appendChild(row);
        });

        // Create a Chart.js chart (example: bookings over time)
        const ctx = document.getElementById('bookingsChart').getContext('2d');
        const labels = bookingsData.map(booking => new Date(booking.date).toDateString());
        const data = bookingsData.map(booking => booking.amount);
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Booking Amounts',
                    data: data,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    x: {
                        type: 'time',
                        time: {
                            unit: 'day'
                        }
                    }
                }
            }
        });

    } catch (error) {
        console.error('Error fetching data:', error);
        // Handle errors gracefully (e.g., display an error message)
    }
}

fetchData();