<?php

function returnActiveClass($value1, $value2,$rowCount)
{

    if($value1==null && $rowCount == 1){
        return true;
    }

if($value1 == $value2){
        return true;
}

return false;
}