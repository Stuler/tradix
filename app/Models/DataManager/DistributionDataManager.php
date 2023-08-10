<?php
declare(strict_types=1);

namespace App\Models\DataManager;

use App\Models\Repository\Table\DeviceRepository;
use App\Models\Repository\Table\DistributionRepository;
use App\Models\Repository\Table\LocationRepository;

class DistributionDataManager {

	public function __construct(
		private readonly DistributionRepository $distributionRepo,
		private readonly DeviceRepository       $deviceRepo,
	) {
	}

	/*
	 * Return all active current distributions for given device.
	 */
	/**
	 * @throws \Exception
	 */
	public function getActualDeviceDistributions(int $deviceId): array {
		$this->validateDevice($deviceId);
		return $this->distributionRepo->findAllActive()
			->where('device_id', $deviceId)
			->where('date_from <= NOW()')
			->where('date_to >= NOW()')
			->select('distribution.id, content_id, content.label AS content_label, content.filename AS content_filename')
			->fetchAssoc("id");
	}

	/**
	 * @throws \Exception
	 */
	private function validateDevice(int $deviceId): void {
		$device = $this->deviceRepo->fetchById($deviceId);
		if (!$device) {
			throw new \Exception("Device with id {$deviceId} not found.");
		}
	}

	/*
	 * Return all active current distributions grouped by device.
	 */
	public function getAllDistributions(): array {
		return $this->distributionRepo->findAllActive()
			->select('
				distribution.id,
			    device_id,
			    device.label AS device_label,
			    content_id,
			    content.label AS content_label,
			    content.filename AS content_filename')
			->fetchAssoc("[]");
	}
}