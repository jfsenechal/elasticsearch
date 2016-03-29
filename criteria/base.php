<?php

/**
 * ON CONSTRUIT LES CRITERES
 */

//nbre de records retourne
$size = 1;
//correspond à SELECT champs en SQL
$select = array('societe', 'telephone', 'secteurs');
//le tri
$sort = array(
    'societe' =>
        array(
            'order' => 'desc',
        ),
);

$default = array(
    'query' => $query,
    'size' => $size,
    'sort' => $sort,
    '_source' =>
        $select
);

$querySring = json_encode($default);

/**
 * ON ENVOIE LA REQUETE
 */

$urlCurl = "URL.../bottin/_search";
$elastic = curl_init($urlCurl);
curl_setopt($elastic, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($elastic, CURLOPT_PORT, 9200);
curl_setopt($elastic, CURLOPT_HEADER, false);
curl_setopt($elastic, CURLOPT_RETURNTRANSFER, true);
curl_setopt($elastic, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($querySring)
));
curl_setopt($elastic, CURLOPT_POSTFIELDS, $querySring);
$response = curl_exec($elastic);
curl_close($elastic);
$data = json_decode($response);
/**
 * GESTION DES ERREURS
 */
if (isset($data->error)) {
    $error = $data->error;
    $error = $data->error;
    $rootCause = $error->root_cause;
    echo "\n Error \n";
    print_r($rootCause[0]->type);
    echo "\n \n";
    print_r($rootCause[0]->reason);
    echo "\n \n";
    return;
}

/**
 * Dans result on stock les rows retournés
 */
$result = $data->hits;
$total = $result->total;

echo " \n \n Total: $total \n \n";

foreach ($result->hits as $doc) {
    $fiche = $doc->_source;
    echo $fiche->societe . " \n";
}
