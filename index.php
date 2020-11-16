<?php
    // MAKING STRREV WORK WITH UTF-8
    function utf8_strrev($str) {
        preg_match_all('/./us', $str, $ar);
        return join('', array_reverse($ar[0]));
    }

    // MAKING UCFIRST WORK WITH UTF-8
    function utf8_ucfirst($str, $encoding='UTF-8')
	{
		$str = mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding).
			   mb_substr($str, 1, mb_strlen($str), $encoding);
		return $str;
	}

    // SENDING PUNCTUATION TO THE END OF THE WORD
    function isSymbol($word) {
        $pattern = "|[,.:;!]+|";
        if (preg_match($pattern, $word)) {
            $temp = $word[0];
            $word = mb_substr($word, 1);
            $word .= $temp;
            return $word;
        }
        else {
            return $word;
        }
    }

    // FIRST LETTER UPPER-ING
    function upperCaseCheck($word) {
        $pattern = "/[А-Я]/u";
        if (preg_match($pattern, $word)) {
            $word = mb_strtolower($word);
            $word = utf8_ucfirst($word);
        }
        return $word;
    }

    // WORD-REVERSING FUNC
    function revertCharacters($string, $encoding = null) {
        $words = explode(' ',$string);

        //print_r($words);
        
        foreach ($words as &$value) {
            $value = utf8_strrev($value);
            $value = isSymbol($value);
            $value = upperCaseCheck($value);
        }

        $string = join(' ',$words);
        return $string;
    }   

    mb_internal_encoding("UTF-8");
    $result = revertCharacters("Привет! Давно не виделись.");
    echo $result;
?>