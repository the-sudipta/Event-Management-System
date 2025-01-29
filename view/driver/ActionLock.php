<?php


function lock_decider($data){

    $lock_class = '';
    if ($data !== "Pending") {
        $lock_class = 'locked-row';
    }

    return $lock_class;

}