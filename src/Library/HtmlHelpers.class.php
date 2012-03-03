<?php

class HtmlHelpers 
{
	static public function BreakLine()
	{
		return "</br>";
	}
	
	static public function UrlLink($text, $href)
	{
		return "<a href=\"$href\">$text</a>";
	}

	static protected function GetListTypeTag($type)
	{
		$tag = "";
		switch($type)
		{
			case HtmlHelpers::OrderedType:
				$tag = "ol";
				break;
			case HtmlHelpers::UnorderedType:
				$tag = "ul";
				break;
			default:
				throw new SystemException("Unsupported ItemList type");
				break;
		}
		return $tag;
	}

	// Type of list
	const OrderedType = 1;
	const UnorderedType = 2;	
	static public function ItemList($array, $type)
	{
		$tag = self::GetListTypeTag($type);
		
		$htmlString = "<$tag>";
		foreach($array as $item)
		{
			$htmlString .= "<li>$item</li>";
		}
		$htmlString .= "</$tag>";
		return $htmlString;
	}
	
	// Takes in an array where the key is an object id and the corresponding value is an Array($urlText, $url)
	static public function ItemUrlList($array, $type, $noLinkTextPrefix = NULL, $noLinkTextPostfix = NULL)
	{
		$tag = self::GetListTypeTag($type);
		
		$htmlString = "<$tag>";
		foreach($array as $item)
		{
			$htmlString .= "<li>" . $noLinkTextPrefix . self::UrlLink($item[0], $item[1]) . $noLinkTextPostfix . "</li>";
		}
		$htmlString .= "</$tag>";
		return $htmlString;
	}
}

