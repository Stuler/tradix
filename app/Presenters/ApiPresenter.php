<?php
declare(strict_types=1);

namespace App\Presenters;

use App\Models\DataManager\ContentDataManager;
use App\Models\DataManager\DeviceDataManager;
use App\Models\DataManager\DistributionDataManager;
use App\Models\DataManager\LocationDataManager;
use App\Models\ProcessManager\ContentProcessManager;
use App\Models\ProcessManager\DeviceProcessManager;
use App\Models\ProcessManager\DistributionProcessManager;
use App\Models\ProcessManager\LocationProcessManager;
use Nette\Application\UI\Presenter;

class ApiPresenter extends Presenter {

	public function __construct(
		private readonly LocationProcessManager $locationPM,
		private readonly LocationDataManager    $locationDM,
		private readonly ContentProcessManager  $contentPM,
		private readonly ContentDataManager     $contentDM,
		private readonly DeviceProcessManager   $devicePM,
		private readonly DeviceDataManager      $deviceDM,
		private readonly DistributionProcessManager $distributionPM,
		private readonly DistributionDataManager $distributionDM,
	) {
		parent::__construct();
	}

	/**
	 * TODO: enhance for production
	 */
	protected function getPostBody(): array {
		$data = $this->getRequest()->getPost();
		if (count($data) == 0) {
			$data = json_decode(file_get_contents('php://input'), true);
		}
		if ($data === null) {
			$this->sendJson([
				"code"    => 500,
				"message" => "Nevalidní json struktura.",
				"result"  => [],
			]);
		}
		return $data;
	}

	/**
	 * API default endpoint
	 * method: GET
	 * url: .../api/default
	 */
	public function renderDefault(): void {
		$this->sendJson([
			"code"    => 200,
			"message" => null,
			"result"  => [],
		]);
	}

	/** DEVICE */

	/**
	 * method: POST
	 * url: .../api/add-device
	 * @throws \Exception
	 */
	public function actionAddDevice(): void {
		$post = $this->getPostBody();
		try {
			$this->devicePM->addDevice($post);
		} catch (\Exception $e) {
			$this->sendJson([
				"code"    => 500,
				"message" => $e->getMessage(),
				"result"  => null,
			]);
		}
		$this->sendJson([
			"code"    => 200,
			"message" => null,
			"result"  => null,
		]);
	}

	/**
	 * method: POST
	 * url: .../api/edit-device
	 * @throws \Exception
	 */
	public function actionEditDevice(): void {
		$post = $this->getPostBody();
		try {
			$this->devicePM->editDevice($post);
		} catch (\Exception $e) {
			$this->sendJson([
				"code"    => 500,
				"message" => $e->getMessage(),
				"result"  => null,
			]);
		}
		$this->sendJson([
			"code"    => 200,
			"message" => null,
			"result"  => null,
		]);
	}

	/**
	 * Deletes location by given ID
	 * method GET
	 * url: .../api/delete-device?device_id=10
	 * @throws \Exception
	 */
	public function actionDeleteDevice(): void {
		$id = $this->getParameter('device_id');
		try {
			$this->devicePM->deleteDevice((int)$id);
		} catch (\Exception $e) {
			$this->sendJson([
				"code"    => 500,
				"message" => $e->getMessage(),
				"result"  => null,
			]);
		}
	}

	/**
	 * Returns array of all recorder locations
	 * method GET
	 * url: .../api/get-devices
	 */
	public function renderGetDevices(): void {
		$devices = $this->deviceDM->getDevices();
		$this->sendJson([
			"code"    => 200,
			"message" => null,
			"result"  => $devices,
		]);
	}


	/** LOCATION */

	/**
	 * method: POST
	 * url: .../api/add-location
	 * @throws \Exception
	 */
	public function actionAddLocation(): void {
		$post = $this->getPostBody();
		try {
			$this->locationPM->addLocation($post);
		} catch (\Exception $e) {
			$this->sendJson([
				"code"    => 500,
				"message" => $e->getMessage(),
				"result"  => null,
			]);
		}
		$this->sendJson([
			"code"    => 200,
			"message" => null,
			"result"  => null,
		]);
	}

	/**
	 * method: POST
	 * url: .../api/edit-location
	 * @throws \Exception
	 */
	public function actionEditLocation(): void {
		$post = $this->getPostBody();
		try {
			$this->locationPM->editLocation($post);
		} catch (\Exception $e) {
			$this->sendJson([
				"code"    => 500,
				"message" => $e->getMessage(),
				"result"  => null,
			]);
		}
		$this->sendJson([
			"code"    => 200,
			"message" => null,
			"result"  => null,
		]);
	}

