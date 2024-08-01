<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Urban Planning Insights</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Google Maps JavaScript API -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDPcXmbNTlOL6p0YwNIpfkZM9xxMn6Vex0"></script>

    <style>
        #map {
            height: 500px; /* Set a specific height for the map */
            width: 100%; /* Set width to 100% */
        }
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        .card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
        .card-header {
            font-size: 1.2em;
            margin-bottom: 10px;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
        }
        .card-content {
            font-size: 1em;
        }
        .color-box {
            width: 20px;
            height: 20px;
            display: inline-block;
            border-radius: 50%;
            margin-right: 10px;
            vertical-align: middle;
        }
        .header {
            display: flex;
            align-items: center;
            background-color: #f19f39;
           
        }
        .header img {
            height: 80px;
            width: auto;
            margin-right: 20px;
        }
        .header h3 {
            color: white;
            margin: 0 20px 0 0;
            flex-shrink: 0;
        }
        .menu {
            display: flex;
            flex-grow: 1;
            justify-content: space-around;
        }
        .menu a {
            color: white;
            padding: 14px 20px;
            text-decoration: none;
            text-align: center;
        }
        .menu a:hover {
            background-color: #10a04a;
        }
    </style>
</head>
<body>
<div class="header">
    <img src="{{asset('images/logo.png')}}" alt="Logo">
    <h3>Lenana Team</h3>
    <div class="menu">
        <a href="{{url('/')}}">Roads</a>
        <a href="{{url('security')}}">Security</a>
        <a href="{{url('upcomingprojects')}}">Participate</a>
    </div>
