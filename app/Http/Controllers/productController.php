<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Product;
use DB;
use Illuminate\Support\Facades\Session;

class productController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'ok';
        $g = DB::table("products")->orderBy('created_at', 'DESC')->get();

        return redirect('/')->with($g);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     
        if(auth::check()){

            return view('home.create_product');

        }else{
            return redirect('/')->with('error', 'Você não tem permissão para isto!');
        }
    }


    function searchArrAsId($arr, $id){
        foreach ($arr as $key=>$v) {
            if($v['id'] === $id)
                return $key;
        }
    }

    public function removeToCart($id){     
        if(Session::has('cart')){

            $cart = Session::get('cart');

            if(self::searchArrAsId($cart, $id) >= 0){
                $sx = self::searchArrAsId($cart, $id);
                
                if($cart[$sx]['quantity'] > 1){
                    $cart[$sx]['quantity'] = $cart[$sx]['quantity']-1;
                    $cart[$sx]['totalCost'] = $cart[$sx]['quantity']*$cart[$sx]['cost'];
                   Session::put('cart', $cart);
                   return redirect()->back()->with('success', 'Produto removido com sucesso! =p');
                }else{
                    unset($cart[$sx]);
                    Session::put('cart', $cart);
                    return redirect()->back()->with('success', 'Produto removido com sucesso!');
                }
            }
        }
        
    }
    public function removeProductToCart($id){

        if(Session::has('cart')){


            $cart = Session::get('cart');

            if(self::searchArrAsId($cart, $id) >= 0){
                $sx = self::searchArrAsId($cart, $id);       
                    unset($cart[$sx]);
                    Session::put('cart', $cart);
                    return redirect()->back()->with('success', 'Produto removido com sucesso!');              
            }
        }

    }

    public function searchProducts(){

        if(isset($_GET) && $_GET['s'] != null){

            $g = DB::table('products')->where('name', 'LIKE', '%'.$_GET['s'].'%')->get();
            return view('index', ['products' => $g, 'search'=>true]);
            

        }
        return redirect('/');

    }

    public function addToCart(request $request){
        
        if($request->session()->has('cart')){

            $cart = $request->session()->get('cart');
            if(self::searchArrAsId($cart, $request->id)){

                $sx = self::searchArrAsId($cart, $request->id);
            if($cart[$sx]['quantity'] >= $request->maxQuantity) return redirect()->back()->with('error', 'Já atingiu o limite de estoque!');

            $cart[$sx]['quantity'] += $request->quantity;
            if($cart[$sx]['quantity'] > $request->maxQuantity) return redirect()->back()->with('error', 'Já atingiu o limite de estoque!');

            $cart[$sx]['totalCost'] = $cart[$sx]['quantity']*$request->cost;

            $request->session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Item do carrinho atualizado com sucesso!');


        }else{

            $data = [
                'id'            =>  $request->id,
                'quantity'      =>  $request->quantity,
                'cost'          =>  $request->cost,
                'totalCost'     =>  $request->cost*$request->quantity,
            ];

            $request->session()->push('cart', $data);
            return redirect()->back()->with('success', 'Adicionado no carrinho com sucesso!');
        }

        }else{
            $cart = [];
            $data = [
                'id'            =>  $request->id,
                'quantity'      =>  $request->quantity,
                'cost'          =>  $request->cost,
                'totalCost'     =>  $request->cost*$request->quantity,
            ];

            array_push($cart, $data);
            $request->session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Adicionado no carrinho com sucesso!');

        }
    
    }

    public function cleanAllCart(request $request){
        $request->session()->forget('cart');
        return redirect()->back()->with('Success', 'Carrinho encerrado com sucesso!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth::check()){

            if(!$request->isMethod('post')) return redirect('/')->with('error', 'Metodo não permitido.');

            $p = new Product;

            $p->name = $request->name;
            if(strlen($request->cost)> 5) return redirect()->back()->with('error', 'O valor digitado tem que ser menor que R$ 999.');
            $cost = str_replace(',','.', $request->cost);
            $p->cost = $cost;

            if($request->hasfile('image'))
            {
                $img = $request->file('image');
                $profile = mt_rand(100, 9999) . "-" . mt_rand(100, 999) . '.' . $img->getClientOriginalExtension();
                $img->move(public_path().'/img/product_images/', $profile);    
                $p->image = $profile;
            }

            $p->description = $request->description;
            $p->quantity = $request->quantity;
            if($p->save()) return redirect('product/'.$p->id)->with('success', 'Produto adicionado com sucesso!');
            else return redirect()->back()->with('error', 'Não consegui adicionar');
            //DGAYSUIJOKDLÇÃSD    

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(isset($id)){
            $ps = DB::table('products')->where('id', $id)->get();
            if(count($ps) > 0)
            return view('show_product', ['product' => $ps]);
            else return redirect('/');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
