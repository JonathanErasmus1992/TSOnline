<?php

class Item
{
    public $id = "";
    public $itemName = "";
    public $itemCategory = "";
    public $itemPrice = 0.00;
    public $amountInStock = 0;

    public function createItem($tmpID, $tmpItemName, $tmpItemCategory, $tmpItemPrice, $tmpAmountInStock){
        $this->id = $tmpID;
        $this->itemName = $tmpItemName;
        $this->itemCategory = $tmpItemCategory;
        $this->itemPrice = $tmpItemPrice;
        $this->amountInStock = $tmpAmountInStock;
    }

    public function setID($newVal){
        $this->id = $newVal;
    }
    public function getID(){
        return $this->id;
    }

    public function setItemName($newVal){
        $this->itemName = $newVal;
    }
    public function getItemName(){
        return $this->itemName;
    }

    public function setItemCategory($newVal){
        $this->itemCategory = $newVal;
    }
    public function getItemCategory(){
        return $this->itemCategory;
    }

    public function setItemPrice($newVal){
        $this->itemPrice = $newVal;
    }
    public function getItemPrice(){
        return $this->itemPrice;
    }

    public function setAmountInStock($newVal){
        $this->amountInStock = $newVal;
    }
    public function getAmountInStock(){
        return $this->amountInStock;
    }
}
?>