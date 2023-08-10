<?php
declare(strict_types=1);

namespace App\Types\DB\Tables;

use Nette\Utils\ArrayHash;

/**
 * Table: content
 * @property int       $id
 * @property int       $content_id
 * @property int       $device_id
 * @property \DateTime $date_from
 * @property \DateTime $date_to
 * @property \DateTime $date_created
 * @property \DateTime $date_deleted
 * @property int       $created_by
 * @property int       $deleted_by
 *
 * @property-read \App\Types\DB\Tables\TDbContent $content
 * @property-read \App\Types\DB\Tables\TDbDevice $device
 *
 * @method \Nette\Database\Table\GroupedSelection related(string $key, string $throughColumn = null)
 * @method \Nette\Database\Table\IRow|null ref(string $key, string $throughColumn = null)
 **/
class TDbDistribution extends ArrayHash {

}