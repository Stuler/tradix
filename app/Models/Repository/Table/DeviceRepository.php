<?php
declare(strict_types=1);

namespace App\Models\Repository\Table;

use App\models\BaseModel\BaseModel;
use App\Types\DB\Tables\TDbDevice;
use Nette\Database\Table\ActiveRow;

class DeviceRepository extends BaseModel {
	protected $table = 'device';

	public function fetchById($id): TDbDevice|ActiveRow|null {
		return parent::fetchById($id);
	}

	public function fetchByUUID(mixed $uuid): TDbDevice|ActiveRow|null {
		return $this->findAllActive()
			->where('uuid', $uuid)
			->limit(1)
			->fetch();
	}

}