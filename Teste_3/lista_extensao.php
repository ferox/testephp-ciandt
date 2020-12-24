<?php

$arquivos = glob("arquivos/*.*");

for ($i=0; $i<count($arquivos); $i++) {
    $extensao = pathinfo($arquivos[$i], PATHINFO_EXTENSION);
    $ext[] = $extensao;
}

asort($ext);

foreach ($ext as $e) {
    echo '.' . $e . "\n";
}
