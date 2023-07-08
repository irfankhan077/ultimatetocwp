<?php
$obj = $args['obj'];
if($obj['opening_hours']):
    $w = array('0'=>'Monday','1'=>'Tuesday','2'=>'Wednesday','3'=>'Thursday','4'=>'Friday','5'=>'Saturday','6'=>'Sunday');
    foreach($obj['opening_hours'] as $key => $week):
        $wk[$key]['@type']      =   'OpeningHoursSpecification';
        $wk[$key]['closes']     =   $week['close'];
        $wk[$key]['dayOfWeek']  =   'https://schema.org/'.$w[$week['day']];
        $wk[$key]['opens']      =   $week['open'];
    endforeach;
endif;
// Local Business
$schema = [
    '@context' => 'https://schema.org',
    '@type' => 'Organization',
    'name' => $obj['name'],
    'description' => $obj['description'],
    'url' => $obj['url'],
    'logo' => $obj['logo'],
    'image' => $obj['logo'],
    'telephone' => $obj['phone'],
    'openingHoursSpecification' => $wk,
    'address' => [
        '@type' => 'PostalAddress',
        'streetAddress' => $obj['address']['street_address'],
        'addressLocality' => $obj['address']['address_locality'],
        'addressRegion' => $obj['address']['address_region'],
        'postalCode' => $obj['address']['postal_code'],
        'addressCountry' => [
            '@type' => 'Country',
            'name' => $obj['address']['country']
        ]
    ]
];
if($obj['sameas']){
    foreach($obj['sameas'] as $sameas){
        $schema['sameas'][] = $sameas['url'];
    }
}
if($obj['latitude'] && $obj['longitude']){
    $schema['geo'] = [
        '@type' => 'GeoCoordinates',
        'latitude' => $obj['latitude'],
        'longitude' => $obj['longitude']
    ];
}
echo "<script type=\"application/ld+json\">".json_encode($schema)."</script>";
