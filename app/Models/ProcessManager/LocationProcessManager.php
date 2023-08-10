<?php
declare(strict_types=1);

namespace App\Models\ProcessManager;

use App\Models\Process\LocationProcess;

class LocationProcessManager {

	public function __construct(
		private readonly LocationProcess $locationProcess,
	) {
	}

	/**
	 * @throws \Exception
	 */
	public function addLocation(array $data): void {
		$this->locationProcess->addLocation($data);
	}

	/**
	 * @throws \Exception
	 */
	public function editLocation(array $post): void {
		$this->locationProcess->editLocation($post);
	}

	/**
	 * @throws \Exception
	 */
	public function deleteLocation(int $id): void {
		$this->locationProcess->deleteLocation($id);
	}

}