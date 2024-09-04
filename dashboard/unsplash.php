<?php
$apiKeyUnsplash = 'zlIvtbEv3FT-2aw_gPwHUHT6BEyzv4CLpj0rHgvLUNI';
$image_url = 'https://api.unsplash.com/photos/random?client_id=' . $apiKeyUnsplash;

$image_data = file_get_contents($image_url);
$image_json = json_decode($image_data);
$image_src = $image_json->urls->small;

echo '<img class="rounded-circle" src="' . $image_src . '" alt="Random Unsplash Image">';

