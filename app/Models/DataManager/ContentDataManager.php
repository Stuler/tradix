<?php
declare(strict_types=1);

namespace App\Models\DataManager;

use App\Models\Repository\Table\ContentRepository;

class ContentDataManager {

	public function __construct(
		private readonly ContentRepository $contentRepo,
	) {
	}

	/**
	 * Returns array of all active content.
	 */
	public function getContents(): array {
		$contents = $this->contentRepo->findAllActive();
		$result = [];
		/** @var \App\Types\DB\Tables\TDbContent $content */
		foreach ($contents as $content) {
			$result[] = [
				"id"       => $content->id,
				"label"    => $content->label,
				"filename" => $content->filename,
			];
		}
		return $result;
	}
}