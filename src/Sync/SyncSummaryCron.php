<?php

namespace iLUB\Plugins\TestCron\Sync;

/**
 * Class SyncSummaryCron
 *
 * @package iLUB\Plugins\TestCron\Sync
 */
class SyncSummaryCron {

	/**
	 * @inheritDoc
	 */
	public function getOutputAsString() {
		$return = "";
		foreach ($this->syncs as $sync) {
			$return .= $this->renderOneSync($sync) . "\n\n";
		}

		return $return;
	}


	/**
	 * @param IOriginSync $originSync
	 *
	 * @return string
	 */
	private function renderOneSync(IOriginSync $originSync) {
		// TODO: create nice summary message

        $msg = "message";

		return $msg;
	}
}
