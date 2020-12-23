<?php

$porcentagem = 50;

function foiMordido($porcentagem)
{
    return mt_rand(1, 100) <= $porcentagem;
}

for ($i=0; $i < 20; $i++) {
    echo (false !== foiMordido($porcentagem))
    ? "Joãozinho mordeu o seu dedo !\n" : "Joãozinho NÃO mordeu o seu dedo !\n";
}
