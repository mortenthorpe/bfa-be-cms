<?php

namespace App\Decorator;

use App\Contract\MenuItemInterface;
use App\Entity\Page;
use Symfony\Component\Routing\Generator\UrlGenerator;

class MenuItemDecorator implements MenuItemInterface{
	private $menuItem;
	private $urlGenerator;
	private $page;
	
	public function __construct($menuItem, UrlGenerator $urlGenerator, ?Page $page) {
		$this->menuItem = $menuItem;
		$this->urlGenerator = $urlGenerator;
		$this->page = $page;
	}
	
	public function getMenuItemTitle() {
		return ($this->menuItem['title']) ?? $this->menuItem['name'];
	}
	
	public function getMenuItemHref() {
		return ($this->menuItem['name']) ? $this->urlGenerator->generate($this->menuItem['name'], ['page' => $this->page]) : 'Unnamed';
	}
	
	public function getMenuItemHTML() {
		return sprintf('<a href="%s" title="%s">%s</a>', $this->getMenuItemHref(), $this->getMenuItemTitle(), $this->getMenuItemHref());
	}
	
	public function getMenuItem() {
		return $this->menuItem;
	}
}	