</div>
<div id="map"></div>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Roads Network Insights
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="card-header">Roads Network Insights</div>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-content">
                        <p><span class="color-box" style="background-color: red;"></span><strong>Red: High Congestion</strong></p>
                        <p><strong>Meaning:</strong> Indicates areas with heavy traffic or significant congestion.<br>
                        <strong>Urban Planning Insight:</strong> Highlight areas where traffic management strategies are needed. Example roads: <em>Lenana Road, Argwings Kodhek Road</em>.</p>

                        <p><span class="color-box" style="background-color: orange;"></span><strong>Orange: Moderate Congestion</strong></p>
                        <p><strong>Meaning:</strong> Shows areas with moderate traffic, which may experience occasional congestion.<br>
                        <strong>Urban Planning Insight:</strong> Identify potential areas for improvement before they become highly congested. Example roads: <em>Ralph Bunche Road, Kirichwa Road</em>.</p>

                        <p><span class="color-box" style="background-color: yellow;"></span><strong>Yellow: Light Traffic</strong></p>
                        <p><strong>Meaning:</strong> Represents areas with light traffic or lower levels of congestion.<br>
                        <strong>Urban Planning Insight:</strong> These roads are currently functioning well but could be optimized further. Example roads: <em>Junction of George Padmore and Hillcrest</em>.</p>

                        <p><span class="color-box" style="background-color: green;"></span><strong>Green: Smooth Traffic Flow</strong></p>
                        <p><strong>Meaning:</strong> Indicates roads with minimal to no congestion, where traffic flows smoothly.<br>
                        <strong>Urban Planning Insight:</strong> Use these roads as models for best practices in road design and traffic management. Example roads: <em>Milimani Road, Vanga Road</em>.</p>

                        <p><span class="color-box" style="background-color: blue;"></span><strong>Blue: Low Usage</strong></p>
                        <p><strong>Meaning:</strong> Represents roads that are less frequently used or have low traffic volumes.<br>
                        <strong>Urban Planning Insight:</strong> These areas may be underutilized, presenting opportunities for development or repurposing. Example roads: <em>Newly developed roads in the eastern parts of Kilimani</em>.</p>

                        <p><span class="color-box" style="background-color: purple;"></span><strong>Purple: High Traffic Volume</strong></p>
                        <p><strong>Meaning:</strong> Shows roads with high traffic volumes, which might not necessarily be congested but are heavily used.<br>
                        <strong>Urban Planning Insight:</strong> Focus on ensuring that these roads are well-maintained and capable of handling the high volume. Example roads: <em>Ngong Road, Kenyatta Avenue</em>.</p>

                        <p><span class="color-box" style="background-color: gray;"></span><strong>Gray: Potential for Development</strong></p>
                        <p><strong>Meaning:</strong> Indicates areas where road infrastructure could be developed or improved.<br>
                        <strong>Urban Planning Insight:</strong> Identify regions where new roads or enhancements to existing roads could facilitate growth and development. Example areas: <em>Undeveloped plots in western Kilimani</em>.</p>

                        <p><span class="color-box" style="background-color: pink;"></span><strong>Pink: Critical Routes</strong></p>
                        <p><strong>Meaning:</strong> Represents essential routes that are crucial for connecting major destinations or for emergency services.<br>
                        <strong>Urban Planning Insight:</strong> Ensure these routes are prioritized for maintenance and improvement. Example roads: <em>Roads leading to major hospitals and schools</em>.</p>

                        <p><span class="color-box" style="background-color: brown;"></span><strong>Brown: Mixed Traffic Conditions</strong></p>
                        <p><strong>Meaning:</strong> Indicates areas with variable traffic conditions, potentially experiencing both high and low congestion at different times.<br>
                        <strong>Urban Planning Insight:</strong> Monitor these areas to understand traffic patterns better and develop flexible solutions to manage varying traffic conditions. Example roads: <em>Adams Arcade to Kilimani connections</em>.</p>

                        <p><span class="color-box" style="background-color: cyan;"></span><strong>Cyan: Recently Updated Infrastructure</strong></p>
                        <p><strong>Meaning:</strong> Represents roads or areas with newly updated infrastructure or recent improvements.<br>
                        <strong>Urban Planning Insight:</strong> Evaluate the effectiveness of recent upgrades and consider further enhancements based on current performance. Example roads: <em>Upgraded sections of Ring Road</em>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-XgfIhMAXS9e8Rq3j2Umd2nnbI4np3Q9byRGozXtBf6AJMjzBaqR12Y5aEk8ksM/V" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script>
    function initMap() {
        var options = {
            zoom: 14,
            center: { lat:  -1.2954, lng: 36.7858 } // Coordinates of Nairobi
        }
        var map = new google.maps.Map(document.getElementById('map'), options);

        // Add traffic layer to the map -1.2954883610369667, 36.78589795285488
        var trafficLayer = new google.maps.TrafficLayer();
        trafficLayer.setMap(map);

        // Define areas with congestion and traffic conditions
        var trafficConditions = [
            { lat: -1.2921, lng: 36.8219, type: 'high-congestion' }, // Example location in Nairobi
            { lat: -1.2931, lng: 36.8229, type: 'moderate-congestion' }, // Example location
            { lat: -1.2941, lng: 36.8239, type: 'light-traffic' }, // Example location
            { lat: -1.2951, lng: 36.8249, type: 'smooth-traffic' }, // Example location
            { lat: -1.2961, lng: 36.8259, type: 'low-usage' }, // Example location
            { lat: -1.2971, lng: 36.8269, type: 'high-traffic-volume' }, // Example location
            { lat: -1.2981, lng: 36.8279, type: 'development-potential' }, // Example location
            { lat: -1.2991, lng: 36.8289, type: 'critical-route' }, // Example location
            { lat: -1.3001, lng: 36.8299, type: 'mixed-traffic' }, // Example location
            { lat: -1.3011, lng: 36.8309, type: 'updated-infrastructure' }, // Example location
        ];

        // Define color codes for traffic conditions
        var trafficColors = {
            'high-congestion': 'red',
            'moderate-congestion': 'orange',
            'light-traffic': 'yellow',
            'smooth-traffic': 'green',
            'low-usage': 'blue',
            'high-traffic-volume': 'purple',
            'development-potential': 'gray',
            'critical-route': 'pink',
            'mixed-traffic': 'brown',
            'updated-infrastructure': 'cyan',
        };

        // Add markers for each traffic condition
        trafficConditions.forEach(function (condition) {
            var marker = new google.maps.Marker({
                position: { lat: condition.lat, lng: condition.lng },
                map: map,
                icon: {
                    path: google.maps.SymbolPath.CIRCLE,
                    scale: 8,
                    fillColor: trafficColors[condition.type],
                    fillOpacity: 1,
                    strokeWeight: 0
                }
            });
        });
    }

    // Initialize the map when the window loads
    window.onload = initMap;
</script>
</body>
</html>
