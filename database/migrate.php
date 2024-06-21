<?php
foreach (glob(__DIR__ . "/migrations/*.php") as $filename) {
    include $filename;
}
?>