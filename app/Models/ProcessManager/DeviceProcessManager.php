<?php
declare(strict_types=1);

namespace App\Models\ProcessManager;

use App\Models\Process\DeviceProcess;

class DeviceProcessManager {

	public function __construct(
		private readonly DeviceProcess $deviceProcess,
	) {
	}

	/**
	 * @throws \Exception
	 */
	public function addDevice(array $post): void {
		$this->deviceProcess->addDevice($post);
	}

	/**
	 * @throws \Exception
	 */
	public function editDevice(array $post): void {
		$this->deviceProcess->editDevice($post);
	}

	/**
	 * @throws \Exception
	 */
	public function deleteDevice(int $param): void {
		$this->deviceProcess->deleteDevice($param);
	}

}