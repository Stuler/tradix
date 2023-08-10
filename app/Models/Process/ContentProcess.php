<?php
declare(strict_types=1);

namespace App\Models\Process;

use App\Models\Repository\Table\ContentRepository;
use App\Types\DB\Tables\TDbContent;

class ContentProcess {

	public function __construct(
		private readonly ContentRepository $contentRepo,
	) {
	}

	/**
	 * @throws \Exception
	 */
	public function addContent(array $post): void {
		$this->validateDuplicity($post);
		$saveValues = new TDbContent();
		$saveValues->label = $post["label"];
		$saveValues->filename = $post["filename"];
		$this->contentRepo->save($saveValues);
	}

	/**
	 * @throws \Exception
	 */
	private function validateDuplicity(array $post): void {
		$content = $this->contentRepo->fetchByFilename($post["filename"]);
		if (isset($data['id']) && $content->id == $data['id']) {
			return;
		}
		if ($content) {
			throw new \Exception("Content with label {$post['filename']} already exists.");
		}
	}

	/**
	 * @throws \Exception
	 */
	public function editContent(array $post): void {
		$content = $this->contentRepo->fetchById($post["id"]);
		if (!$content) {
			throw new \Exception("Content with id {$post['id']} not found.");
		}
		$this->validateDuplicity($post);
		$values = new TDbContent();
		$values->id = $post["id"];
		$values->label = $post["label"];
		$values->filename = $post["filename"];
		$this->contentRepo->save($values);
	}

	/**
	 * @throws \Exception
	 */
	public function deleteContent(int $id): void {
		$content = $this->contentRepo->fetchById($id);
		if (!$content) {
			throw new \Exception("Content with id {$id} not found.");
		}
		$this->contentRepo->delete($content->id);
	}

}