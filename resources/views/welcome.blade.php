<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
                margin: 0;
            }

            #map {
                height: 100vh;
            }

            #chart-container {
                position: absolute;
                width: 30%;
                margin-left: 20px;
                height: calc(100vh - 40px);
                top: 20px;
                /*background-color: white;*/
                z-index: 999;
            }
        </style>

        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
              integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
              crossorigin=""/>
    </head>
    <body class="antialiased">

        <div id="map"></div>

        <div id="chart-container">
            <canvas id="chart" height="100vh" width="100vw"></canvas>
        </div>

        <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
                integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
                crossorigin=""></script>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            let myChart

            async function initializeChart() {
                const data = {
                    labels: [],
                    datasets: []
                }

                console.log(data)

                const response = await fetch('{{ route('api.stations.index') }}')
                const stations = await response.json()

                data.labels = stations.map(s => s.name);
                data.datasets.push({});
                data.datasets[0].label = 'Passengers per Station';
                data.datasets[0].data = stations.map(s => s.passengers_count);
                data.datasets[0].borderWidth = 1;
                data.datasets[0].backgroundColor = 'red';
                data.datasets[0].opacity = 0.5;

                return data
            }
        </script>

        <script>
            function getColor(val) {
                switch (true) {
                    case val <= 250:
                        return '#ffebee'
                    case val <= 500:
                        return '#ffcdd2'
                    case val <=1000:
                        return '#ef9a9a'
                    case val <= 2000:
                        return '#e57373'
                    case val <= 4000:
                        return '#ef5350'
                    case val <= 8000:
                        return '#f44336'
                    case val <= 16000:
                        return '#e53935'
                    case val <= 32000:
                        return '#d32f2f'
                    case val <= 64000:
                        return '#c62828'
                    case val <= 128000:
                        return '#b71c1c'
                    default:
                        return '#ffffff'
                }
            }

            const map = L.map('map', {
                zoomControl: false,
                dragging: false,
                scrollWheelZoom: false,
                doubleClickZoom: false
            }).setView([14.5826, 120.9711], 12);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap'
            }).addTo(map);

            let circles = L.featureGroup()

            async function fetchDataAndCreateMap() {
                const response = await fetch('{{ route('api.stations.index') }}')
                const stations = await response.json()

                if (map.hasLayer(circles)) {
                    console.log('map has layer called circles')
                    map.removeLayer(circles)
                    console.log('reinitialize circles')
                    circles = L.featureGroup()
                }

                stations.forEach(({ name, location, passengers_count }) => {
                    L.circle(location.split(', '), {
                        title: `${name}: ${passengers_count}`,
                        fillOpacity: 0.5,
                        radius: passengers_count
                    })
                        .setStyle({
                            color: getColor(passengers_count)
                        })
                        .bindPopup(`${name}: ${passengers_count}`)
                        .openPopup()
                        .addTo(circles);
                    console.log('adding station')
                })

                console.log('adding circles to map')
                circles.addTo(map)
            }

            document.addEventListener('DOMContentLoaded', async function () {
                await fetchDataAndCreateMap()
                await initializeChart()
            });

            const interval = setInterval(async function () {
                const config = {
                    type: 'bar',
                    animation: false,
                    options: {
                        responsive: true,
                        indexAxis: 'y',
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    },
                }

                const data = await initializeChart()

                if (myChart) {
                    myChart.data = data
                    myChart.update()
                } else {
                    myChart = new Chart(document.getElementById('chart'), config)
                }

                await fetchDataAndCreateMap()
            }, 5 * 1000) // 15K seconds
        </script>
    </body>
</html>
