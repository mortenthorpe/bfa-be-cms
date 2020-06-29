<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing;
use App\Entity\Page;
use App\Entity\Slug;
use Symfony\Component\Routing\RouteCollection;
use App\Decorator\MenuItemDecorator;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\RequestContext;

class DefaultController extends AbstractController {
	/**
	 * @var Routing\RouterInterface $router
	*/
	private $router;
	
	/**
	 * @var array $routeCollection
	 */
	private $routeCollection;
	
	private function buildRouteCollection() {
		if(empty($this->routeCollection)) {
			$allRoutes = $this->router->getRouteCollection()->all();
			foreach($allRoutes as $name => $routeConfig) {
				$route = ['name' => $name];
				$routeCollection[] = $route;
			}
		// Filter out all internal routes, prefixed by '_'.
		$routeCollection = array_filter($routeCollection, function ($e) { return strpos($e['name'], '_') !== 0;});
		$this->routeCollection = $routeCollection;
	  }
	}
	
	public function registerServices(Routing\RouterInterface $router) {
		$this->router = $router;
		$this->buildRouteCollection();
	}
	
	private function getUrlGenerator() {
		$context = new RequestContext();
		$routes = new RouteCollection($this->routeCollection);
		var_dump($routes);
		die();
		
		return new UrlGenerator($routes, $context);
	}
	
	/**
	 * @Route("/{page}", name="page_view")
	 * @Template("default.html.twig")
	 */
	public function index(Request $request, ?Page $page = null) {
		var_dump($this->menuForPage($page));
		return ['title' => 'Hello World!', 'body' => 'Some <b>HTML BODY!</b>'];
		
		return new Response('Hello world!');
	}
	
	private function menuForPage(?Page $page, $menuPosition="menu") {
		$urlGenerator = $this->getUrlGenerator();
		foreach($this->routeCollection as $idx => $menuItem) {
			$menuItemDecorator = new MenuItemDecorator($menuItem, $urlGenerator, $page);
			
			$menu[] = $menuItemDecorator->getMenuItemHTML();
		}
		
		return $menu;
	}
	
/*	private function menuItemForRequest(Request $request) {
		$menu = [];
		foreach($this->menuForPage() as $idx => $menuItem) {
			$menuItem = new MenuItemDecorator($menuItem);
			$menu[] = $menuItem;
		}
		
		return $menu;
	}*/
	
	private function loadSlugLocation($slug, $location = 'left') {
		
	}
	
	
}
?>