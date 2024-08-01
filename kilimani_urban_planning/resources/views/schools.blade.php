<!DOCTYPE html>
<html>
<head>
    <title>Urban Planning Map</title>
    <style>
        #map {
            height: 500px;
            width: 100%;
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
    <!-- Load Google Maps and Google Maps Visualization libraries -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDPcXmbNTlOL6p0YwNIpfkZM9xxMn6Vex0&libraries=places,visualization"></script>
</head>
<body>
<div class="header">
        <img src="{{asset('images/logo.png')}}" alt="Logo">
        <h3>Lenana Team</h3>
        <div class="menu">
            <a href="{{url('/')}}">Roads</a>
            <a href="{{url('security')}}">Security</a>
            <a href="{{url('upcomingprojects')}}">Upcoming Projects</a>
            <a href="{{url('hospitals')}}">Smart Traffic(Sensor)</a>
        </div>
    </div>
    <div id="map"></div>

    <script>
        function initMap() {
            var center = {lat: -1.2921, lng: 36.8219}; // Nairobi coordinates
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 12,
                center: center
            });

            var amenities = {
                private_school: {
                    url: 'https://maps.google.com/mapfiles/ms/icons/orange-dot.png',
                    scaledSize: new google.maps.Size(32, 32)
                },
                public_school: {
                    url: 'https://maps.google.com/mapfiles/ms/icons/blue-dot.png',
                    scaledSize: new google.maps.Size(32, 32)
                },
                secondary_school: {
                    url: 'https://maps.google.com/mapfiles/ms/icons/green-dot.png',
                    scaledSize: new google.maps.Size(32, 32)
                },
                college: {
                    url: 'https://maps.google.com/mapfiles/ms/icons/pink-dot.png',
                    scaledSize: new google.maps.Size(32, 32)
                },
                university: {
                    url: 'https://maps.google.com/mapfiles/ms/icons/purple-dot.png',
                    scaledSize: new google.maps.Size(32, 32)
                }
            };

            var types = Object.keys(amenities);
            var schools = [];

            types.forEach(type => {
                fetchAmenities(center, map, type, amenities[type], schools);
            });
        }

        function fetchAmenities(center, map, type, icon, schools) {
            var request = {
                location: center,
                radius: '5000',
                keyword: type.replace('_', ' ')
            };

            var service = new google.maps.places.PlacesService(map);
            service.nearbySearch(request, function(results, status) {
                if (status == google.maps.places.PlacesServiceStatus.OK) {
                    results.forEach(place => {
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

                        schools.push({
                            name: place.name,
                            location: place.geometry.location,
                            type: type
                        });
                    });

                    // Create heatmap and calculate distances after fetching amenities
                    createHeatmap(map, schools);
                    calculateDistances(schools);
                }
            });
        }

        function calculateDistances(schools) {
            const haversineDistance = (coord1, coord2) => {
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
            };

            for (let i = 0; i < schools.length; i++) {
                for (let j = i + 1; j < schools.length; j++) {
                    const distance = haversineDistance(
                        schools[i].location,
                        schools[j].location
                    );
                    console.log(`Distance between ${schools[i].name} and ${schools[j].name} is ${distance.toFixed(2)} km`);
                }
            }
        }

        function createHeatmap(map, schools) {
            const heatmapData = schools.map(loc => new google.maps.LatLng(loc.location.lat(), loc.location.lng()));

            const heatmap = new google.maps.visualization.HeatmapLayer({
                data: heatmapData,
                map: map,
                radius: 20 // Adjust radius as needed
            });
        }

        // Initialize the map when the window loads
        window.onload = initMap;
    </script>
</body>
</html>