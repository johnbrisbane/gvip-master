<?php
$features = array();
foreach($projects['rows'] as $project => $orgexp)
    
{
    if (strpos(strtoupper($orgexp['keywords']), 'GREEN') !== false) {
        $type = 'green';
    }
    elseif (strpos(strtoupper($orgexp['keywords']), 'BLUE') !== false) {
        $type = 'blue';
    }
    $features[] = array(
        'type' => 'Feature',
        'properties' => array('id' => $orgexp['pid'], 'type' => $type, 'jobs' =>  $model_obj->get_jobs_created($orgexp['pid']), 'location'=> $orgexp['location'], 'description'=> $orgexp['description'], 'projectname'=> $orgexp['projectname'], 'sector'=> $orgexp['sector'], 'stage'=> $orgexp['stage'], 'sponsor'=> $orgexp['sponsor'], 'subsector'=> $orgexp['subsector'], 'slug'=> $orgexp['slug'], 'projectphoto'=> $orgexp['projectphoto'], 'description'=> $orgexp['description'], 'country'=> $orgexp['country'], 'totalbudget'=> $orgexp['totalbudget']),
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

$coord = $projects['rows'][array_rand($projects['rows'])];
$randcoords = '[' . $coord['lng'] . ',' . $coord['lat'] . ']';

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
        <meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
        <link href="https://api.mapbox.com/mapbox-gl-js/v1.9.1/mapbox-gl.css" rel="stylesheet" />
        <script src="https://api.mapbox.com/mapbox-gl-js/v1.9.1/mapbox-gl.js"></script>


    </head>
    <div id='map' style='width: 100%; height: 650px'></div>
    <?php  if(empty($features)){ ?>
        <h1> No Projects Found </h1>
    <?php } else { ?>

        <script>
            mapboxgl.accessToken = 'pk.eyJ1Ijoiam9obmJyaXNiYW5lIiwiYSI6ImNrMDN5czNjNDJhYWgzb3FkdDJxM3JtcXoifQ.o4w_VxKKH6oH1IP9sygfYg';
            var map = new mapboxgl.Map({
                container: 'map',
                style: 'mapbox://styles/mapbox/streets-v11',
                center: <?php echo $randcoords; ?>,
                minZoom: 2,
                zoom: 2
            });

            map.on('load', function() {
                map.addSource('places', {
                    'type': 'geojson',
                    'data': <?php print_r($final_data); ?>
                });

                map.addSource('people', {
                    'type': 'geojson',
                    'data': <?php print_r($people); ?>
                });

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
                            ['get', 'type'],
                            'blue',
                            '#0000ff',
                            'green',
                            '#228B22',
                            /* other */ '#FFFF99'
                        ]
                    }

                });

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

                map.on('mouseenter', 'places', function() {
                    map.getCanvas().style.cursor = 'pointer';
                });

                map.on('mouseleave', 'places', function() {
                    map.getCanvas().style.cursor = '';
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

                    while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
                        coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
                    }
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

            });
        </script>

    <?php } ?>
</div>
