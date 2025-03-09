<?php
namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Facades\Request\Request;
use App\Kernel\View\View;
use App\Kernel\DB\QueryBuilder\Builder;
use App\Http\Services\OrderService;
use App\Http\Models\OrderModel;
use App\Http\Services\CurrencyRateService;
use App\Http\Factories\PizzaFactory;

class IndexController extends Controller
{
    public function index()
    {
        $builder = $this->container->get(Builder::class);
        $sauceCollection = $builder->select(['name'])->from('sauces')->get();        
        $menuCollection = ($builder->select(['pizza.id', 'pizza.name', 'pizza_options.size'])
                                ->from('pizza')
                                ->join('pizza_options')
                                ->on(['pizza.id', '=', 'pizza_options.pizza_id'] )
                                ->groupBy(['pizza.id'])
                                ->get() 
                            );
            

        return View::render('index', [
                            'App' => $_ENV['APP_NAME'],
                            'sauceCollection' => $sauceCollection,
                            'collection' => $menuCollection,
                            ]);
    }

    public function handle(Request $request)
    {
        $builder = $this->container->get(Builder::class);
        $opt = $builder->select(['price'])->from('pizza_options')
            ->where('pizza_id', '=', (int)$request->id)
            ->and('size', '=', (float)$request->size)
            ->get();

            if (count($opt)) {
                $data = $request->getDataAsArray();
                $data['price'] = $opt[0]->price;
                $order = new OrderModel($this->container->get(CurrencyRateService::class));
                $order->addPizza(PizzaFactory::createPizza($request->pizza, $data));
                $order->sauce = $request->sauce;
    
                return ($order->showOrder());
            }

            return '';
    }
}