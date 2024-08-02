<!DOCTYPE html>
<html>
<head>



    <title>Urban Planning Map</title>
    <style>
        #map {
            height: 800px;
            width: 100%;
        }
        #nearest-police-station {
            margin: 20px;
            font-size: 18px;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .header {
            display: flex;
            align-items: center;
            background-color: #f19f39;
            padding: 10px 20px;
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
        .menu-container {
            position: relative;
        }
        .main-menu {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #f19f39;
            padding: 10px;
            flex-wrap: wrap;
        }
        .menu-logo {
            display: flex;
            align-items: center;
        }
        .menu-logo img {
            height: 80px; /* Adjust as needed */
            margin-right: 10px;
        }
        .menu-logo h3 {
            color: white;
            margin: 0;
        }
        .menu-toggle {
            display: none;
            font-size: 24px;
            color: white;
            background-color: #333;
            border: none;
            cursor: pointer;
        }
        .menu-toggle:hover {
            background-color: #10a04a;
        }
        .menu-items {
            display: flex;
            gap: 20px;
        }
        .menu-items a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
        }
        .menu-items a:hover {
            background-color: #10a04a;
        }
        @media (max-width: 600px) {
            .menu-toggle {
                display: block;
            }
            .menu-items {
                display: none;
                flex-direction: column;
                width: 100%;
                background-color: #333;
                position: absolute;
                top: 50px;
                left: 0;
                z-index: 1000;
            }
            .menu-items.show {
                display: flex;
            }
            .menu-items a {
                padding: 15px;
                width: 100%;
                text-align: center;
                box-sizing: border-box;
            }
        }
    </style>
</head>
<body>
<div class="menu-container">
        <nav class="main-menu">
            <div class="menu-logo">
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
                <h3>Lenana Team</h3>
            </div>
            <div class="menu-logo">
                <img src="{{ asset('images/qr.png') }}" alt="Logo">
            </div>
            <button class="menu-toggle" aria-label="Toggle menu">&#9776;</button>
            <div class="menu-items">
                <a href="{{url('/')}}" class="menu-item">Roads</a>
                <a href="{{url('security')}}" class="menu-item">Security</a>
                <a href="{{url('upcomingprojects')}}" class="menu-item">Participate</a>
            </div>
        </nav>
    </div>

    <script>
        document.querySelector('.menu-toggle').addEventListener('click', function() {
            document.querySelector('.menu-items').classList.toggle('show');
        });
    </script>
    <div id="map"></div>
    <div id="nearest-police-station"></div>

    <script>
        // Load the Google Maps API asynchronously
        function loadScript(url, callback) {
            var script = document.createElement("script");
            script.type = "text/javascript";

            if (script.readyState) {  // only required for IE <9
                script.onreadystatechange = function() {
                    if (script.readyState === "loaded" || script.readyState === "complete") {
                        script.onreadystatechange = null;
                        callback();
                    }
                };
            } else {  // Others
                script.onload = function() {
                    callback();
                };
            }

            script.src = url;
            document.getElementsByTagName("head")[0].appendChild(script);
        }

        function initMap() {
            var center = {lat: -1.2921, lng: 36.8219}; // Example: Nairobi coordinates
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 14,
                center: center
            });

            var trafficLayer = new google.maps.TrafficLayer();
            trafficLayer.setMap(map);

            var amenities = {
                police: 'https://maps.google.com/mapfiles/ms/icons/police.png'
            };

            var types = Object.keys(amenities);

            types.forEach(type => fetchAmenities(center, map, type, amenities[type]));
        }

        function fetchAmenities(center, map, type, icon) {
            var request = {
                location: center,
                radius: '3000',
                keyword: type.replace('_', ' ')
            };

            var service = new google.maps.places.PlacesService(map);
            service.nearbySearch(request, function(results, status) {
                if (status == google.maps.places.PlacesServiceStatus.OK) {
                    var policeStations = [];
                    results.forEach(place => {
                        policeStations.push({
                            name: place.name,
                            location: place.geometry.location
                        });

                        var marker = new google.maps.Marker({
                            position: place.geometry.location,
                            map: map,
                            title: place.name,
                            icon: icon
                        });

                        var infowindow = new google.maps.InfoWindow({
                            content: place.name
                        });

                        marker.addListener('click', function() {
                            infowindow.open(map, marker);
                        });
                    });

                    // Call functions to display distances, coverage insights, and nearest police station
                    calculateDistances(policeStations);
                    highlightCoverageGaps(map, policeStations);
                    findNearestPoliceStation(center, policeStations);
                }
            });
        }

        function haversineDistance(coord1, coord2) {
            const R = 6371; // Radius of the Earth in kilometers
            const lat1 = coord1.lat() * (Math.PI / 180);
            const lon1 = coord1.lng() * (Math.PI / 180);
            const lat2 = coord2.lat() * (Math.PI / 180);
            const lon2 = coord2.lng() * (Math.PI / 180);

            const dLat = lat2 - lat1;
            const dLon = lon2 - lon1;

            const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                      Math.cos(lat1) * Math.cos(lat2) *
                      Math.sin(dLon / 2) * Math.sin(dLon / 2);
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

            return R * c; // Distance in kilometers
        }

        function findNearestPoliceStation(center, policeStations) {
            let nearestStation = null;
            let shortestDistance = Infinity;

            policeStations.forEach(station => {
                const distance = haversineDistance(center, station.location);
                if (distance < shortestDistance) {
                    shortestDistance = distance;
                    nearestStation = station;
                }
            });

            // Display the nearest police station information
            if (nearestStation) {
                document.getElementById('nearest-police-station').innerHTML = `
                    <strong>Nearest Police Station:</strong> ${nearestStation.name}<br>
                    <strong>Distance:</strong> ${shortestDistance.toFixed(2)} km
                `;
            } else {
                document.getElementById('nearest-police-station').innerHTML = 'No police stations found.';
            }
        }

        function calculateDistances(policeStations) {
            for (let i = 0; i < policeStations.length; i++) {
                for (let j = i + 1; j < policeStations.length; j++) {
                    const distance = haversineDistance(
                        policeStations[i].location,
                        policeStations[j].location
                    );
                    console.log(`Distance between ${policeStations[i].name} and ${policeStations[j].name} is ${distance.toFixed(2)} km`);
                }
            }
        }

        function highlightCoverageGaps(map, policeStations) {
            policeStations.forEach(station => {
                var circle = new google.maps.Circle({
                    map: map,
                    center: station.location,
                    radius: 1000, // Radius in meters
                    fillColor: '#FF0000',
                    fillOpacity: 0.2,
                    strokeColor: '#FF0000',
                    strokeOpacity: 0.6,
                    strokeWeight: 1
                });
            });

            // Example logic to highlight gaps could be based on coverage density
            console.log('Coverage gaps highlight feature is not implemented.');
        }

        // Replace with your actual Google Maps API key
        var apiKey = "AIzaSyDPcXmbNTlOL6p0YwNIpfkZM9xxMn6Vex0"; // Fetch API key from Laravel config

        // Load Google Maps API and then initialize the map
        loadScript(`https://maps.googleapis.com/maps/api/js?key=${apiKey}&libraries=places&callback=initMap`, function() {
            console.log("Google Maps script loaded and ready.");
        });
    </script>
</body>
</html>