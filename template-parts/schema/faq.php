<?php
$faqs   = isset($args['faq']) ? $args['faq'] : '';

if(!empty($faqs) && $args['schema']){
    $schema = [
        '@context' => 'https://schema.org',
        '@type' =>  'FAQPage'
    ];

    foreach($faqs as $faq){
        $schema["mainEntity"][]  = [
            "@type" => "Question",
            "name" => addslashes($faq['faq_question']),
            "acceptedAnswer" => [
                "@type" => "Answer",
                "text" => addslashes(strip_tags($faq['faq_answer'],"<a>,<b>,<strong>,<br>,<ul>,<li>,<ol>,<h1>,<h2>,<h4>,<h4>,<h5>,<h6>")),
            ]
        ];
    }
    
    echo "<script type=\"application/ld+json\">".json_encode($schema)."</script>";
}