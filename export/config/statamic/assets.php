<?php

return [

    'image_manipulation' => [

        /*
        |--------------------------------------------------------------------------
        | Route Prefix
        |--------------------------------------------------------------------------
        |
        | The route prefix for serving HTTP based manipulated images through Glide.
        | If using the cached option, this should be the URL of the cached path.
        |
        */

        'route' => 'img',

        /*
        |--------------------------------------------------------------------------
        | Require Glide security token
        |--------------------------------------------------------------------------
        |
        | With this option enabled, you are protecting your website from mass image
        | resize attacks. You will need to generate tokens using the Glide tag
        | but may want to disable this while in development to tinker.
        |
        */

        'secure' => true,

        /*
        |--------------------------------------------------------------------------
        | Image Manipulation Driver
        |--------------------------------------------------------------------------
        |
        | The driver that will be used under the hood for image manipulation.
        | Supported: "gd" or "imagick" (if installed on your server)
        |
        */

        'driver' => 'gd',

        /*
        |--------------------------------------------------------------------------
        | Save Cached Images
        |--------------------------------------------------------------------------
        |
        | Enabling this will make Glide save publicly accessible images. It will
        | increase performance at the cost of the dynamic nature of HTTP based
        | image manipulation. You will need to invalidate images manually.
        |
        */

        'cache' => env('SAVE_CACHED_IMAGES', false),
        'cache_path' => public_path('img'),

        /*
        |--------------------------------------------------------------------------
        | Image Manipulation Presets
        |--------------------------------------------------------------------------
        |
        | Rather than specifying your manipulation params in your templates with
        | the glide tag, you may define them here and reference their handles.
        | They will also be automatically generated when you upload assets.
        |
        */

        'presets' => [
            'xs-webp' => ['w' => 320, 'h' => 10000, 'q' => 85, 'fit' => 'contain', 'fm' => 'webp'],
            'sm-webp' => ['w' => 480, 'h' => 10000, 'q' => 85, 'fit' => 'contain', 'fm' => 'webp'],
            'md-webp' => ['w' => 768, 'h' => 10000, 'q' => 85, 'fit' => 'contain', 'fm' => 'webp'],
            'lg-webp' => ['w' => 1280, 'h' => 10000, 'q' => 85, 'fit' => 'contain', 'fm' => 'webp'],
            'xl-webp' => ['w' => 1440, 'h' => 10000, 'q' => 95, 'fit' => 'contain', 'fm' => 'webp'],
            '2xl-webp' => ['w' => 1680, 'h' => 10000, 'q' => 95, 'fit' => 'contain', 'fm' => 'webp'],
            'xs' => ['w' => 320, 'h' => 10000, 'q' => 85, 'fit' => 'contain'],
            'sm' => ['w' => 480, 'h' => 10000, 'q' => 85, 'fit' => 'contain'],
            'md' => ['w' => 768, 'h' => 10000, 'q' => 85, 'fit' => 'contain'],
            'lg' => ['w' => 1280, 'h' => 10000, 'q' => 85, 'fit' => 'contain'],
            'xl' => ['w' => 1440, 'h' => 10000, 'q' => 95, 'fit' => 'contain'],
            '2xl' => ['w' => 1680, 'h' => 10000, 'q' => 95, 'fit' => 'contain'],
            'og_image' => ['w' => 1200, 'h' => 630, 'q' => 95, 'fit' => 'contain'],
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Additional Uploadable Extensions
    |--------------------------------------------------------------------------
    |
    | Statamic will only allow uploads of certain approved file extensions.
    | If you need to allow more file extensions, you may add them here.
    |
    */

    'additional_uploadable_extensions' => [
        'ico',
    ],

    /*
    |--------------------------------------------------------------------------
    | Auto-Crop Assets
    |--------------------------------------------------------------------------
    |
    | Enabling this will make Glide automatically crop assets at their focal
    | point (at at the center if no focal point is defined). Otherwise,
    | you will need to manually add any crop related parameters.
    |
    */

    'auto_crop' => true,

    /*
    |--------------------------------------------------------------------------
    | Control Panel Thumbnail Restrictions
    |--------------------------------------------------------------------------
    |
    | Thumbnails will not be generated for any assets any larger (in either
    | axis) than the values listed below. This helps prevent memory usage
    | issues out of the box. You may increase or decrease as necessary.
    |
    */

    'thumbnails' => [
        'max_width' => 10000,
        'max_height' => 10000,
    ],

    /*
    |--------------------------------------------------------------------------
    | File Previews with Google Docs
    |--------------------------------------------------------------------------
    |
    | Filetypes that cannot be rendered with HTML5 can opt into the Google Docs
    | Viewer. Google will get temporary access to these files so keep that in
    | mind for any privacy implications: https://policies.google.com/privacy
    |
    */

    'google_docs_viewer' => false,

    /*
    |--------------------------------------------------------------------------
    | Cache Metadata
    |--------------------------------------------------------------------------
    |
    | Asset metadata (filesize, dimensions, custom data, etc) will get cached
    | to optimize performance, so that it will not need to be constantly
    | re-evaluated from disk. You may disable this option if you are
    | planning to continually modify the same asset repeatedly.
    |
    */

    'cache_meta' => true,

    /*
    |--------------------------------------------------------------------------
    | Focal Point Editor
    |--------------------------------------------------------------------------
    |
    | When editing images in the Control Panel, there is an option to choose
    | a focal point. When working with third-party image providers such as
    | Cloudinary it can be useful to disable Statamic's built-in editor.
    |
    */

    'focal_point_editor' => true,
];
