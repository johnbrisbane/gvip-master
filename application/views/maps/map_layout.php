<?php
$features = array();
foreach($projects['rows'] as $project => $orgexp)
{
    $features[] = array(
        'type' => 'Feature',
        'properties' => array('id' => $orgexp['pid'], 'jobs' =>  $model_obj->get_jobs_created($orgexp['pid']), 'location'=> $orgexp['location'], 'description'=> $orgexp['description'], 'projectname'=> $orgexp['projectname'], 'sector'=> $orgexp['sector'], 'stage'=> $orgexp['stage'], 'sponsor'=> $orgexp['sponsor'], 'subsector'=> $orgexp['subsector'], 'slug'=> $orgexp['slug'], 'projectphoto'=> $orgexp['projectphoto'], 'description'=> $orgexp['description'], 'country'=> $orgexp['country'], 'totalbudget'=> $orgexp['totalbudget']),
        'geometry' => array(
            'type' => 'Point',
            'coordinates' => array(
                $orgexp['lng'] + (rand(-1000,1000)*.00001),
                $orgexp['lat'] + (rand(-1000,1000)*.00001),
                1
            ),
        ),
    );
}
$new_data = array(
    'type' => 'FeatureCollection',
    'features' => $features,
);
$final_data = json_encode($new_data, JSON_PRETTY_PRINT);

$people = array();
foreach($members['rows'] as $members => $orgexp)
{
    $people[] = array(
        'type' => 'Feature',
        'properties' => array('id' => $orgexp['uid'], 'firstname'=> $orgexp['firstname'], 'lastname'=> $orgexp['lastname'], 'organization'=> $orgexp['organization'], 'title'=> $orgexp['title'], 'city'=> $orgexp['city'], 'state'=> $orgexp['state'], 'country'=> $orgexp['country'], 'userphoto'=> $orgexp['userphoto']),
        'geometry' => array(
            'type' => 'Point',
            'coordinates' => array(
                $orgexp['lng'] + (rand(-1000,1000)*.001),
                $orgexp['lat'] + (rand(-1000,1000)*.001),
                1
            ),
        ),
    );
}

$member_data = array(
    'type' => 'FeatureCollection',
    'features' => $people,
);
$people = json_encode($member_data, JSON_PRETTY_PRINT);

?>


