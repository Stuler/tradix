<?php
declare(strict_types=1);

namespace App\Models\DataManager;

use App\Models\Repository\Table\DeviceRepository;

class DeviceDataManager {

	public function __construct(
		private readonly DeviceRepository $deviceRepo,
	) {
	}

	/**
	 * Returns array of all active content.
	 */
	public function getDevices(): array {
		$devices = $this->deviceRepo->findAllActive();
		$result = [];
		/** @var \App\Types\DB\Tables\TDbDevice $device */
		foreach ($devices as $device) {
			$result[] = [
				"id"          => $device->id,
				"label"       => $device->label,
				"description" => $device->description,
				"ip_address"  => $device->ip_address,
				"uuid"        => $device->uuid,
				"api_key"     => $device->api_key,
				"location_id" => $device->location_id,
			];
		}
		return $result;
	}
}