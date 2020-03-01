<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Menu;
use App\MenuItem;

class MenuComposer
{
	protected $menus, $footer1, $footer2, $footer3;

	public function __construct()
	{
		$primary = Menu::first();
		if ($primary) {
			$this->menus = MenuItem::where('menu_id', '=', $primary->id)->with('children')->where('parent_id', '=', null)->get();
		}

		$footer1 = Menu::where('name', '=', 'footer1')->first();
		if ($footer1) {
			$this->footer1 = MenuItem::where('menu_id', '=', $footer1->id)->with('children')->where('parent_id', '=', null)->get();
		}

		$footer2 = Menu::where('name', '=', 'footer2')->first();
		if ($footer2) {
			$this->footer2 = MenuItem::where('menu_id', '=', $footer2->id)->with('children')->where('parent_id', '=', null)->get();
		}

		$footer3 = Menu::where('name', '=', 'footer3')->first();
		if ($footer3) {
			$this->footer3 = MenuItem::where('menu_id', '=', $footer3->id)->with('children')->where('parent_id', '=', null)->get();
		}
	}

	/**
	 * Bind data to the view.
	 *
	 * @param  View  $view
	 * @return void
	 */
	public function compose(View $view)
	{
	    $view->with([
	    	'menus' => $this->menus,
	    	'footer1' => $this->footer1,
	    	'footer2' => $this->footer2,
	    	'footer3' => $this->footer3
	    ]);
	}
}