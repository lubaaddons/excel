<?php

namespace Luba;

use Luba\Framework\UploadedFile;

class Excel
{
	protected $excel;

	public function __construct($document = NULL)
	{
		if ($document)
			$this->excel = \PHPExcel_IOFactory::load($document);
		else
			$this->excel = new \PHPExcel;
	}

	public static function create()
	{
		return new self();
	}

	public static function load($file)
	{
		if ($file instanceof UploadedFile)
		{
			$filename = str_random('10');
			$file->move(storage_path("temp"));
			$path = $file->path();
		}
		else
			$path = $file;

		return new self($path);
	}

	public function toArray()
	{
		return $this->excel->getActiveSheet()->toArray();
	}
}