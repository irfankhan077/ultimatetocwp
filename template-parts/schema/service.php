<?php
$service = new NSM_Service(get_the_ID());

$schema = [
    '@context' => "https://schema.org",
    "@type" => "Service",
    'serviceType' => get_the_title(),
    'url' => get_the_permalink(),
    'description' => get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true)
];

// Append localBusiness to Service
if(get_field('local_business_schema', 'option') != false){
    $lb = get_field('local_business_schema', 'option');

    $schema['provider'] = [
        '@context' => 'https://schema.org',
        '@type' => 'LocalBusiness',
        'name' => $lb['name'],
        'description' => $lb['description'],
        'url' => $lb['url'],
        'logo' => $lb['logo'],
        'image' => $lb['logo'],
        'telephone' => $lb['phone'],
        'openingHoursSpecification' => [
            '@type' => 'OpeningHoursSpecification',
            'opens' => '00:00',
            'closes' => '23:59',
            'dayOfWeek' => [
                'Monday',
                'Tuesday',
                'Wednesday',
                'Thursday',
                'Friday',
                'Saturday',
                'Sunday'
              ],
        ],
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => $lb['address']['street_address'],
            'addressLocality' => $lb['address']['address_locality'],
            'addressRegion' => $lb['address']['address_region'],
            'postalCode' => $lb['address']['postal_code'],
            'addressCountry' => [
                '@type' => 'Country',
                'name' => $lb['address']['country']
            ]
        ]
    ];
    if($lb['sameas']){
        foreach($lb['sameas'] as $sameas){
            $schema['provider']['sameas'][] = $sameas['url'];
        }
    }
    if($lb['latitude'] && $lb['longitude']){
        $schema['provider']['geo'] = [
            '@type' => 'GeoCoordinates',
            'latitude' => $lb['latitude'],
            'longitude' => $lb['longitude']
        ];
    }
}

echo "<script type=\"application/ld+json\">".json_encode($schema)."</script>";