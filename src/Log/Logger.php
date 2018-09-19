<?php

namespace iLUB\Plugins\DelUser\Log;

use ILIAS\Filesystem\Stream\Stream;
use ILIAS\Filesystem\Stream\Streams;

/**
 * Class Logger
 *
 * @internal
 */
class Logger {

	/**
	 * @var string
	 */
	protected $path;
	/**
	 * @var Stream
	 */
	protected $stream;


	/**
	 * Logger constructor.
	 *
	 * @param string $path
	 *
	 * @throws \ILIAS\Filesystem\Exception\IOException
	 */
	public function __construct(string $path) {
		global $DIC;

		$this->path = $path;
		if (!$DIC->filesystem()->storage()->has($this->path)) {
			$DIC->filesystem()->storage()->put($this->path, "");
		}

		$resource = fopen(CLIENT_DATA_DIR . '/' . $this->path, 'w');
		$this->stream = Streams::ofResource($resource);
	}


	/**
	 * @param string $string
	 */
	public function write($string) {
		$this->stream->seek($this->stream->getSize());
		$this->stream->write($string);
	}
}