<?php

$maPosition = array('lat' => 50.2264867, 'lon' => 5.343159700000001);

$query = array(
    'filtered' => array(
        'query' => array('match' => array('secteurs.name' => 'Restaurants')),
        'filter' =>
            array(
                'geo_distance' =>
                    array(
                        'distance' => '1km',
                        'location' =>
                            array(
                                'lat' => $maPosition['lat'],
                                'lon' => $maPosition['lon']
                            ),
                    ),
            ),
    ),
);


$default = array(
    'query' => $query,
    'size' => $size,
);

$querySring = json_encode($default);

/**
 * Obtenir la distance sur chaque fiche
 *
 */
$sort = array(
    '_geo_distance' =>
        array(
            'location' =>
                array(
                    'lat' => $maPosition['lat'],
                    'lon' => $maPosition['lon']
                ),
            'order' => 'asc',
            'unit' => 'km',
        ),
);

$default = array(
    'query' => $query,
    'size' => $size,
    'sort' => $sort,
);
/**
 * La distance apparait dans le champ sort
 */
$response = curl_exec($elastic);
$data = json_decode($response);
foreach ($result->hits as $doc) {
    $fiche = $doc->_source;
    echo $fiche->societe . " \n";
    echo $doc->sort[0] . " \n";
}

/**
 * plus d'infos : https://www.elastic.co/guide/en/elasticsearch/guide/current/geoloc.html
 */