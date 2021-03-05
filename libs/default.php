<?php
function format_cost($cost=0) {
    $ans = ceil($cost);
    if($ans >= 1000) {
        $ans = number_format($cost, 0, '.', ' ');
    }
    $ans .=' $';  // рубль плохо отображается даже у меня, заменил на $
    return $ans;
}

