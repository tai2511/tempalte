<?php
// Kết nối tới Redis server
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

// Lưu dữ liệu vào Redis
$redis->set("key", "value");

// Truy xuất dữ liệu từ Redis
$value = $redis->get("key");
echo $value;
?>