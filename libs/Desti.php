<?php

declare(strict_types=1);

class Desti extends MySql {

	public function deleteList(array $list): void {
		for ($i = 0; $i < count($list); $i++) {
			$this->delete('testimonials', '`t_id`=' . (int)$list[$i]);
		}
	}

	/*
	 * Edit Testimonials
	 */
	public function editDesti(array $inputs): bool {
		$insert = array(
			'about_ttl'           => $this->addFilter($this->escapeHtml((string)$inputs['about_ttl'])),
			'about_main_dscrptn'  => $inputs['about_main_dscrptn'],
			'about_hglts_ttl'     => $inputs['about_hglts_ttl'],
			'about_hglts_dscrptn' => $inputs['about_hglts_dscrptn'],
			'about_sub_dscrptn'   => $inputs['about_sub_dscrptn'],
			'about_stus'          => $inputs['status']
		);
		$this->update($insert, 'desti_rithu', '`about_id`=' . (int)$inputs['id']);
		return true;
	}

	/*
	 * BUG FIX: parameter was named $pdf but the body referenced $image.
	 * Renamed to $image to match the actual usage.
	 */
	public function updateGalleryImage($id, $image): void {
		$this->update(array('about_img_photo' => $image), 'desti_rithu', '`about_id`=' . (int)$id);
	}

	public function getDesti($id): array {
		$query = "SELECT * FROM `desti_rithu` WHERE `about_id`=" . (int)$id;
		return $this->fetchAll($query);
	}

	public function getAllDestiDetails(): array {
		$query = "SELECT * FROM `desti_rithu` WHERE `about_stus`=1";
		return $this->fetchAll($query);
	}
}