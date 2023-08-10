<?php
declare(strict_types=1);

namespace App\Models\Repository\Table;

use App\models\BaseModel\BaseModel;
use App\Types\DB\Tables\TDbContent;
use Nette\Database\Table\ActiveRow;

class ContentRepository extends BaseModel {
	protected $table = 'content';

	public function fetchById($id): TDbContent|ActiveRow|null {
		return parent::fetchById($id);
	}

	public function fetchByFilename(string $filename): TDbContent|ActiveRow|null {
		return $this->findAllActive()
			->where('filename', $filename)
			->limit(1)
			->fetch();
	}

}