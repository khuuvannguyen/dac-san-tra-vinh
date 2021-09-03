<?php
if (isset($data["json"])) {
    $json = json_decode($data["json"], true);
    foreach ($json as $value) {
        echo $value;
    }
} else if (isset($data["string"])) {
    echo $data["string"];
}
