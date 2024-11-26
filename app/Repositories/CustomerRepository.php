<?php
namespace App\Repositories;

use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CustomerRepository
{
    protected $customer;
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function getById($id)
    {
        return $this->customer->find($id);
    }

    public function getAll()
    {
        return $this->customer->where('status','active')->paginate(30);
    }

    public function countCustomer()
    {
        return $this->customer->where('status','active')->count();
    }

    public function create(array $data)
    {
        return $this->customer->create($data);
    }

    public function updateUsername($customer,$username)
    {
        return $customer->update(['username' => $username]);
    }

    public function updateEmail($customer, $email)
    {
        return $customer->update(['email' => $email]);
    }

    public function updatePassword($customer, $password)
    {
        return $customer->update(['password' => $password]);
    }

    public function updateStatus($customer, $status)
    { 
        return $customer->update(['status' => $status]);
    }

    public function delete($id)
    {
        $customer = $this->customer->find($id);
        return $customer->delete();
    }

    public function getByUserName($username)
    {
        return $this->customer->where('username',$username)->first();
    }

    public function getByEmail($email)
    {
        return $this->customer->where('email',$email)->first();
    }
    
    public function getTopCustomersByOrderCount($limit)
    {
        $date =  Carbon::now()->subMonths(3)->startOfDay();
        return $this->customer->select('customers.id', DB::raw('count(orders.id) as order_count'))
            ->join('orders', 'customers.id', '=', 'orders.customer_id')
            ->whereDate('orders.created_at', '>=', $date)
            ->groupBy('customers.id')
            ->orderBy('order_count','desc')
            ->limit($limit)
            ->get();
    }

    public function usernameExists($customerId,$username)
    {
        return $this->customer->where('username', $username)->where('id','!=',$customerId)->exists();
    }

    public function emailExists($customerId, $email)
    {
        return $this->customer->where('email', $email)->where('id', '!=', $customerId)->exists();
    }
}