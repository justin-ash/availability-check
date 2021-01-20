<?php
namespace App\Helpers;

use App\Products;
use Illuminate\Support\Str;

class RuleA {

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
		$products['downloadGreaterThan100'] = Products::select(['id', 'name', 'download_speed', 'upload_speed', 'is_fibre', 'technology'])
			->where('download_speed', '>', 100)->get()->toArray();

		return $products;
	}

	protected function products_isFibre() {
		$products['isFibre'] = Products::select(['id', 'name', 'download_speed', 'upload_speed', 'is_fibre'])
			->where('is_fibre', '=', 1)->get()->toArray();

		return $products;
	}
}