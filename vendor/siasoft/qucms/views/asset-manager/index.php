<?php
foreach ($assets as $value) {
    echo $value['class'] . ' => ' . $value['parent'] . $value['path'] . '<br />';
}