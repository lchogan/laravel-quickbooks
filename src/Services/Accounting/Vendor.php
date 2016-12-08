<?php

namespace Myleshy\Quickbooks\Services\Accounting;

use Myleshy\Quickbooks\Quickbooks;

class Vendor extends Quickbooks
{
    public function create(array $data)
    {
        $this->service = new \QuickBooks_IPP_Service_Vendor();
        $this->resource = new \QuickBooks_IPP_Object_Vendor();
        $this->handleNameListData($data, $this->resource);
        $this->createLines($data['Lines'], $this->resource);
           
        return $this->service->add($this->context, $this->realm, $this->resource);
    }

    public function update($id, array $data)
    {
        $this->service = new \QuickBooks_IPP_Service_Vendor();
        $this->resource = $this->find($id);

        $this->handleNameListnData($data, $this->resource);
        $this->createLines($data['Lines'], $this->resource);
        return parent::_update($this->context, $this->realm, \QuickBooks_IPP_IDS::RESOURCE_VENDOR, $this->resource, $id);
    }

    public function delete($id)
    {
        $this->service = new \QuickBooks_IPP_Service_Vendor();
        return parent::_delete($this->context, $this->realm, \QuickBooks_IPP_IDS::RESOURCE_VENDOR, $id);
    }

    public function find($id)
    {
        return $this->service->query($this->context, $this->realm, "SELECT * FROM Vendor WHERE Id = '$id' ")[0];
    }

    public function get($id)
    {
        return $this->service->query($this->context, $this->realm, "SELECT * FROM Vendor")[0];
    }
}