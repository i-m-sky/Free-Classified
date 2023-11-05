<?php
config(['global_variables' => [
    'app_front_url' => env('APP_FRONT_URL'),
    'image_upload_path' => env('IMAGE_UPLOAD_PATH'),
    'default_pending_post_expiry_days' => env('DEFAULT_PENDING_POST_EXPIRY_DAYS'),
    'nsfw_mode' => env('NSFW_MODE'),
    'nsfw_api_key' => env('NSFW_API_KEY'),
    'nsfw_percentage' => env('NSFW_PERCENTAGE'),
    
]]);
