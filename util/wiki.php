<?php 
	//A really quick and pretty bad method for getting article text from Wikipedia
	//Really should be fixed in the future...
	
	function textOfArticle($name, $legnth) {
		$matches = null;
		$wikipedia = file_get_contents("https://en.wikipedia.org/wiki/" . str_replace(" ", "_", $name));
		$wikipedia = str_replace("\n", "", $wikipedia);
		$wikipedia = str_replace("\r", "", $wikipedia);
		$wikipedia = preg_replace("/infobox hproduct.*?<\/table>/", "", $wikipedia);
		$wikipedia = preg_replace("/\\[.*?\\]/", "", $wikipedia);
		$wikipedia = preg_match("/<\/p>.*<\/p>/", $wikipedia, $matches);
		$wikipedia = preg_replace("/<[^>]+>/", "", $matches[0]);
		
		return substr($wikipedia, 0, $legnth);
	}
?>