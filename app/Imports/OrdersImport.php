<?php

namespace App\Imports;

use App\Models\OrderDetails;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class OrdersImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $existingOrder = OrderDetails::where('order_id', $row['order_id'])->first();
            if ($existingOrder) {
                $existingOrder->update([
                    'user_id' => $row['user_id'],
                    'product_id' => $row['product_id'],
                    'qty' => $row['qty'],
                    'products_variants' => $row['products_variants'],
                    'product_price' => $row['product_price'],
                    'total' => $row['total'],
                ]);
            } else {
                OrderDetails::create([
                    'user_id' => $row['user_id'],
                    'order_id' => $row['order_id'],
                    'product_id' => $row['product_id'],
                    'qty' => $row['qty'],
                    'products_variants' => $row['products_variants'],
                    'product_price' => $row['product_price'],
                    'total' => $row['total'],
                ]);
            }
        }
    }
}
