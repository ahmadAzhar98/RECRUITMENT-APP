
document.addEventListener("DOMContentLoaded", function () {
    // Time Metrics Chart
    const ctx1 = document.getElementById('timeMetricsChart').getContext('2d');
    new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: ['Role 1', 'Role 2', 'Role 3'],
            datasets: [
                {
                    label: 'Time to Fill (days)',
                    data: [40, 45, 50],
                    backgroundColor: 'rgba(75, 192, 192, 0.6)'
                },
                {
                    label: 'Time to Hire (days)',
                    data: [60, 55, 65],
                    backgroundColor: 'rgba(153, 102, 255, 0.6)'
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Application Sources Chart
    const ctx2 = document.getElementById('applicationSourcesChart').getContext('2d');
    new Chart(ctx2, {
        type: 'pie',
        data: {
            labels: ['Job Boards', 'Website', 'Referrals', 'Social Media'],
            datasets: [{
                data: [40, 30, 20, 10],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)'
                ]
            }]
        },
        options: {
            responsive: true
        }
    });

    // Diversity Metrics Chart
    const ctx3 = document.getElementById('diversityMetricsChart').getContext('2d');
    new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: ['Male', 'Female', 'Other'],
            datasets: [{
                label: 'Gender Distribution',
                data: [60, 40, 10],
                backgroundColor: 'rgba(255, 159, 64, 0.6)'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});

