<?php

$st1 = ($stat == '1') ? 'Active' : 'Inactive';
$st2 = ($stat == '1') ? 'Deactivate' : 'Activate';


if ($btn == 1) {
    echo '<button style="background-color:beige; padding:5px;" class="save-data"  data-id="{{$id}}" stat-id="{{$stat}}">' . $st2 . '</button>';
} else {
    echo $st1;
}