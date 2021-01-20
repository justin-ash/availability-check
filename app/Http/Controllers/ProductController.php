<?php

namespace App\Http\Controllers;
use App\Helpers\RuleA;
use App\Helpers\RuleB;
use Illuminate\Http\Request;

class ProductController extends Controller {

	public function __construct(RuleA $ruleA, RuleB $ruleB) {
		$this->products = $this->prepareProducts(array_merge($ruleA->fetchAll(), $ruleB->fetchAll()));
	}

	public function productLists(Request $request) {
		return view('products')->with(['products' => $this->products]);
	}

	public function prepareProducts($allProducts) {
		$avlProducts = [];
		$keys = [];

		foreach ($allProducts as $key => $roleResult) {
			foreach ($roleResult as $prodKey => $product) {
				foreach ($product as $itemKey => $item) {
					if (empty($avlProducts[$item['id']])) {
						$avlProducts[$item['id']] = (object) $item;
						$avlProducts[$item['id']]->availability = [];
					}
					array_push($avlProducts[$item['id']]->availability, $this->generateHtml($prodKey));
				}
			}
		}
		return array_values($avlProducts);
	}

	public function generateHtml($rule) {
		switch ($rule) {
		case 'downloadGreaterThan100':
			return '<input type="checkbox" name="downloadGreaterThan100" checked="checked"/> <label>Download speed greater than 100</label>';

			break;
		case 'isFibre':
			return '<input type="checkbox" name="isFibre" checked="checked"/> <label>fibre</label>';
			break;
		case 'uploadGreaterThan100':
			return '<input type="checkbox" name="uploadGreaterThan100" checked="checked"/> <label>Upload speed greater than 100</label>';
			break;

		default:

			break;
		}
	}
}
