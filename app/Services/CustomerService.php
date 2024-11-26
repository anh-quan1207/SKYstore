<?php
namespace App\Services;

use App\Repositories\CustomerRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class CustomerService 
{
    protected $customerRepository;
    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function getById($id)
    {
        return $this->customerRepository->getById($id);
    }

    public function create(array $data)
    {
        return $this->customerRepository->create($data);
    }

    public function updateUsername($customer,$username)
    {
        DB::beginTransaction();
        try {
            DB::commit();
            return $this->customerRepository->updateUsername($customer, $username);
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    public function updateEmail($customer, $email)
    {
        DB::beginTransaction();
        try {
            DB::commit();
            return $this->customerRepository->updateEmail($customer, $email);
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    public function updateStatus($customer, $status)
    {
        DB::beginTransaction();
        try {
            DB::commit();
            return $this->customerRepository->updateStatus($customer, $status);
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    public function updatePassword($customer, $password)
    {
        DB::beginTransaction();
        try {
            DB::commit();
            return $this->customerRepository->updatePassword($customer, $password);
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    public function delete($id)
    {
        return $this->customerRepository->delete($id);
    }

    public function getAll()
    {
        return $this->customerRepository->getAll();
    }

    public function getByUserName($username)
    {
        return $this->customerRepository->getByUserName($username);
    }

    public function getByEmail($email)
    {
        return $this->customerRepository->getByEmail($email);
    }

    public function getTopCustomersByOrderCount($limit)
    {
        return $this->customerRepository->getTopCustomersByOrderCount($limit);
    }

    public function countCustomer()
    {
        return $this->customerRepository->countCustomer();
    }

    public function usernameExists($customerId,$username)
    {
        return $this->customerRepository->usernameExists($customerId, $username);
    }

    public function emailExists($customerId, $email)
    {
        return $this->customerRepository->emailExists($customerId, $email);
    }


}