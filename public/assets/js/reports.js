renderChart();

function renderChart() {
    let chart = new Chart(document.getElementById("chart"),{
        type: 'line',
        data: getChartData(),
    })
}

function getChartData() {
    return {
        labels: data.dates,
        datasets: [
            {
                label: 'count page view A',
                data: data.dates.map((e) => {
                    return data.actions['link-cow'][e] ?? 0;
                }),
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            },
            {
                label: 'count page view B',
                data: data.dates.map((e) => {
                    return data.actions['link-app'][e] ?? 0;
                }),
                fill: false,
                borderColor: 'rgb(92,206,23)',
                tension: 0.1
            },
            {
                label: 'count click "Buy a cow"',
                data: data.dates.map((e) => {
                    return data.actions['button-cow'][e] ?? 0;
                }),
                fill: false,
                borderColor: 'rgb(208,16,16)',
                tension: 0.1
            },
            {
                label: 'count click "Download"',
                data: data.dates.map((e) => {
                    return data.actions['button-app'][e] ?? 0;
                }),
                fill: false,
                borderColor: 'rgb(127,58,225)',
                tension: 0.1
            }
        ]
    };
}