<?php
if (isset($data["Pages"])) {
    foreach ($data["Pages"] as $page) {
        require_once "Pages/$page.php";
    }
}
