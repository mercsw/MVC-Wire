<?php
use Diagnostics as dd;

class HtmlHelpers 
{
	static public function BreakLine()
	{
		return "</br>\n";
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
		
		$htmlString = "<$tag>\n";
		foreach($array as $item)
		{
			$htmlString .= "\t<li>$item</li>\n";
		}
		$htmlString .= "</$tag>\n";
		return $htmlString;
	}
	
	// Takes in an array where the key is an object id and the corresponding value is an Array($urlText, $url)
	static public function ItemUrlList($array, $type, $noLinkTextPrefix = NULL, $noLinkTextPostfix = NULL)
	{
		$tag = self::GetListTypeTag($type);
		
		$htmlString = "<$tag>\n";
		foreach($array as $item)
		{
			$htmlString .= "\t<li>" . $noLinkTextPrefix . self::UrlLink($item[0], $item[1]) . $noLinkTextPostfix . "</li>\n";
		}
		$htmlString .= "</$tag>\n";
		return $htmlString;
	}
	
	static public function FloatingWindow($id, $content)
	{
		return "\n<div id=\"" . $id . "Container\">\n\t<div id=\"$id\">\n$content\n\t</div>\n</div>\n";
	}
	
	static public function BeginHtmlHeader($version = 5)
	{
		return 
"<!DOCTYPE html>
<html lang=\"en\">
<head>
<meta charset=\"utf-8\" />
";		
	}
	static public function EndHtmlHeader()
	{
		return "\n</head>\n";		
	}
	
	static public function Title($title = "No Title Set for this page")
	{
		return "<title>$title</title>\n";
	}
}

