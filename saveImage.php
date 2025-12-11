<?php
header("Access-Control-Allow-Origin: *");

$fi = fopen("php://input", "rb");
$json = fread($fi, 2000);
$meta = json_decode($json);

$fname = basename($meta->source);
$savepath = "uploads/" . $fname;

$fo = fopen($savepath, "wb");
while ($chunk = fread($fi, 50000)) {
    fwrite($fo, $chunk);
}
fclose($fi);
fclose($fo);

$response = [
    "message" => "Successfully saved to Photo Bongo!",
    "script"  => "app.echoToOE('Saved on server');",
    "newSource" => "https://yourdomain.com/uploads/" . $fname
];

header("Content-Type: application/json");
echo json_encode($response);
?>
