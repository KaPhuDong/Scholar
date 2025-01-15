const labels = ["Week 1", "Week 2", "Week 3", "Week 4"];

        const noteData = [10, 15, 20, 18];
        const gearData = [8, 12, 18, 22];
        const writeData = [5, 10, 15, 12];
        const orderData = [5, 10, 30, 15];

        const ctx = document.getElementById('categoryChart').getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Note',
                        data: noteData,
                        backgroundColor: 'rgba(255, 99, 132, 0.5)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Gear',
                        data: gearData,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Write',
                        data: writeData,
                        backgroundColor: 'rgba(255, 206, 86, 0.5)',
                        borderColor: 'rgba(255, 206, 86, 1)',
                        borderWidth: 1
                    },
                    {
                        type: 'line',
                        label: 'Total Orders',
                        data: orderData,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        tension: 0.4,
                        fill: false
                    }
                ]
            },
            options: {
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Weeks'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Quantity'
                        },
                        beginAtZero: true
                    }
                }
            }
        });