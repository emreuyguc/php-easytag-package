<?php
namespace emreuyguc\EasyTag;

class Tag {
	public $name;
	public $attrs = [];
	public $output = '';
	public $selfClosing = FALSE;
	public $elements = [];

	public function setElements(array $elements): Tag {
		$this->elements = $elements;

		return $this;
	}

	public function prependElement($element): Tag {
		array_unshift($this->elements, $element);

		return $this;
	}

	public function appendElement($element): Tag {
		$this->elements[] = $element;

		return $this;
	}


	//todo add attrs
	public function __construct(string $name) {
		$this->setName($name);
	}

	public function setName(string $name): Tag {
		$this->name = $name;

		return $this;
	}

	public function setAttrs(array $attrs): Tag {
		$this->attrs = $attrs;

		return $this;
	}

	public function addAttr(string $attr, string $value): Tag {
		if ($value) {
			$this->attrs[$attr] = $value;
		}

		return $this;
	}

	public function removeAttr(string $attr): Tag {
		unset($this->attrs[$attr]);

		return $this;
	}


	public function setSelfClosing(bool $isPaired = TRUE): Tag {
		$this->selfClosing = $isPaired;

		return $this;
	}

	private function _generateBeautifyTabs(int $index_sub): string {
		$tabs = '';
		for ($i = 0; $i < $index_sub; $i++) {
			$tabs .= "\t";
		}

		return $tabs;
	}

	private function _renderEndLines(string $tabs) {

	}

	private function _generateTag(int $index_sub = 0): string {

		$tabs = $this->_generateBeautifyTabs($index_sub);

$in = false;
		$output = ($index_sub > 0 ? "\n" . $tabs : NULL)."<$this->name" .$this->_renderAttributes().  ">" .
			implode(
				'',
				array_map(
					function ($element) use ($index_sub,&$in) {
						if (is_string($element)) {
							 $my='';
							$tab = $this->_generateBeautifyTabs($index_sub + 1);
							if(substr($element,0,1) == '<'){
								$my = "\n".$tab;
								$in = true;
							}
							return implode('',array_map(function($line) use ($my){
								return $my.$line;
							},explode("\n",$element)));
						}
						$in = TRUE;

						return $element->_generateTag(
							$index_sub + 1
						);
					},
					$this->elements
				)
			)//sonunda \n ve tabs içindekine göre
			//1.icinde herhangi tab obje var ise
			//icindeki text elemanında < geçiyorsa
			.($in ? "\n".$tabs : '')
			."</$this->name>";


		return $output;
	}

	private function _renderAttributes(): string {
		if (!count($this->attrs)) {
			return '';
		}

		return ' ' . implode(
				' ',
				array_map(
					function ($attr, $key) {
						return $key . '="' . $attr . '"';
					},
					$this->attrs,
					array_keys($this->attrs)
				)
			);
	}

	public function render(): void {
		echo $this->build();
	}

	public function build(): string {
		$this->output = $this->_generateTag();

		return $this->output;
	}

	public static function __callStatic(string $name,array $arguments) {
		$tag = new Tag($name);

		return $tag->setElements(
			count($arguments) > 1 ? (array_map(
				function ($element) {
					return is_array($element) ? implode('', $element) : $element;
				},
				array_slice($arguments, (is_array($arguments[0]) && self::_isAssoc($arguments[0]) ? 1 : 0), count($arguments), FALSE)
			)) : (isset($arguments[0]) ? (is_array($arguments[0]) ? (!self::_isAssoc($arguments[0]) ? $arguments[0] : []) : (is_string(
				$arguments[0]
			) || $arguments[0] instanceof Tag ? [$arguments[0]] : [])) : [])
		)
				   ->setAttrs(
					   count($arguments) > 1 ? (is_array($arguments[0]) ? (self::_isAssoc($arguments[0]) ? $arguments[0] : []) : []) : (isset($arguments[0]) ? ((is_array(
							   $arguments[0]
						   ) && self::_isAssoc($arguments[0])) ? $arguments[0] : []) : [])
				   );
	}

	private static function _isAssoc(array $arr): bool {
		if (array() === $arr)
			return FALSE;

		return array_keys($arr) !== range(0, count($arr) - 1);
	}


}

