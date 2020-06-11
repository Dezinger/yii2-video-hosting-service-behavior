<?php

return [
    'patterns' => [
        'YouTube' => [
            '/\/\/www.youtube.com\/[-_a-z0-9]+/',
            '/\/\/youtu.be\/[-_a-z0-9]+/',
        ],
        'Vimeo' => [
            '/\/\/vimeo.com\/[-_a-z0-9]+/'
        ],
        'Facebook' => [
            '/\/\/www.facebook.com\/[-_.a-z0-9]+\/videos\/[0-9]+/'
        ],
        'Rutube' => [
            '/\/\/rutube.ru\/video\/[-_a-z0-9]+/'
        ],
        'Dailymotion' => [
            '/\/\/www.dailymotion.com\/video\/[-_a-z0-9]+/'
        ]
    ],

    'urls' => [
        'YouTube' => [
            'info' => 'http://www.youtube.com/oembed?format=json&url=' . 'https://www.youtube.com/watch?v=',
            'iframe' => 'https://www.youtube.com/embed/'
        ],
        'Vimeo' => [
            'info' => 'http://vimeo.com/api/v2/video/',
            'iframe' => 'https://player.vimeo.com/video/'
        ],
        'Facebook' => [
            'info' => 'https://graph.facebook.com/',
            'iframe' => 'http://www.facebook.com/video/embed?video_id='
        ],
        'Rutube' => [
            'info' => 'http://rutube.ru/api/video/',
            'iframe' => 'https://rutube.ru/play/embed/'
        ],
        'Dailymotion' => [
            'info' => 'https://api.dailymotion.com/video/',
            'iframe' => 'https://www.dailymotion.com/embed/video/'
        ]
    ]
];