<?php

namespace Thumbalizr;

/**
 * Date: 19/03/2015
 * @author Paolo Agostinetto <paul.ago@gmail.com>
 */
class Request {

	/**
	 * @var string
	 */
	protected $url;

	/**
	 * @var int
	 */
	protected $quality;

	/**
	 * @var int
	 */
	protected $width;

	/**
	 * @var string
	 */
	protected $encoding;

	/**
	 * @var string
	 */
	protected $delay;

	/**
	 * @var string
	 */
	protected $mode;

	/**
	 * @var int
	 */
	protected $browserWidth;

	/**
	 * @var int
	 */
	protected $browserHeight;

	/**
	 * @return string
	 */
	public function getUrl() {
		return $this->url;
	}

	/**
	 * @param string $url
	 */
	public function setUrl($url) {
		$this->url = $url;
	}

	/**
	 * @return int
	 */
	public function getQuality() {
		return $this->quality;
	}

	/**
	 * @param int $quality
	 */
	public function setQuality($quality) {
		$this->quality = $quality;
	}

	/**
	 * @return int
	 */
	public function getWidth() {
		return $this->width;
	}

	/**
	 * @param int $width
	 */
	public function setWidth($width) {
		$this->width = $width;
	}

	/**
	 * @return string
	 */
	public function getEncoding() {
		return $this->encoding;
	}

	/**
	 * @param string $encoding
	 */
	public function setEncoding($encoding) {
		$this->encoding = $encoding;
	}

	/**
	 * @return string
	 */
	public function getDelay() {
		return $this->delay;
	}

	/**
	 * @param string $delay
	 */
	public function setDelay($delay) {
		$this->delay = $delay;
	}

	/**
	 * @return string
	 */
	public function getMode() {
		return $this->mode;
	}

	/**
	 * @param string $mode
	 */
	public function setMode($mode) {
		$this->mode = $mode;
	}

	/**
	 * @return int
	 */
	public function getBrowserWidth() {
		return $this->browserWidth;
	}

	/**
	 * @param int $browserWidth
	 */
	public function setBrowserWidth($browserWidth) {
		$this->browserWidth = $browserWidth;
	}

	/**
	 * @return int
	 */
	public function getBrowserHeight() {
		return $this->browserHeight;
	}

	/**
	 * @param int $browserHeight
	 */
	public function setBrowserHeight($browserHeight) {
		$this->browserHeight = $browserHeight;
	}

}
