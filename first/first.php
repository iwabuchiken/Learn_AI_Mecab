<?php
	echo "hi";
	echo "<br>";
	
	$text = "私は走りながら考えるエンジニアです。";
// 	$exe_path = 'C:\WORKS\Programs\MeCab_0996_UTF-8\bin\mecab.exe';
	$exe_path = 'C:\WORKS\Programs\MeCab_0996_SJIS\bin\mecab.exe';
// 	$exe_path = 'C:/"Program Files"/MeCab/bin/mecab.exe';
	$descriptorspec = array(
			0 => array("pipe", "r")
			, 1 => array("pipe", "w")
	);
	$process = proc_open($exe_path, $descriptorspec, $pipes);
	if (is_resource($process)) {
		fwrite($pipes[0], $text);
		fclose($pipes[0]);
		$result = stream_get_contents($pipes[1]);
		fclose($pipes[1]);
		proc_close($process);
	}
	echo "<pre>";
	print_r($result);
	echo "</pre>";