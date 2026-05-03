<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Services\CartService;

class CartController extends Controller
{
    public function __construct(protected CartService $cart) {}

    public function index()
    {
        return view('cart.index', [
            'items'      => $this->cart->getCart(),
            'grandTotal' => $this->cart->getGrandTotal(),
        ]);
    }

    public function add(AddToCartRequest $request)
    {
        $this->cart->addItem(
            $request->integer('product_id'),
            $request->integer('quantity', 1)
        );

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function update(UpdateCartRequest $request, int $productId)
    {
        $this->cart->updateItem($productId, $request->integer('quantity'));

        return redirect()->route('cart.index');
    }

    public function destroy(int $productId)
    {
        $this->cart->removeItem($productId);

        return redirect()->route('cart.index');
    }
}
