<?php
/**
 *Tout afficer
 */
$query = array(
    'match_all' =>
        array(),
);

/**
 * match = CONTIENT BUREAU OU MEMO
 * match_phrase = PHRASE EXACTE "BUREAU MEMO"
 */
$query = array(
    'match_phrase' => array('societe' => 'BUREAU MEMO'));

/**
 *
 */
$query = array(
    'match' => array(
        'societe' => 'BUREAU',
        'operator' => 'and'
    ),
);

/**
 * QUERY BOOLEAN : must, should, must_not
 * DOIT CONTENIR BUREAU OU MEME MAIS PAS DENTZ
 */
$query = array(
    'bool' =>
        array(
            'should' =>
                array(
                    array(
                        'match' => array(
                            'societe' => 'BUREAU',
                        ),
                    ),
                    array(
                        'match' => array(
                            'societe' => 'MEMO',
                        ),
                    ),
                ),
            'must_not' =>
                array(
                    array(
                        'match' =>
                            array(
                                'societe' => 'DENTZ',
                            ),
                    ),
                )),
);