<!-- MAIN MAP (PROJECTS, EXPERTS)-->
<div>
        <head>
          <meta charset='utf-8' />
          <title>Points on a map</title>
          <meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
            <script src="https://api.mapbox.com/mapbox-gl-js/v1.9.1/mapbox-gl.js"></script>
            <link href="https://api.mapbox.com/mapbox-gl-js/v1.9.1/mapbox-gl.css" rel="stylesheet" />

        </head>

        <style>
            .marker {
                display: block;
                border: none;
                border-radius: 50%;
                cursor: pointer;
                padding: 0;
            }
        </style>
        <div id='map' style='width: 100%; height: 650px'></div>
        <nav id="menu"></nav>
        <div id="map-overlay" class="map-overlay"></div>
        <div id="map-overlay2" class="map-overlay2"></div>


    <?php  if(empty($features)){ ?>
    <script>
        mapboxgl.accessToken = 'pk.eyJ1Ijoiam9obmJyaXNiYW5lIiwiYSI6ImNrMDN5czNjNDJhYWgzb3FkdDJxM3JtcXoifQ.o4w_VxKKH6oH1IP9sygfYg'; // replace this with your access token
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/johnbrisbane/ck9bswlro0e371ip7g2tuispy', // replace this with your style URL
            center: [-90.661557, 30.893748],
            zoom: 2.5
        });
    </script>
    <?php }
    else { ?>



        <script>
            mapboxgl.accessToken = 'pk.eyJ1Ijoiam9obmJyaXNiYW5lIiwiYSI6ImNrMDN5czNjNDJhYWgzb3FkdDJxM3JtcXoifQ.o4w_VxKKH6oH1IP9sygfYg';
            var map = new mapboxgl.Map({
                container: 'map',
                style: 'mapbox://styles/mapbox/streets-v11',
                center: [-98, 38.88],
                minZoom: 2,
                zoom: 3
            });

            map.on('load', function() {
                map.addSource('places', {
                    'type': 'geojson',
                    'data': <?php print_r($final_data); ?>
                });

                map.addSource('counties', {
                    'type': 'vector',
                    'url': 'mapbox://mapbox.82pkq93d'
                });

                map.addSource('people', {
                    'type': 'geojson',
                    'data': <?php print_r($people); ?>
                });

                // Add a layer showing the places.
                // Add a layer showing the places.
                map.addLayer({
                    'id': 'places',
                    'type': 'circle',
                    'source': 'places',
                    paint: {
                        'circle-radius': 5,
                        'circle-color': 'white',
                        'circle-stroke-width': 4,
                        'circle-opacity': 0.5,
                        'circle-stroke-color': [
                            'match',
                            ['get', 'sector'],
                            'Water',
                            '#0000ff',
                            'Energy',
                            '#00FF00',
                            'Transport',
                            '#e55e5e',
                            'Information & Communication Technologies',
                            '#000000',
                            'Logistics',
                            '#ffffff',
                            /* other */ '#FFFF99'
                        ]
                    }

                });

                map.addLayer(
                    {
                        'id': 'counties-highlighted-jobs',
                        'type': 'fill',
                        'source': 'counties',
                        'source-layer': 'original',
                        'paint': {
                            'fill-outline-color': '#484896',
                            'fill-color': '#6e599f',
                            'fill-opacity': 0.75
                        },
                        'filter': ['in', 'FIPS', '']
                    },
                    'settlement-label'
                ); // Place polygon under these labels.
                map.addLayer(
                    {
                        'id': 'counties-highlighted-jobs-country',
                        'type': 'fill',
                        'source': 'counties',
                        'source-layer': 'original',
                        'paint': {
                            'fill-outline-color': '#484896',
                            'fill-color': '#6e599f',
                            'fill-opacity': 0.75
                        },
                        'filter': ['in', 'FIPS', '']
                    },
                    'settlement-label'
                ); // Place polygon under these labels.

                map.addLayer(
                    {
                        'id': 'counties',
                        'type': 'fill',
                        'source': 'counties',
                        'source-layer': 'original',
                        'paint': {
                            'fill-outline-color': 'rgba(0,0,0,0.1)',
                            'fill-color': 'rgba(0,0,0,0.1)'
                        }
                    },
                    'settlement-label'
                ); // Place polygon under these labels.

                map.addLayer(
                    {
                        'id': 'counties-highlighted',
                        'type': 'fill',
                        'source': 'counties',
                        'source-layer': 'original',
                        'paint': {
                            'fill-outline-color': '#484896',
                            'fill-color': '#6e599f',
                            'fill-opacity': 0.75
                        },
                        'filter': ['in', 'population', '']
                    },
                    'settlement-label'
                ); // Place polygon under these labels.

                map.addLayer({
                    'id': 'people',
                    'type': 'circle',
                    'source': 'people',
                    paint: {
                        'circle-radius': 8,
                        'circle-color': '#223b53',
                        'circle-stroke-color': 'black',
                        'circle-stroke-width': 1,
                        'circle-opacity': 0.5
                    }

                });

                map.addControl(new mapboxgl.NavigationControl());
                map.addControl(new mapboxgl.FullscreenControl());



// Create a popup, but don't add it to the map yet.
                var popup = new mapboxgl.Popup({
                    closeButton: true,
                    closeOnClick: true,
                    maxWidth: '350px'
                });

                var overlay = document.getElementById('map-overlay');
                var overlay2 = document.getElementById('map-overlay2');

                map.getSource('people')._data.features.forEach(function(marker) {
                    // create a DOM element for the marker
                    var photo = marker.properties.userphoto;

                    var el = document.createElement('div');
                    el.className = 'marker';
                    el.style.backgroundImage =
                        'url(https://www.gvip.io/img/member_photos/' + photo + '/)';
                    el.style.width = '20px';
                    el.style.height = '20px';
                    el.style.backgroundSize = '100%';

// add marker to map
                    new mapboxgl.Marker(el)
                        .setLngLat(marker.geometry.coordinates)
                        .addTo(map);
                });


                map.on('click', 'places', function(e) {
// Change the cursor style as a UI indicator.
                    map.getCanvas().style.cursor = 'pointer';

                    var coordinates = e.features[0].geometry.coordinates.slice();
                    var description = e.features[0].properties.description;
                    var projectname = e.features[0].properties.projectname;
                    var country = e.features[0].properties.country;
                    var stage = e.features[0].properties.stage;
                    var sponsor = e.features[0].properties.sponsor;
                    var totalbudget = e.features[0].properties.totalbudget;
                    var slug = e.features[0].properties.slug;
                    var projectphoto = e.features[0].properties.projectphoto;


// Ensure that if the map is zoomed out such that multiple
// copies of the feature are visible, the popup appears
// over the copy being pointed to.
                    while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
                        coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
                    }

// Populate the popup and set its coordinates
// based on the feature found.
                    popup
                        .setLngLat(coordinates)
                        .setHTML("<div class='card' style=\"width: 300px\">"
                            +   "<div>"
                            +       "<a href=\'/projects/" + slug + "\'>"
                            +       "<h1 style=\"text-align: center; font-size: 20px\"> <strong>"
                            +       projectname
                            +       "</strong> </h1>"
                            +       "</a>"
                            +   "</div>"
                            +   "<div>"
                            +      "<img style=\"display: block; margin: auto; padding-top: 10px\" src=\'https://www.gvip.io/img/content_projects/" + projectphoto + "?crop=1&w=250&h=200\'>"
                            +   "</div>"
                            +   "<div>"
                            +       "<p> <strong>Country:</strong> " + country +  "</p>"
                            +       "<p> <strong>Stage:</strong> " + stage +  "</p>"
                            +       "<p> <strong> Sponsor: </strong>" + sponsor +  "</p>"
                            +       "<p> <strong> Value: </strong>" + totalbudget +  "M</p>"
                            +       "<a class=\"light_green\" href=\'/projects/" + slug + "\' role=\"button\">View Project</a>\n"
                            +"</div>")
                        .addTo(map);
                });

                map.on('mousemove', 'counties', function(e) {
// Change the cursor style as a UI indicator.
                    map.getCanvas().style.cursor = 'pointer';

// Single out the first found feature.
                    var feature = e.features[0];

// Query the counties layer visible in the map. Use the filter
// param to only collect results that share the same county name.
                    var relatedFeatures = map.querySourceFeatures('counties', {
                        sourceLayer: 'original',
                        filter: ['in', 'COUNTY', feature.properties.COUNTY]
                    });

// Render found features in an overlay.
                    overlay.innerHTML = '';

                    var title = document.createElement('strong');
                    title.textContent =
                        feature.properties.COUNTY;

                    var population = document.createElement('div');
                    population.textContent =
                        'Total population: ' + feature.properties.population;

                    overlay.appendChild(title);
                    overlay.appendChild(population);
                    overlay.style.display = 'block';

// Add features that share the same county name to the highlighted layer.
                    map.setFilter('counties-highlighted', [
                        'in',
                        'population',
                        feature.properties.population
                    ]);

                });

                map.on('mouseleave', 'counties', function() {
                    map.getCanvas().style.cursor = '';
                    map.setFilter('counties-highlighted', ['in', 'population', '']);
                    overlay.style.display = 'none';
                });


                map.on('mouseenter', 'places', function(e) {

                    overlay2.innerHTML = '';

                    var title = document.createElement('strong');
                    title.textContent =
                        e.features[0].properties.projectname;

                    var population = document.createElement('div');
                    population.textContent =
                        'Total Jobs Created: ' + e.features[0].properties.jobs;

                    overlay2.appendChild(title);
                    overlay2.appendChild(population);
                    overlay2.style.display = 'block';



                    var d = e.features[0].properties.jobs;
                    var constant = 1/d*5000000000;

                    var searchResult = e.features[0].geometry.coordinates;

                    map.setFilter('places', [
                        'in',
                        'id',
                        e.features[0].properties.id
                    ]);

                    var features = map.querySourceFeatures('counties', {
                        sourceLayer: 'original',
                    });

                    function getDistance(lat1, lon1, lat2, lon2, unit) {
                        if ((lat1 == lat2) && (lon1 == lon2)) {
                            return 0;
                        }
                        else {
                            var radlat1 = Math.PI * lat1/180;
                            var radlat2 = Math.PI * lat2/180;
                            var theta = lon1-lon2;
                            var radtheta = Math.PI * theta/180;
                            var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
                            if (dist > 1) {
                                dist = 1;
                            }
                            dist = Math.acos(dist);
                            dist = dist * 180/Math.PI;
                            dist = dist * 60 * 1.1515;
                            if (unit=="K") { dist = dist * 1.609344 }
                            if (unit=="N") { dist = dist * 0.8684 }
                            return dist;
                        }
                    }

                    var i;
                    var countycoords;
                    var projectcoords;
                    var arr = [];
                    var d;

                    for (i = 0; i < features.length; i++) {

                        countycoords = features[i].geometry.coordinates[0][0];
                        projectcoords = searchResult;
                        d = getDistance(countycoords[1], countycoords[0], projectcoords[1], projectcoords[0],'M')

                        if (d > 300 && d < 500 && features[i].properties.population > 500000){
                            arr.push(features[i].properties.FIPS);
                        }
                        else if (d < 300 && d > 200 && features[i].properties.population > 300000){
                            arr.push(features[i].properties.FIPS);
                        }
                        else if (d < 200 && d > 150 && features[i].properties.population > 160000){
                            arr.push(features[i].properties.FIPS);
                        }
                        else if (d < 150 && d > 100 && features[i].properties.population > 80000){
                            arr.push(features[i].properties.FIPS);
                        }
                        else if (d < 100 && d > 50 && features[i].properties.population > 40000){
                            arr.push(features[i].properties.FIPS);
                        }
                        else if (d < 50){
                            arr.push(features[i].properties.FIPS);
                        }
                    }


                    function buildFilter(arr) {
                        var filter = ['in', 'FIPS'];

                        if (arr.length === 0) {
                            return filter;
                        }

                        for(var i = 0; i < arr.length; i += 1) {
                            filter.push(arr[i]);
                        }

                        return filter;
                    }

                    var filterBy = arr;
                    var myFilter = buildFilter(filterBy);

                    map.setFilter('counties-highlighted-jobs', myFilter);
                    map.setFilter('counties-highlighted-jobs-country',['>', 'population', constant]);



                });

                map.on('mouseleave', 'places', function() {
                    map.getCanvas().style.cursor = '';
                    map.setFilter('counties-highlighted-jobs', ['in', 'FIPS', '']);
                    map.setFilter('counties-highlighted-jobs-country',['in', 'FIPS', '']);
                    map.setFilter('places', undefined)
                    overlay2.innerHTML = '';
                });
                map.on('mouseenter', 'places', function() {
                    map.getCanvas().style.cursor = 'pointer';
                });

                var popuppeople = new mapboxgl.Popup({
                    closeButton: true,
                    closeOnClick: true,
                    maxWidth: '350px'
                });

                map.on('click', 'people', function(e) {
// Change the cursor style as a UI indicator.
                    map.getCanvas().style.cursor = 'pointer';

                    var coordinates = e.features[0].geometry.coordinates.slice();
                    var organization = e.features[0].properties.organization;
                    var fullname = e.features[0].properties.firstname + ' ' + e.features[0].properties.lastname;
                    var title = e.features[0].properties.title;
                    var city = e.features[0].properties.city;
                    var state = e.features[0].properties.state;
                    var country = e.features[0].properties.country;
                    var id = e.features[0].properties.id;
                    var photo = e.features[0].properties.userphoto;


// Ensure that if the map is zoomed out such that multiple
// copies of the feature are visible, the popup appears
// over the copy being pointed to.
                    while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
                        coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
                    }

// Populate the popup and set its coordinates
// based on the feature found.
                    popuppeople
                        .setLngLat(coordinates)
                        .setHTML("<div class='card' style=\"width: 300px\">"
                            +   "<div>"
                            +       "<a href=\'/experts/" + id + "\'>"
                            +       "<h1 style=\"text-align: center; font-size: 20px\"> <strong>"
                            +       fullname
                            +       "</strong> </h1>"
                            +       "</a>"
                            +   "</div>"
                            +   "<div>"
                            +      "<img style=\"display: block; margin: auto; padding-top: 10px\" src=\'https://www.gvip.io/img/member_photos/" + photo + "?crop=1&w=250&h=200\'>"
                            +   "</div>"
                            +   "<div>"
                            +       "<p> <strong>Details: </strong>" + title + " at " + organization + "</p>"
                            +       "<p> <strong>Location:</strong> " + city +  " " + country + "</p>"
                            +       "<a class=\"light_green\" href=\'/experts/" + id + "\' role=\"button\">View Profile</a>\n"
                            +"</div>")
                        .addTo(map);
                });


                map.on('mouseleave', 'people', function() {
                    map.getCanvas().style.cursor = '';
                });

                map.on('mouseenter', 'people', function() {
                    map.getCanvas().style.cursor = 'pointer';
                });



//Start of Toggle Layers
// enumerate ids of the layers
               /* var toggleableLayerIds = ['places', 'election'];

// set up the corresponding toggle button for each layer
                for (var i = 0; i < toggleableLayerIds.length; i++) {
                    var id = toggleableLayerIds[i];

                    var link = document.createElement('a');
                    link.href = '#';
                    link.className = 'active';
                    link.textContent = id;

                    link.onclick = function (e) {
                        var clickedLayer = this.textContent;
                        e.preventDefault();
                        e.stopPropagation();

                        var visibility = map.getLayoutProperty(clickedLayer, 'visibility');

// toggle layer visibility by changing the layout object's visibility property
                        if (visibility === 'visible') {
                            map.setLayoutProperty(clickedLayer, 'visibility', 'none');
                            this.className = '';
                        } else {
                            this.className = 'active';
                            map.setLayoutProperty(clickedLayer, 'visibility', 'visible');
                        }
                    };

                    var layers = document.getElementById('menu');
                    layers.appendChild(link);
                }

                */

            });
        </script>

    <?php } ?>
</div>
