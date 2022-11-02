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

$otherdata =  file_get_contents('county_allocation_per_capita_geojson.json') ;
?>


<!-- MAIN MAP (PROJECTS, EXPERTS)-->
<div>
    <head>
        <meta charset='utf-8' />
        <title>Points on a map</title>
        <meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
        <script src="https://api.mapbox.com/mapbox-gl-js/v1.9.1/mapbox-gl.js"></script>
        <link href="https://api.mapbox.com/mapbox-gl-js/v1.9.1/mapbox-gl.css" rel="stylesheet" />
        <script src="https://npmcdn.com/@turf/turf@5.1.6/turf.min.js"></script>
        <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.min.js'></script>
        <link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.css' type='text/css' />

    </head>
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

            var geocoder = new MapboxGeocoder({
                accessToken: 'pk.eyJ1Ijoiam9obmJyaXNiYW5lIiwiYSI6ImNrMDN5czNjNDJhYWgzb3FkdDJxM3JtcXoifQ.o4w_VxKKH6oH1IP9sygfYg'
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

                map.addSource('countyallocation', {
                    'type': 'geojson',
                    'data':  <?php print_r($otherdata); ?>
                });

                map.addLayer(
                    {
                        'id': 'countyallocation',
                        'source': 'countyallocation',
                        'type': 'fill',
                        'paint': {
                            'fill-color': [
                                'interpolate',
                                ['linear'],
                                ['get', 'allocation'],
                                0,
                                '#ff0000',
                                138,
                                '#ffff00',
                                197,
                                '#00ff00',

                            ],
                            'fill-opacity': 0.75
                        }
                    },
                    'settlement-label'
                );


                // Add a layer showing the places.
                // Add a layer showing the places.
                map.addLayer({
                    'id': 'places',
                    'type': 'circle',
                    'source': 'places',
                    paint: {
                        'circle-radius': 3,
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


                map.on('click', 'countyallocation', function(e) {
// Change the cursor style as a UI indicator.
                    map.getCanvas().style.cursor = 'pointer';

                    var county = e.features[0].properties.NAME;
                    var allocation = Math.round(e.features[0].properties.allocation);


// Populate the popup and set its coordinates
// based on the feature found.
                    popup
                        .setLngLat(e.lngLat)
                        .setHTML("<div class='card' style=\"width: 300px\">"
                            +   "<div>"
                            +       "<p> <strong> County: </strong>" + county +  "</p>"
                            +       "<p> <strong> Allocation: </strong>$" + allocation +  " Per Capita</p>"
                            +"</div>")
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


                    map.setFilter('places', [
                        'in',
                        'id',
                        e.features[0].properties.id
                    ]);

                    var features = map.querySourceFeatures('counties', {
                        sourceLayer: 'original',
                    });

                });

                map.on('mouseleave', 'places', function() {
                    map.getCanvas().style.cursor = '';
                    map.setFilter('places', undefined)
                    overlay2.innerHTML = '';
                });
                map.on('mouseenter', 'places', function() {
                    map.getCanvas().style.cursor = 'pointer';
                });

            });
        </script>

    <?php } ?>
</div>
