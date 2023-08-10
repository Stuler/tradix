<?php
declare(strict_types=1);

namespace App\Models\ProcessManager;

use App\Models\Process\ContentProcess;

class ContentProcessManager {

	public function __construct(
		private readonly ContentProcess $contentProcess,
	) {
	}

	/**
	 * @throws \Exception
	 */
	public function addContent(array $post): void {
		$this->contentProcess->addContent($post);
	}

	/**
	 * @throws \Exception
	 */
	public function editContent(array $post): void {
		$this->contentProcess->editContent($post);
	}

	/**
	 * @throws \Exception
	 */
	public function deleteContent(int $id): void {
		$this->contentProcess->deleteContent($id);
	}

}