<!DOCTYPE html>
<html>
<head>
    <title>Urban Planning Map</title>
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
                private_school: {
                    url: 'https://maps.google.com/mapfiles/ms/icons/orange-dot.png',
                    scaledSize: new google.maps.Size(32, 32) // Adjust the size as needed
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
                },
                police: 'https://maps.google.com/mapfiles/ms/icons/police.png',
                pharmacy: 'https://maps.google.com/mapfiles/ms/icons/pharmacies.png',
                restaurant: 'https://maps.google.com/mapfiles/ms/icons/restaurant.png',
                cafe: 'https://maps.google.com/mapfiles/ms/icons/cafe.png',
                bank: 'https://maps.google.com/mapfiles/ms/icons/bank.png',
                park: 'https://maps.google.com/mapfiles/ms/icons/park.png'
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
        var apiKey = "AIzaSyDPcXmbNTlOL6p0YwNIpfkZM9xxMn6Vex0";

        // Load Google Maps API and then initialize the map
        loadScript(`https://maps.googleapis.com/maps/api/js?key=${apiKey}&libraries=places&callback=initMap`, function() {
            console.log("Google Maps script loaded and ready.");
        });
    </script>
</head>
<body>
<div class="header">
        <img src="{{asset('images/logo.png')}}" alt="Logo">
        <h3>lenana Team</h3>
        <div class="menu">
            <a href="#home">Home</a>
            <a href="#services">Services</a>
            <a href="#about">About</a>
            <a href="#portfolio">Portfolio</a>
            <a href="#contact">Contact</a>
            <a href="#blog">Blog</a>
        </div>
    </div>
    <div id="map" style="height: 500px; width: 100%;"></div>
</body>
</html>
