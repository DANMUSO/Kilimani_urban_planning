<!DOCTYPE html>
<html>
<head>
    <title>Urban Planning Map</title>
    <style>
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
                zoom: 12,
                center: center
            });

            var trafficLayer = new google.maps.TrafficLayer();
            trafficLayer.setMap(map);

            var amenities = {
                hospital: 'https://maps.google.com/mapfiles/ms/icons/hospitals.png',
            };

            var types = Object.keys(amenities);

            types.forEach(type => fetchAmenities(center, map, type, amenities[type]));
        }

        function fetchAmenities(center, map, type, icon) {
            var request = {
                location: center,
                radius: '5000',
                keyword: type.replace('_', ' ') // Using keywords to filter different types of schools
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
                    });
                }
            });
        }

        // Replace with your actual Google Maps API key
        var apiKey = "";

        // Load Google Maps API and then initialize the map
        loadScript(`https://maps.googleapis.com/maps/api/js?key=${apiKey}&libraries=places&callback=initMap`, function() {
            console.log("Google Maps script loaded and ready.");
        });
    </script>
</head>
<body>
<div class="header">
        <img src="{{asset('images/logo.png')}}" alt="Logo">
        <h3>Lenana Team</h3>
        <div class="menu">
            <a href="{{url('/')}}">Roads</a>
            <a href="{{url('security')}}">Security</a>
            <a href="{{url('schools')}}">Schools</a>
            <a href="{{url('hospitals')}}">Hospitals</a>
        </div>
    </div>
    <div id="map" style="height: 500px; width: 100%;"></div>
</body>
</html>