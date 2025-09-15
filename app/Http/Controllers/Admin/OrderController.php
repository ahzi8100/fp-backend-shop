<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->q;

        $invoices = Invoice::latest()->when($q, function ($query) use ($q) {
            $query->where('name', 'LIKE', '%' . $q . '%');
        })->paginate(10);

        return view('admin.order.index', compact('invoices'));
    }

    public function show(Invoice $order)
    {
        return view('admin.order.show', compact('order'));
    }
}
