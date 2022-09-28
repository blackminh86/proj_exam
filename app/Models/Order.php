<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;


class Order extends AdminModel
{
    protected $fieldSearchAccepted   = ['id', 'order_no', 'grand_total', 'voucher_code', 'customer_id'];
    protected $fillable   = ['id', 'order_no', 'grand_total', 'voucher_code', 'customer_id'];
    protected $crudNotAccepted = ['view'];
    use HasFactory;
    public function listItems($params = null, $options = null)
    {
        $result = null;
        if ($options['task'] == "admin-list-items") {
            $query = self::with('customer')->select('*');

            if ($params['filter']['status'] !== "all") {
                $query->where('status', '=', $params['filter']['status']);
            }

            if ($params['search']['value'] !== "") {
                if ($params['search']['field'] == "all") {
                    $query->where(function ($query) use ($params) {
                        foreach ($this->fieldSearchAccepted as $column) {
                            $query->orWhere($column, 'LIKE',  "%{$params['search']['value']}%");
                        }
                    });
                } else if (in_array($params['search']['field'], $this->fieldSearchAccepted)) {
                    $query->where($params['search']['field'], 'LIKE',  "%{$params['search']['value']}%");
                }
            }

            $result =  $query->orderBy('created_at', 'desc')
                ->paginate($params['pagination']['totalItemsPerPage']);
        }
        return $result;
    }
    public function countItems($params = null, $options  = null)
    {
        $result = null;
        if ($options['task'] == 'admin-count-items-group-by-status') {

            $query = $this::groupBy('status')
                ->select(DB::raw('status , COUNT(id) as count'));

            if ($params['search']['value'] !== "") {
                if ($params['search']['field'] == "all") {
                    $query->where(function ($query) use ($params) {
                        foreach ($this->fieldSearchAccepted as $column) {
                            $query->orWhere($column, 'LIKE',  "%{$params['search']['value']}%");
                        }
                    });
                } else if (in_array($params['search']['field'], $this->fieldSearchAccepted)) {
                    $query->where($params['search']['field'], 'LIKE',  "%{$params['search']['value']}%");
                }
            }
           
            $result = $query->get()->toArray();
        }

        return $result;
    }
    public function saveOrder($cart, $customer_id)
    {
        $total = 0;
        foreach ($cart as $value) {
            $total += $value['quantity'] * $value['price'];
        }
        $order_no = date('Y') . date('m') . rand(1000, 9999);
        //$order_id    = DB::table('orders')->insertGetId([
        $order_id    = self::create([
            'order_no'    => $order_no,
            'status'      => 'pending',
            'grand_total' => $total,
            'voucher_code' => null,
            'customer_id' => $customer_id
        ])->id;
        return $order_id;
    }
    public function Customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
