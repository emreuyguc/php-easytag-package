<?php
namespace emreuyguc\EasyTag;

abstract class TagBuild extends Tag {

	public static function __callStatic(string $name, array $arguments): string {
		$tag = parent::__callStatic($name, $arguments);

		return $tag->build();
	}

}





	
