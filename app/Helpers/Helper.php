<?php
if(! function_exists('pr'))
{
    function pr($data) {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        exit();
    }
}
?>