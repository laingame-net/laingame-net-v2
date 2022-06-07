<?php

namespace Ad044\LaingameNetV2\Models;

class Node
{
	public $id;
	public $name;
	public $title;
	public $image_table_indices;
	public $media_file;
	public $protocol_lines;
	public $site;
	public $type;
	public $required_final_video_viewcount;
	public $unlocked_by;
	public $upgrade_requirement;
	public $words;

	public function __construct($node_data)
	{
		$this->id = $node_data["id"];
		$this->name = $node_data["node_name"];
		$this->title = $node_data["title"];
		$this->image_table_indices = $node_data["image_table_indices"];
		$this->media_file = $node_data["media_file"];
		$this->protocol_lines = $node_data["protocol_lines"];
		$this->site = $node_data["site"];
		$this->type = $node_data["type"];
		$this->required_final_video_viewcount = $node_data["required_final_video_viewcount"];
		$this->unlocked_by = $node_data["unlocked_by"];
		$this->upgrade_requirement = $node_data["upgrade_requirement"];
		$this->words = $node_data["words"];
	}

	public function get_first_letter()
	{
		return substr($this->name, 0, 1);
	}

	public function get_letters_after_first()
	{
		return substr($this->name, 1);
	}

	public function get_level()
	{
		return substr($this->id, 0, 2);
	}

	public function get_number()
	{
		return substr($this->id, 2, 4);
	}
}
