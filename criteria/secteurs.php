<?php
/**
 * Rechercher sur le nom du secteur
 */
$query = array(
    'match_phrase' => array(
        'secteurs.name' => 'boucheries'));


/**
 * Retourne les secteurs associes au resultat de la recherche
 * Par exemple si on recherche boucheries
 * Dans le champ $result->aggregations se trouve tous les secteurs
 * des fiches trouvées avec le nom de fiche dans ce secteur
 * Magasins alimentaires : 5
 * Librairie: 1
 *
 * Pratique pour afficher un menu avec les secteurs restant
 * pour filtrer les donnees
 *
 * Plus d'infos https://www.elastic.co/guide/en/elasticsearch/reference/current/search-aggregations.html
 *
 */

$agg = array(
    'secteurs' =>
        array(
            'terms' =>
                array(
                    'field' => 'secteurs.name_display',
                ),
        ),
);

$default = array(
    'query' => $query,
    'suggest'=>$suggest,
    'size' => $size,
    'aggs' => $agg,
    'sort' => $sort,
    '_source' =>
        $select
);

