<?php

function foiMordido($number) { return ($number%2==0) ? 1 : 0; }

$i = 0;
for ($i;$i<10;$i++) {
    echo ( foiMordido($i) ) ? "Joãozinho mordeu o seu dedo !\n" : "Joãozinho NÃO mordeu o seu dedo !\n";
}
