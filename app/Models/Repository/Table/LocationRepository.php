<?php
declare(strict_types=1);

namespace App\Models\Repository\Table;

use App\models\BaseModel\BaseModel;
use App\Types\DB\Tables\TDbLocation;
use Nette\Database\Table\ActiveRow;

class LocationRepository extends BaseModel {
	protected $table = 'location';

	public function fetchById($id): ActiveRow|TDbLocation|null {
		return parent::fetchById($id);
	}

	public function fetchByLabel(mixed $label): ActiveRow|TDbLocation|null {
		return $this->findAllActive()
			->where('label', $label)
			->limit(1)
			->fetch();
	}

}