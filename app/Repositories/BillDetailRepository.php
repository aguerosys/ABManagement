<?php

declare(strict_types=1);

namespace App\Repositories;
use App\Models\BillDetail;


class BillDetailRepository
{
    protected BillDetail $modelBillDetail;

    public function __construct(BillDetail $modelBillDetail)
    {
        $this->modelBillDetail = $modelBillDetail;  
    }

    public function store(array $data)
    {
        return $this->modelBillDetail->create($data);
    }

    public function destroy(BillDetail $billDetail)
    {
        $billDetail->delete();
    }

    public function update(BillDetail $billDetail, array $data)
    {
        $billDetail->update($data);
    }

    
    
    
   
}
