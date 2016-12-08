<?php

namespace Myleshy\Quickbooks\Services\Accounting;

use Myleshy\Quickbooks\Quickbooks;

class Purchase extends Quickbooks
{
    public function create(array $data)
    {
        $this->service = new \QuickBooks_IPP_Service_Purchase();
        $this->resource = new \QuickBooks_IPP_Object_Purchase();
        $this->handleTransactionData($data, $this->resource);
        $this->createLines($data['Lines'], $this->resource);
           
        return $this->service->add($this->context, $this->realm, $this->resource);
    }

    public function update($id, array $data)
    {
        $this->service = new \QuickBooks_IPP_Service_Purchase();
        $this->resource = $this->find($id);

        $this->handleTransactionData($data, $this->resource);
        $this->createLines($data['Lines'], $this->resource);
        return $this->service->update($this->context, $this->realm, $id, $this->resource);
    }

    public function delete($id)
    {
        $this->service = new \QuickBooks_IPP_Service_Purchase();
        return parent::_delete($this->context, $this->realm, QuickBooks_IPP_IDS::RESOURCE_PURCHASE, $id);
    }

    public function find($id)
    {
        return $this->service->query($this->context, $this->realm, "SELECT * FROM Purchase WHERE Id = '$id' ")[0];
    }

    public function get($id)
    {
        return $this->service->query($this->context, $this->realm, "SELECT * FROM Purchase")[0];
    }
}