<?php
declare(strict_types=1);

namespace App\Types\DB\Tables;

use Nette\Utils\ArrayHash;

/**
 * Table: location
 * @property int       $id
 * @property string    $label
 * @property string    $description
 * @property string    $gps_coordinates
 * @property \DateTime $date_created
 * @property \DateTime $date_deleted
 * @property int       $created_by
 * @property int       $deleted_by
 *
 * @method \Nette\Database\Table\GroupedSelection related(string $key, string $throughColumn = null)
 * @method \Nette\Database\Table\IRow|null ref(string $key, string $throughColumn = null)
 **/
class TDbLocation extends ArrayHash {

}