	/**
	 * Deletes location by given ID
	 * method GET
	 * url: .../api/delete-location?location_id=1
	 * @throws \Exception
	 */
	public function renderDeleteLocation(): void {
		$id = $this->getParameter('location_id');
		try {
			$this->locationPM->deleteLocation((int)$id);
		} catch (\Exception $e) {
			$this->sendJson([
				"code"    => 500,
				"message" => $e->getMessage(),
				"result"  => null,
			]);
		}
	}

	/**
	 * Returns array of all recorder locations
	 * method GET
	 * url: .../api/get-locations
	 */
	public function renderGetLocations(): void {
		$locations = $this->locationDM->getLocations();
		$this->sendJson([
			"code"    => 200,
			"message" => null,
			"result"  => $locations,
		]);
	}

	/** CONTENT */

	/**
	 * method: POST
	 * url: .../api/add-content
	 * @throws \Exception
	 */
	public function actionAddContent(): void {
		$post = $this->getPostBody();
		try {
			$this->contentPM->addContent($post);
		} catch (\Exception $e) {
			$this->sendJson([
				"code"    => 500,
				"message" => $e->getMessage(),
				"result"  => null,
			]);
		}
		$this->sendJson([
			"code"    => 200,
			"message" => null,
			"result"  => null,
		]);
	}

	/**
	 * method: POST
	 * url: .../api/edit-content
	 * @throws \Exception
	 */
	public function actionEditContent(): void {
		$post = $this->getPostBody();
		try {
			$this->contentPM->editContent($post);
		} catch (\Exception $e) {
			$this->sendJson([
				"code"    => 500,
				"message" => $e->getMessage(),
				"result"  => null,
			]);
		}
		$this->sendJson([
			"code"    => 200,
			"message" => null,
			"result"  => null,
		]);
	}

	/**
	 * Deletes content by given ID
	 * method GET
	 * url: .../api/delete-content?content_id=2
	 * @throws \Exception
	 */
	public function renderDeleteContent(): void {
		$id = $this->getParameter('content_id');
		try {
			$this->contentPM->deleteContent((int)$id);
		} catch (\Exception $e) {
			$this->sendJson([
				"code"    => 500,
				"message" => $e->getMessage(),
				"result"  => null,
			]);
		}
	}

	/**
	 * Returns array of all recorder locations
	 * method GET
	 * url: .../api/get-content
	 */
	public function renderGetContent(): void {
		$contents = $this->contentDM->getContents();
		$this->sendJson([
			"code"    => 200,
			"message" => null,
			"result"  => $contents,
		]);
	}

	/** DISTRIBUTION */

	/**
	 * method: POST
	 * url: .../api/add-distribution
	 * @throws \Exception
	 */
	public function actionAddDistribution(): void {
		$post = $this->getPostBody();
		try {
			$this->distributionPM->addDistribution($post);
		} catch (\Exception $e) {
			$this->sendJson([
				"code"    => 500,
				"message" => $e->getMessage(),
				"result"  => null,
			]);
		}
		$this->sendJson([
			"code"    => 200,
			"message" => null,
			"result"  => null,
		]);
	}

	/**
	 * method: POST
	 * url: .../api/edit-distribution
	 * @throws \Exception
	 */
	public function actionEditDistribution(): void {
		$post = $this->getPostBody();
		try {
			$this->distributionPM->editDistribution($post);
		} catch (\Exception $e) {
			$this->sendJson([
				"code"    => 500,
				"message" => $e->getMessage(),
				"result"  => null,
			]);
		}
		$this->sendJson([
			"code"    => 200,
			"message" => null,
			"result"  => null,
		]);
	}

	/**
	 * Deletes content by given ID
	 * method GET
	 * url: .../api/delete-distribution?distribution_id=2
	 * @throws \Exception
	 */
	public function renderDeleteDistribution(): void {
		$id = $this->getParameter('distribution_id');
		try {
			$this->distributionPM->deleteDistribution((int)$id);
		} catch (\Exception $e) {
			$this->sendJson([
				"code"    => 500,
				"message" => $e->getMessage(),
				"result"  => null,
			]);
		}
	}

	/**
	 * Returns array of all distributions
	 * method GET
	 * url: .../api/get-all-distributions
	 */
	public function renderGetAllDistributions(): void {
		$distributions = $this->distributionDM->getAllDistributions();
		$this->sendJson([
			"code"    => 200,
			"message" => null,
			"result"  => $distributions,
		]);
	}

	/**
	 * Returns array of distributions for given device at current time
	 * method GET
	 * url: .../api/get-device-distributions?device_id=2
	 * @throws \Exception
	 */
	public function renderGetDeviceDistributions(): void {
		$deviceId = $this->getParameter('device_id');
		try{
		$distributions = $this->distributionDM->getActualDeviceDistributions((int)$deviceId);
		}catch (\Exception $e){
			$this->sendJson([
				"code"    => 500,
				"message" => $e->getMessage(),
				"result"  => [],
			]);
		}
		$this->sendJson([
			"code"    => 200,
			"message" => null,
			"result"  => $distributions,
		]);
	}

}