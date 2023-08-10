<?php
declare(strict_types=1);

namespace App\Models\DataManager;

use App\Models\Repository\Table\LocationRepository;

class LocationDataManager {

	public function __construct(
		private readonly LocationRepository $locationRepo,
	) {
	}

	/**
	 * Returns array of all active locations.
	 */
	public function getLocations(): array {
		$locations = $this->locationRepo->findAllActive();
		$result = [];
		/** @var \App\Types\DB\Tables\TDbLocation $location */
		foreach ($locations as $location) {
			$result[] = [
				"id"              => $location->id,
				"label"           => $location->label,
				"description"     => $location->description,
				"gps_coordinates" => $location->gps_coordinates,
			];
		}
		return $result;
	}
}