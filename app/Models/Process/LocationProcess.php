<?php
declare(strict_types=1);

namespace App\Models\Process;

use App\Models\Repository\Table\LocationRepository;
use App\Types\DB\Tables\TDbLocation;

class LocationProcess {

	public function __construct(
		private readonly LocationRepository $locationRepo,
	) {
	}

	/**
	 * @throws \Exception
	 */
	public function addLocation(array $data): void {
		$this->validateDuplicity($data);
		$saveValues = new TDbLocation();
		$saveValues->label = $data['label'];
		$saveValues->description = $data['description'];
		$saveValues->gps_coordinates = $data['gps_coordinates'];
		$this->locationRepo->save($saveValues);
	}

	/**
	 * @throws \Exception
	 */
	public function editLocation(array $post): void {
		$location = $this->locationRepo->fetchById($post['id']);
		if (!$location) {
			throw new \Exception("Location with id {$post['id']} not found.");
		}
		$this->validateDuplicity($post);
		$values = new TDbLocation();
		$values->id = $post['id'];
		$values->label = $post['label'];
		$values->description = $post['description'];
		$values->gps_coordinates = $post['gps_coordinates'];
		$this->locationRepo->save($values);
	}

	/**
	 * Validates duplicity of location label.
	 * If user wants to add new location, it checks if location with same label already exists.
	 * If user wants to edit location, it checks if location with same label already exists and if it is not the same location.
	 * @throws \Exception
	 */
	private function validateDuplicity(array $data): void {
		$location = $this->locationRepo->fetchByLabel($data['label']);
		if (isset($data['id']) && $location->id == $data['id']) {
			return;
		}
		if ($location) {
			throw new \Exception("Location with label {$data['label']} already exists.");
		}
	}

	/**
	 * @throws \Exception
	 */
	public function deleteLocation(int $id): void {
		$location = $this->locationRepo->fetchById($id);
		if (!$location) {
			throw new \Exception("Location with id {$id} not found.");
		}
		$this->locationRepo->delete($location->id);
	}

}