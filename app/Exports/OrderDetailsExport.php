<?php

namespace App\Exports;

use App\Models\OrderDetails;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;
// use Maatwebsite\Excel\Concerns\FromCollection;

// class OrderDetailsExport implements FromCollection
class OrderDetailsExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $id;


    public function __construct($id = null)
    {
        $this->id = $id ? (is_array($id) ? $id : [$id]) : null;
    }

    public function view(): View
    {
        $allOrder = $this->id ? OrderDetails::whereIn('id', $this->id)->get() : OrderDetails::where('user_id',Auth::id())->get();
        return view('expotedData.orderData', [
            'userOrders' => $allOrder
        ]);
    }
}
