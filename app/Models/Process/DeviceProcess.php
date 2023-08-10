<?php
declare(strict_types=1);

namespace App\Models\Process;

use App\Models\Repository\Table\DeviceRepository;
use App\Models\Repository\Table\LocationRepository;
use App\Types\DB\Tables\TDbDevice;
use Nette\Utils\Random;

class DeviceProcess {

	public function __construct(
		private readonly DeviceRepository   $deviceRepo,
		private readonly LocationRepository $locationRepo,
	) {
	}

	/**
	 * @throws \Exception
	 */
	public function addDevice(array $post): void {
		$this->validateDuplicities($post);
		$saveValues = new TDbDevice();
		$saveValues->label = $post['label'];
		$saveValues->description = $post['description'];
		$saveValues->ip_address = $post['ip_address'];
		$saveValues->uuid = $post['uuid'];
		$saveValues->api_key = Random::generate(32);
		$saveValues->location_id = $post['location_id'];
		$this->deviceRepo->save($saveValues);
	}

	/**
	 * @throws \Exception
	 */
	private function validateDuplicities(array $post): void {
		if (isset($post['id'])) {
			$device = $this->deviceRepo->fetchById($post['id']);
			if ($device->id == $post['id']) {
				return;
			}
		}
		$devices = $this->deviceRepo->findAllActive()
			->select("id, uuid, api_key, ip_address")
			->fetchAssoc("id");
		$uuids = array_column($devices, "uuid");
		$apiKeys = array_column($devices, "api_key");
		$ipAddresses = array_column($devices, "ip_address");
		if (in_array($post['uuid'], $uuids)) {
			throw new \Exception("Device with given UUID already exists.");
		}
		if (in_array($post['api_key'], $apiKeys)) {
			throw new \Exception("Device with given API key already exists.");
		}
		if (in_array($post['ip_address'], $ipAddresses)) {
			throw new \Exception("Device with given IP address already exists.");
		}
		$this->validateLocation($post);
	}

	/**
	 * @throws \Exception
	 */
	private function validateLocation(array $post): void {
		$location = $this->locationRepo->fetchById($post['location_id']);
		if (!$location) {
			throw new \Exception("Location with id {$post['location_id']} not found.");
		}
	}

	/**
	 * @throws \Exception
	 */
	public function editDevice(array $post): void {
		$device = $this->deviceRepo->fetchById($post['id']);
		if (!$device) {
			throw new \Exception("Device with id {$post['id']} not found.");
		}
		$this->validateDuplicities($post);
		$values = new TDbDevice();
		$values->id = $post['id'];
		$values->label = $post['label'];
		$values->description = $post['description'];
		$values->ip_address = $post['ip_address'];
		$values->uuid = $post['uuid'];
		$values->api_key = $post['api_key'];
		$values->location_id = $post['location_id'];
		$this->deviceRepo->save($values);
	}

	/**
	 * @throws \Exception
	 */
	public function deleteDevice(int $id): void {
		$device = $this->deviceRepo->fetchById($id);
		if (!$device) {
			throw new \Exception("Device with id {$id} not found.");
		}
		$this->deviceRepo->delete($device->id);
	}

}