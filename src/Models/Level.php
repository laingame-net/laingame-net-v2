<?php

namespace Ad044\LaingameNetV2\Models;

class Level
{
	public $nodes = array();
	public $number;

	public function __construct($number, $nodes)
	{
		$this->number = $number;
		foreach (range(0, 24) as $node_id) {
			$level_key = sprintf('%02d', $number) . sprintf('%02d', $node_id);
			if (array_key_exists($level_key, $nodes)) {
				$this->nodes[$level_key] = new Node($nodes[$level_key]);
			} else {
				$this->nodes[$level_key] = null;
			}
		}
	}

	public function get_first_row()
	{
		return array_slice($this->nodes, 0, 8);
	}

	public function get_second_row()
	{
		return array_slice($this->nodes, 8, 8);
	}

	public function get_third_row()
	{
		return array_slice($this->nodes, 16, 8);
	}
}
