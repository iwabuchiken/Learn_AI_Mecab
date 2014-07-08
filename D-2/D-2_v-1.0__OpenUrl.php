<?php

	require_once 'Word.php';
	
	function get_URL($url, $params) {
		
// 		$sentence = "南スーダンの国連平和維持活動（ＰＫＯ）に派遣された陸上自衛隊第５次派遣施設隊長";
		
		$html = file_get_contents("$url?$params");
		
		//REF http://stackoverflow.com/questions/819182/how-do-i-get-the-html-code-of-a-web-page-in-php answered May 4 '09 at 8:02
// 		$html = file_get_contents('http://chasen.org/~taku/software/mecapi/mecapi.cgi');
// 		$html = file_get_contents(
// 				"http://chasen.org/~taku/software/mecapi/mecapi.cgi?sentence=$sentence");
		
		//REF substr http://us2.php.net//manual/en/function.substr.php
// 		echo "Content => ".substr($html, 0, 100);
		
		return $html;
		
		//REF get_class http://www.php.net//manual/en/function.get-class.php
// 		echo "Class is => ".get_class($html);
		
	}

	function initial() {
		
		$text = "私は走りながら考えるエンジニアです。";
		$exe_path = 'C:\WORKS\Programs\MeCab_0996_UTF-8\bin\mecab.exe';
		// 	$exe_path = 'C:\WORKS\Programs\MeCab_0996_SJIS\bin\mecab.exe';
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
		
	}
	
	function parse_XML($string) {
		
// 		$xml = new SimpleXMLElement($string);
		
		$xml = simplexml_load_string($string);
		
		echo "\$xml->count() => ".$xml->count();
		
		echo "<br>";
		
// 		echo "word= >".$xml->word;
		
// 		echo "<br>";
		
// 		echo "MecabResult= >".$xml->MecabResult;
		
// 		echo "<br>";
		
// 		echo "children()= >".$xml->children();
		
// 		print_r($xml);
// 		print_r($xml->word->surface);
		print_r($xml->word->surface->__toString());
		
		echo "<br>";
		echo "<br>";
		
		echo get_class($xml->word->surface);
// 		echo get_class($xml);
		
// 		$word = $xml->MecabResult->word->surface;
		
// 		echo "word => $word";
		echo "<br>";		
		echo "<br>";
		
		print_r($xml);
		
	}
	
	function 
	parse_XML_2($string) {
		
		$xml = simplexml_load_string($string);

		$children = $xml->children();
		
// 		if ($children != null) {
// 			echo "\$children->count()".$children->count();
// 		}
		
// 		echo "<br>";
// 		echo "<br>";
		
		/******************************
		
			get: word list
		
		******************************/
		$word_List = _parse_XML_2__Get_WordList($children);
		
		/******************************
		
			show: list
		
		******************************/
		_parse_XML_2__Show_WordList($word_List);
		
	}//parse_XML_2($string)

	function 
	_parse_XML_2__Show_WordList($word_List) {
		
// 		echo "!!!!"."<br>";
		echo "<table border='1'>";
		for ($i = 0; $i < count($word_List); $i++) {
			
			echo "<tr>";
			
				if ($word_List[$i]->get_PS1() == "名詞") {
					
					echo "<td>";
						echo $word_List[$i]->get_Surface();
					echo "</td>";
						
					echo "<td>";
						echo $word_List[$i]->get_Feature();
					echo "</td>";
						
					echo "<td>";
						echo $word_List[$i]->get_PS1()
								."/"
								.$word_List[$i]->get_PS2()
								."/"
								.$word_List[$i]->get_PS3()
								;
					echo "</td>";
						
					echo "<td>";
						echo $word_List[$i]->get_Yomi()[0]
							."/"
							.$word_List[$i]->get_Yomi()[1]
							."/"
							.$word_List[$i]->get_Yomi()[2]
							;
					echo "</td>";
						
				}
			echo "</tr>";
				
		}
				
		echo "</table>";
						
// 					if ($word_List[$i]->get_PS1() == "名詞") {
						
// 						echo "<td>";
// 						echo $word_List[$i]->get_Surface()
// 								." / "
// 								.$word_List[$i]->get_Feature()
// 								."("
// 								.$word_List[$i]->get_PS1()
// 								." / "
// 								.$word_List[$i]->get_PS2()
// 								.")"
// 								." Yomi="
// 								.$word_List[$i]->get_Yomi()[0]
// 		// 						.get_class($word_List[$i]->get_Yomi())
// 		// 						.get_class($word_List[$i]->get_Yomi)
// 								;
															
// 						echo "<br>";
// 						echo "<br>";
														
// 					}
				
// 		echo "<br>";
// 		echo "<br>";
		
// 		print_r($xml);
		
	}//_parse_XML_2__Show_WordList($word_List)
	
	function 
	_parse_XML_2__Get_WordList($children) {

		$word_List = array();
		
		foreach ($children as $child):
		
		$word_tmp = new Word();
			
		$word_tmp->set_Surface($child->surface->__toString());
		$word_tmp->set_Feature($child->feature->__toString());
			
		$feature = explode(",", $child->feature->__toString());
			
		$word_tmp->set_PS1($feature[0]);
		$word_tmp->set_PS2($feature[1]);
		$word_tmp->set_PS3($feature[2]);
			
		// Yomi
		$array_len = count($feature);
		
		$yomi = array_fill(0, 3, "");
		
		$yomi[0] = $feature[$array_len - 3];
		$yomi[1] = $feature[$array_len - 2];
		$yomi[2] = $feature[$array_len - 1];
		
		$word_tmp->set_Yomi($yomi);
// 		$word_tmp->get_Yomi()[0] = $feature[$array_len - 1];
// 		$word_tmp->get_Yomi()[0] = $feature[$array_len - 1];
// 		$word_tmp->get_Yomi()[0] = $feature[$array_len - 1];
		
		// Push
		array_push($word_List, $word_tmp);
		// 			print_r($child->surface->__toString());
			
		// 			echo "<br>";
		// 			echo "<br>";
		
		endforeach;
		unset($child);
		
		return $word_List;
		
	}//_parse_XML_2__Get_WordList($children)
	
	function execute() {

		/******************************
		
		Open url
		
		******************************/
		$text = "台湾・台北（Taipei）にある日本の対台湾窓口機関、交流協会台北事務所前で7日、台湾労働党や中台統一派団体のメンバーら数十人が、安倍政権の集団的自衛権行使の容認など平和憲法に反する動きに対し抗議活動を行った";
// 		$text = "南スーダンの国連平和維持活動（ＰＫＯ）に派遣された陸上自衛隊第５次派遣施設隊長";
		$params = "sentence=$text";
		
		$url = "http://chasen.org/~taku/software/mecapi/mecapi.cgi";
		
		$string = get_URL($url, $params);
		
// 		echo $string;
		
		/******************************
		
		show words
		
		******************************/
		echo "<br>";
		echo "<br>";
		
		parse_XML_2($string);
// 		parse_XML($string);
		
		echo "<br>";
		echo "<br>";
		
		echo "done";
		
	}
	
	execute();
	
// 	initial();
	
// 	echo "<br>";
// 	echo "<br>";
	
	