<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 11/04/2016
 * @Time    : 08:56
 * @File    : CSVParser.php
 * @Version : 1.0
 * @LastUpdate  : 11/04/2016 à 08:56
 */
namespace Core\CSVParser;

class CSVParser {

	private $file_name;
	private $fp;
	private $parse_header;
	private $header;
	private $delimiter;
	private $length;

	public function __construct($file_name, $parse_header = false, $delimiter = ";", $length = 8000) {

		$this->fp = @fopen('../app/__tmp/' . $file_name, "r");
		if (!$this->fp) {
			exit;
		}
		$this->file_name = $file_name;
		$this->parse_header = $parse_header;
		$this->delimiter = $delimiter;
		$this->length = $length;

		if ($this->parse_header) {
			$this->convertToUTF8();
			$this->header = fgetcsv($this->fp, $this->length, $this->delimiter);
		}
	}

	public function __destruct() {
		if (!$this->fp) {
			return trigger_error("Le fichier (\"/app/__tmp/ . $this->file_name\") n'existe pas...", E_USER_ERROR);
		} else {
			fclose($this->fp);
			return unlink(ROOT . "/app/__tmp/" . $this->file_name);
		}
	}

	private function convertToUTF8() {
		if (!file_exists(ROOT . '/app/__tmp/' . $this->file_name)) {return false;}
		$contents = file_get_contents(ROOT . '/app/__tmp/' . $this->file_name);
		if (mb_check_encoding($contents, 'UTF-8')) {return false;}
		file_put_contents(ROOT . '/app/__tmp/' . $this->file_name, html_entity_decode(utf8_encode($contents), ENT_NOQUOTES, 'UTF-8'));
		return true;
	}

	public function get($max_lines = 0) {

		$data = array();

		if ($max_lines > 0) {
			$line_count = 0;
		} else {
			$line_count = -1;
		}

		while ($line_count < $max_lines && ($row = fgetcsv($this->fp, $this->length, $this->delimiter)) !== FALSE) {
			if ($this->parse_header) {
				foreach ($this->header as $i => $heading_i) {
					$row_new[$heading_i] = $row[$i];
				}
				$data[] = $row_new;
			} else {
				$data[] = $row;
			}

			if ($max_lines > 0) {
				$line_count++;
			}

		}
		return $data;
	}

}