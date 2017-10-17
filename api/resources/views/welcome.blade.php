<?php
$url = 'https://itunes.apple.com/lookup?id=1147018708';
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
$itunes_id = $app->trackId;
$logo = $app->artworkUrl512;
$description = $app->description;
$itunes_url = $app->trackViewUrl;
$identification = $app->bundleId;
$version = $app->version;
$size = $app->fileSizeBytes / 1024 / 1024;
$size = floor($size * 100) / 100;
$price = $app->price;
$coin = $app->currency;
$author = $app->artistName;
$releaseDate = $app->releaseDate;
$currentVersionReleaseDate = $app->currentVersionReleaseDate;
$log = $app->releaseNotes;
$data = [
    'itunes_id' => $itunes_id,
    'logo' => $logo,
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