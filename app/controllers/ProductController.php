<?php

class ProductController extends Controller {
    
    public function IndexAction() {
        $this->ListAction();
    }

    public function ListAction() {
        $this->setTitle("Товари");

        $this->registry['products'] = $this->getModel('Product')->initCollection()
               ->sort($this->getSortParams())->getCollection()->select();

        $this->setView();
        $this->renderLayout();
    }

    public function ByidAction() {
        $this->setTitle("Карточка товара");
        $this->registry['product'] = $this->getModel('Product')->initCollection()
               ->filter(['id',$this->getId()])->getCollection()->selectFirst();
        $this->setView();
        $this->renderLayout();
    }

    public function EditAction() {
        $model = $this->getModel('Product');
        $this->registry['saved'] = 0;
        $this->setTitle("Редагування товару");
        $id = filter_input(INPUT_POST, 'id');
        if ($id) {
            $values = $model->getPostValues();
            $this->registry['saved'] = 1;
            $model->saveItem($id,$values);
        }
        $this->registry['product'] = $model->getItem($this->getId());
        $this->setView();
        $this->renderLayout();
    }
    public function DeleteAction() {
        $model = $this->getModel('Product');
        $this->registry['delete'] = 0;
        $this->setTitle("Видалення товару");
        $id = filter_input(INPUT_GET, 'id');
        if (filter_input(INPUT_GET, 'delete')) {
            echo "DeleteAction"."<br>";
            $this->registry['delete'] = 1;
            $model->deleteItem($id);
            $this->registry['product'] = null;
        } else {
            $this->registry['product'] = $model->getItem($this->getId());
        }

        $this->setView();
        $this->renderLayout();
    }
    public function AddAction() {
        if($_POST == null) {
            $this->setTitle("Додавання товару");
            //$this->setView();
            //$this->renderLayout();
        } else {
            //var_dump($_POST);
            $model = $this->getModel('Product');
            if ($values = $model->getPostValues()) {
                $model->addItem($values);
                Helper::redirect("/product/edit?id={$model->selectLast()['id']}&is=new");
            }
        }
        $this->setView();
        $this->renderLayout();
    }
    
    public function getSortParams() {
        $params = [];
        $sortfirst = filter_input(INPUT_POST, 'sortfirst');
        if ($sortfirst === "price_DESC") {
            $params['price'] = 'DESC';
        } else {
            $params['price'] = 'ASC';
        }
        $sortsecond = filter_input(INPUT_POST, 'sortsecond');
        if ($sortsecond === "qty_DESC") {
            $params['qty'] = 'DESC';
        } else {
            $params['qty'] = 'ASC';
        }
        
        return $params;

    }

    public function getSortParams_old() {
        /*
        if (isset($_GET['sort'])) {
            $sort = $_GET['sort'];
        } else 
        { 
            $sort = "name";
        }
         * 
         */
        $sort = filter_input(INPUT_GET, 'sort');
        if (!isset($sort)) {
            $sort = "name";
        }
        /*
        if (isset($_GET['order']) && $_GET['order'] == 1) {
            $order = "ASC";
        } else {
            $order = "DESC";
        }
         * 
         */
        if (filter_input(INPUT_GET, 'order') == 1) {
            $order = "DESC";
        } else {
            $order = "ASC";
        }
        
        return array($sort, $order);
    }

    public function getId() {
        /*
        if (isset($_GET['id'])) {
         
            return $_GET['id'];
        } else {
            return NULL;
        }
        */
        return filter_input(INPUT_GET, 'id');
    }
    
    
}