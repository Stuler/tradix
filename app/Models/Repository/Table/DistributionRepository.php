<?php
declare(strict_types=1);

namespace App\Models\Repository\Table;

use App\models\BaseModel\BaseModel;
use App\Types\DB\Tables\TDbDistribution;
use Nette\Database\Table\ActiveRow;

class DistributionRepository extends BaseModel {
	protected $table = 'distribution';

	public function fetchById($id): TDbDistribution|ActiveRow|null {
		return parent::fetchById($id);
	}

	public function fetchByDeviceIdAndContentId(mixed $device_id, mixed $content_id): TDbDistribution|ActiveRow|null {
		return $this->findAllActive()
			->where('device_id', $device_id)
			->where('content_id', $content_id)
			->limit(1)
			->fetch();
	}

}