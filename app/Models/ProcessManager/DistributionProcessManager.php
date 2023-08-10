<?php
declare(strict_types=1);

namespace App\Models\ProcessManager;

use App\Models\Process\DistributionProcess;

class DistributionProcessManager {

	public function __construct(
		private readonly DistributionProcess $distributionProcess,
	) {
	}

	/**
	 * @throws \Exception
	 */
	public function addDistribution(array $post): void {
		$this->distributionProcess->addDistribution($post);
	}

	/**
	 * @throws \Exception
	 */
	public function editDistribution(array $post): void {
		$this->distributionProcess->editDistribution($post);
	}

	/**
	 * @throws \Exception
	 */
	public function deleteDistribution(int $id): void {
		$this->distributionProcess->deleteDistribution($id);
	}

}