<?php

include_once(dirname(__FILE__).'/../MQTTClient.php');

use karpy47\PhpMqttClient\MQTTClient;

$cid = mt_rand(1, 65535);
$topic = 'samples';
$prefix = 'Message number ';
$j = 0;
$client = new MQTTClient('localhost', 1883);
$client->setAuthentication('mqtt-server.username','mqtt-server.password');
$success = $client->sendConnect($cid);  // set your client ID
if ($success) {
  // Send ten messages, QoS:1
  do {
    $ack = $client->sendPublish($topic, $prefix . $j++, $client::MQTT_QOS1);
  } while ($ack === true && $j <= 10);
  $client->sendDisconnect();
}
$client->close();
