<?php
namespace emreuyguc\EasyTag;

abstract class TagBuild extends Tag{

	public static function __callStatic( $name, $arguments): String {
		$tag = parent::__callStatic($name,$arguments);
		return $tag->build();
	}

}





	
