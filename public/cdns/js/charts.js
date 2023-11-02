    // AJAX request to fetch order rush hour data
    $.ajax({
        url: '/order-rush-hour',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            // Create a chart using Chart.js (ensure you include the Chart.js library)
            var ctx = document.getElementById('orderRushHourChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Orders',
                        data: data.data,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                    }],
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                },
            });
        },
        error: function (xhr, status, error) {
            console.error(error);
        },
    });

    //end of rush chart
    //start of daily delivery oeders chart

   


// Fetch data from the backend
async function fetchData(deliveryId) {
    const response = await fetch(`/delivery-revenue-chart/${deliveryId}`);
    const data = await response.json();
    return data;
}

async function createChart(deliveryId) {
    const data = await fetchData(deliveryId);

    const labels = data.map(item => item.order_date);
    const totalRevenue = data.map(item => item.total_revenue);
    const orderCount = data.map(item => item.order_count);

    const ctx = document.getElementById('deliveryRevenueChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                    label: translations.totalRevenue,
                    data: totalRevenue,
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                },
                {
                    label: translations.orderCount,
                    data: orderCount,
                    backgroundColor: 'rgba(255, 99, 132, 0.6)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Total Revenue / Order Count'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Order Date'
                    }
                }
            }
        }
    });
}

// Retrieve the delivery ID from the data attribute
const deliveryId = document.getElementById('deliveryRevenueChart').getAttribute('data-delivery-id');

// Create the chart with the delivery ID
createChart(deliveryId);

    //end of daily delivery orders chart
    //start of weekly delivery orders chart

async function createWeeklyChart(deliveryId2) {
    const data = await fetchWeeklyData(deliveryId2);

    const labels = data.map(item => `Week ${item.week_number}, ${item.year}`);
    const totalRevenue = data.map(item => item.total_revenue);
    const orderCount = data.map(item => item.order_count);

    const ctx = document.getElementById('deliveryWeeklyRevenueChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                    label: translations.totalRevenue,
                    data: totalRevenue,
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                },
                {
                    label: translations.orderCount,
                    data: orderCount,
                    backgroundColor: 'rgba(255, 99, 132, 0.6)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Total Revenue / Order Count'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Week'
                    }
                }
            }
        }
    });
}

async function fetchWeeklyData(deliveryId2) {
    const response = await fetch(`/delivery-weekly-revenue-chart/${deliveryId2}`);
    const data = await response.json();
    return data;
}

// Retrieve the delivery ID from the data attribute
const deliveryId2 = document.getElementById('deliveryWeeklyRevenueChart').getAttribute('data-delivery-id');

// Create the weekly chart with the delivery ID
createWeeklyChart(deliveryId2);

    //end of weekly delivery orders chart

    //start of monthly delivery orders chart

    let myChart;

    // Function to create or update the monthly chart
async function createOrUpdateMonthlyChart(deliveryId3, selectedMonth = null) {
    const data = await fetchMonthlyData(deliveryId3, selectedMonth);

    const labels = data.map(item => {
        const year = item.year;
        const month = item.month;
        return `${year}-${month.toString().padStart(2, '0')}`;
    });
    const totalRevenue = data.map(item => item.total_revenue);
    const orderCount = data.map(item => item.order_count);

    const ctx = document.getElementById('deliveryMonthlyRevenueChart').getContext('2d');

    // Destroy the existing chart instance to prevent unexpected behavior
    if (myChart) {
        myChart.destroy();
    }

    myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: translations.totalRevenue,
                    data: totalRevenue,
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                },
                {
                    label: translations.orderCount,
                    data: orderCount,
                    backgroundColor: 'rgba(255, 99, 132, 0.6)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Total Revenue / Order Count'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Month'
                    }
                }
            }
        }
    });
}

// Function to fetch monthly data for the specific delivery ID and selected month
async function fetchMonthlyData(deliveryId3, selectedMonth = null) {
    let url = `/delivery-monthly-revenue-chart/${deliveryId3}`;
    if (selectedMonth && selectedMonth !== 'all') {
        url += `?month=${selectedMonth}`;
    }

    const response = await fetch(url);
    const data = await response.json();
    return data;
}

// Retrieve the delivery ID from the data attribute
const deliveryId3 = document.getElementById('deliveryMonthlyRevenueChart').getAttribute('data-delivery-id');

// Create the initial monthly chart with the delivery ID (showing data for all months)
createOrUpdateMonthlyChart(deliveryId3);

// Update the chart when the select element changes
document.getElementById('monthFilter').addEventListener('change', function() {
    createOrUpdateMonthlyChart(deliveryId3, this.value);
});


    //end of monthly delivery orders chart



