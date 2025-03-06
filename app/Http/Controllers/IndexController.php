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
        $pizzaCollection = $builder->select(['id','name'])->from('pizza')->get();
        $sauceCollection = $builder->select(['name'])->from('sauces')->get();
        $sizesCollection = $builder->select(['size'])->distinct()->from('pizza_options')->get();
        
        /*
            Я получил данные 3 разными запросами, чтобы было удобнее доставать данные на фронте.
             Но в реальной задаче я бы получал информацию о пицце и ее размере
            вот таким запросом:
            SELECT pizza.id, pizza.`name`, pizza_options.size FROM pizza 
              JOIN pizza_options ON pizza.id = pizza_options.pizza_id 
                GROUP BY pizza.id
        */
        
        return View::render('index', [
                            'App' => $_ENV['APP_NAME'],
                            'pizzaCollection' => $pizzaCollection,
                            'sauceCollection' => $sauceCollection,
                            'sizesCollection' => $sizesCollection,
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