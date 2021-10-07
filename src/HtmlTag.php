<?php
namespace emreuyguc\EasyTag;


abstract class HtmlTag extends Tag {
	const selfClosingTags = [
		'area',
		'base',
		'br',
		'col',
		'embed',
		'hr',
		'img',
		'input',
		'link',
		'meta',
		'param',
		'source',
		'track'
	];

	public static function __callStatic($name, $arguments): string {
		$tag = parent::__callStatic($name, $arguments);
		if (in_array($name, self::selfClosingTags)) {
			$tag->setSelfClosing();
		}
		return $tag->build();
	}


}

