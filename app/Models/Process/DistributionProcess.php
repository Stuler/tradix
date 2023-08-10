<?php
declare(strict_types=1);

namespace App\Models\Process;

use App\Models\Repository\Table\ContentRepository;
use App\Models\Repository\Table\DeviceRepository;
use App\Models\Repository\Table\DistributionRepository;
use App\Types\DB\Tables\TDbDistribution;

class DistributionProcess {

	public function __construct(
		private readonly DistributionRepository $distributionRepo,
		private readonly ContentRepository      $contentRepo,
		private readonly DeviceRepository       $deviceRepo,
	) {
	}

	/**
	 * @throws \Exception
	 */
	public function addDistribution(array $post): void {
		$this->validate($post);
		$saveValues = new TDbDistribution();
		$saveValues->content_id = $post['content_id'];
		$saveValues->device_id = $post['device_id'];
		$saveValues->date_from = $post['date_from'];
		$saveValues->date_to = $post['date_to'];
		$this->distributionRepo->save($saveValues);
	}

	/**
	 * Validates whether given content and device exists.
	 * Validates whether given device is not already broadcasting given content in given time.
	 * @throws \Exception
	 */
	private function validate(array $post): void {
		$contents = $this->contentRepo->findAllActive()->fetchPairs('id');
		$devices = $this->deviceRepo->findAllActive()->fetchPairs('id');
		if (!isset($contents[$post['content_id']])) {
			throw new \Exception("Content with id {$post['content_id']} not found.");
		}
		if (!isset($devices[$post['device_id']])) {
			throw new \Exception("Device with id {$post['device_id']} not found.");
		}
		if (isset($post['id'])) {
			$distribution = $this->distributionRepo->fetchById($post['id']);
			if (!$distribution) {
				throw new \Exception("Distribution with id {$post['id']} not found.");
			}
			if ($distribution->device_id == $post['device_id'] && $distribution->content_id == $post['content_id']) {
				return;
			}
		}
		$distribution = $this->distributionRepo->fetchByDeviceIdAndContentId($post['device_id'], $post['content_id']);
		if ($distribution) {
			throw new \Exception("Device with id {$post['device_id']} is already broadcasting content with id {$post['content_id']}.");
		}
	}

	/**
	 * @throws \Exception
	 */
	public function editDistribution(array $post): void {
		$this->validate($post);
		$distribution = $this->distributionRepo->fetchById($post['id']);
		if (!$distribution) {
			throw new \Exception("Distribution with id {$post['id']} not found.");
		}
		$values = new TDbDistribution();
		$values->id = $post['id'];
		$values->content_id = $post['content_id'];
		$values->device_id = $post['device_id'];
		$values->date_from = $post['date_from'];
		$values->date_to = $post['date_to'];
		$this->distributionRepo->save($values);
	}

	/**
	 * @throws \Exception
	 */
	public function deleteDistribution(int $id): void {
		$distribution = $this->distributionRepo->fetchById($id);
		if (!$distribution) {
			throw new \Exception("Distribution with id {$id} not found.");
		}
		$this->distributionRepo->delete($id);
	}

}