<?php

$access_token = 'gRP11kd70ugrgwJ32KnBzLZHAHSMzYo4vMwPGqHOwZ78Etjax2ZtNFA9BVs6Fi9znJqyHwzZ3FRsFv3P1DoDTvEAqT6uwJ2z7WCc1B9C7eIvqu2tMTjNrNWHjkG129MMt+tozBJUMO8YGsVTmvyEiwdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v2/bot/message/reply';

// receive json data from line webhook
$raw = file_get_contents('php://input');
$receive = json_decode($raw, true);

// parse received events
$event = $receive['events'][0];
$reply_token  = $event['replyToken'];
$message_text = $event['message']['text'];


// build request headers
$headers = array('Content-Type: application/json',
                 'Authorization: Bearer ' . $access_token);

// build request body
$message = array('type' => 'text',
                 'text' => getenv('KEY'));

$body = json_encode(array('replyToken' => $reply_token,
                          'messages'   => array($message)));


// post json with curl
$options = array(CURLOPT_URL            => $url,
                 CURLOPT_CUSTOMREQUEST  => 'POST',
                 CURLOPT_RETURNTRANSFER => true,
                 CURLOPT_HTTPHEADER     => $headers,
                 CURLOPT_POSTFIELDS     => $body);

$curl = curl_init();
curl_setopt_array($curl, $options);
curl_exec($curl);
curl_close($curl);
