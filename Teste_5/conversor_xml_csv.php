<?php

function verificaArquivo ($arquivo) {
    if (!file_exists($arquivo)) die("Erro: O arquivo " . $arquivo . " não existe." . "\n");
    if (!is_writable($arquivo)) die("Erro: O arquivo " . $arquivo . " não possui permissão de escrita." . "\n");
}

function conversorXmlCsv($arquivo_xml, $arquivo_csv) {
	
	verificaArquivo($arquivo_xml);
	verificaArquivo($arquivo_csv);
	
	$xml = simplexml_load_file($arquivo_xml);
	$arquivo_convertido = fopen($arquivo_csv, 'w');
	$header = false;
	
	foreach($xml as $key => $value){
		if(!$header) {
			fputcsv($arquivo_convertido, array_keys(get_object_vars($value)));
			$header = true;
		}
		fputcsv($arquivo_convertido, get_object_vars($value));
	}

	fclose($arquivo_convertido);
}

conversorXmlCsv("evento_previdencia_privada.xml", "evento_previdencia_privada.csv");
