<?php
namespace App\Helpers;

use App\Products;
use Illuminate\Support\Str;

class RuleB {

	public function fetchAll() {
		$methods = get_class_methods($this);
		$products = [];
		foreach ($methods as $key => $value) {
			if (Str::startsWith($value, 'products')) {
				$products[] = $this->$value();
			}
		}

		return $products;
	}

	protected function products_greaterThan100() {
		$products['uploadGreaterThan100'] = Products::select(['id', 'name', 'download_speed', 'upload_speed', 'is_fibre'])
			->where('upload_speed', '>', 100)->get()->toArray();

		return $products;
	}
}