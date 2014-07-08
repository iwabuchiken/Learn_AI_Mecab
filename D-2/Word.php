<?php

class Word {
	
	private $surface;	// スーダン
	private $feature;	// 名詞,固有名詞,地域,国,*,*,スーダン,スーダン,スーダン
	private $ps1;		// parts of speech	// 名詞
	private $ps2;		// parts of speech	// 固有名詞, サ変接続
	private $ps3;		// parts of speech	// ,助数詞, 地域
	
	private $yomi;
	
	function __construct() {
		
		$this->yomi = array_fill(0, 3, "");
		
	}
	
	public function get_Feature() {
		
		return $this->feature;
		
	}
	
	public function set_Feature($feature) {
		
		$this->feature = $feature;
		
	}

	public function get_Surface() {
	
		return $this->surface;
	
	}
	
	public function set_Surface($surface) {
	
		$this->surface = $surface;
	
	}
	
	public function get_PS1() {
	
		return $this->ps1;
	
	}
	
	public function set_PS1($ps1) {
	
		$this->ps1 = $ps1;
	
	}
	
	public function get_PS2() {
	
		return $this->ps2;
	
	}
	
	public function set_PS2($ps2) {
	
		$this->ps2 = $ps2;
	
	}
	
	public function get_PS3() {
	
		return $this->ps3;
	
	}
	
	public function set_PS3($ps3) {
	
		$this->ps3 = $ps3;
	
	}
	
	public function get_Yomi() {
	
		return $this->yomi;
	
	}
	
	public function set_Yomi($yomi) {
	
		$this->yomi = $yomi;
	
	}
	
}

/*
 * Steps => getter/setter
 * 		1. duplicate a set of getter/setter
 * 		2. Find/replace
 * 		3. done
 */