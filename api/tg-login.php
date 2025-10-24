<?php
$BOT_TOKEN = getenv('BOT_TOKEN');
if (!$BOT_TOKEN) { http_response_code(500); echo "BOT_TOKEN is not set"; exit; }
$data = $_GET ?: $_POST;
if (!$data) { http_response_code(400); echo "No data"; exit; }
$hash = $data['hash'] ?? '';
unset($data['hash']);
ksort($data);
$check_array = [];
foreach ($data as $k => $v) { $check_array[] = "$k=$v"; }
$check_string = implode("
", $check_array);
$secret_key = hash('sha256', $BOT_TOKEN, true);
$hmac = hash_hmac('sha256', $check_string, $secret_key);
if (!hash_equals($hmac, $hash)) { http_response_code(401); echo "Bad signature"; exit; }
$uid = $data['id'] ?? null;
if (!$uid) { http_response_code(400); echo "No id"; exit; }
$payload = base64_encode(json_encode(['tid'=>$uid, 't'=>time()]));
setcookie("tsess", $payload, time()+60*60*24*30, "/", "", true, true);
header("Location: /cabinet/");
