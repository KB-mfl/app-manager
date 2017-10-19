<?php
$url = 'https://itunes.apple.com/lookup?id=1171676409';
// 1217575505
// 1147018708
// 1171676409
$content = file_get_contents($url);
$json = json_decode($content);
$app = $json->results[0];
// dd($app);
// $pattern = '/id=[0-9]*/';
// $pattern2 = '/[0-9]*/';
// $request = explode('?', substr($url, 0))[1];
// preg_match_all($pattern, $request, $arr);
// preg_match_all($pattern2, $arr[0][0], $arr2);
// $itunes_id = $arr2[0][3];
$itunes_id = isset($app->trackId) ? $app->trackId : null;
$logo = isset($app->artworkUrl512) ? $app->artworkUrl512 : null;
$description = isset($app->description) ? $app->description : null;
$alias = isset($app->trackCensoredName) ? $app->trackCensoredName : null;
$itunes_url = isset($app->trackViewUrl) ? $app->trackViewUrl : null;
$identification = isset($app->bundleId) ? $app->bundleId : null;
$version = isset($app->version) ? $app->version : null;
$size = isset($app->fileSizeBytes) ? $app->fileSizeBytes : null;
$price = isset($app->price) ? $app->price : null;
$coin = isset($app->currency) ? $app->currency : null;
$author = isset($app->artistName) ? $app->artistName : null;
$releaseDate = isset($app->releaseDate) ? $app->releaseDate : null;
$currentVersionReleaseDate = isset($app->currentVersionReleaseDate) ? $app->currentVersionReleaseDate : null;
$log = isset($app->releaseNotes) ? $app->releaseNotes : null;
$data = [
    'itunes_id' => $itunes_id,
    'logo' => $logo,
    'alias' => $alias,
    'description' => $description,
    'itunes_url' => $itunes_url,
    'identification' => $identification,
    'version' => $version,
    'updateLog' => $log,
    'size' => $size,
    'price' => $price,
    'coin' => $coin,
    'author' => $author,
    'releaseDate' => $releaseDate,
    'currentVersionReleaseDate' => $currentVersionReleaseDate,
];
echo json_encode($data);