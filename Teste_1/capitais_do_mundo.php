<?php

$location = [
	"Itália" => "Roma",
	"Romênia" => "Bucareste",
	"Bélgica" => "Bruxelas",
	"Finlândia" => "Helsinki",
	"França" => "Paris",
	"Alemanha" => "Berlim",
	"Grécia" => "Atenas",
	"Irlanda" => "Dublin",
	"Holanda" => "Amsterdã",
	"Espanha" => "Madri"
];

asort($location);

foreach($location as $country => $capital)
{
    echo "A capital da " . $country . " é " . $capital . "\n";
}
