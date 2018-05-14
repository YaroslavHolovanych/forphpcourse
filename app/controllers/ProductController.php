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
        if (!Helper::isAdmin()) {
            Helper::redirect('/product/list');
        }
        $model = $this->getModel('Product');
        $this->registry['saved'] = 0;
        $this->setTitle("Редагування товару");
        $id = filter_input(INPUT_POST, 'id');
        if ($id) {
            $values = $model->getPostValues();
            $this->registry['saved'] = 1;
            $model->saveItem($id,$values);
            Helper::redirect('/product/list');
        }
        $this->registry['product'] = $model->getItem($this->getId());
        $this->setView();
        $this->renderLayout();
    }
    public function DeleteAction() {
        if (!Helper::isAdmin()) {
            Helper::redirect('/product/list');
        }
        $model = $this->getModel('Product');
        $this->registry['delete'] = 0;
        $this->setTitle("Видалення товару");
        $id = filter_input(INPUT_GET, 'id');
        if (filter_input(INPUT_GET, 'delete')) {
            $this->registry['delete'] = 1;
            $model->deleteItem($id);
            $this->registry['product'] = null;
            Helper::redirect('/product/list');
        } else {
            $this->registry['product'] = $model->getItem($this->getId());
        }

        $this->setView();
        $this->renderLayout();
    }
    public function AddAction() {
        if (!Helper::isAdmin()) {
            Helper::redirect('/product/list');
        }
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
        $idCustomer = Helper::getCustomer()['customer_id'];
        $params = [];
        $sortfirst = filter_input(INPUT_POST, 'sortfirst');
        $sortsecond = filter_input(INPUT_POST, 'sortsecond');
        if (isset($_COOKIE['customSortParams'][$idCustomer])) {
            $customSort = $_COOKIE['customSortParams'][$idCustomer];
            $customSort = explode(',',$customSort);
            if ($_COOKIE['PHPSESSID'] != $customSort[0]) {
                $sortfirst = $customSort[1];
                $sortsecond = $customSort[2];
            }
        }

        if ($sortfirst === "price_DESC") {
            $params['price'] = 'DESC';
        } else {
            $params['price'] = 'ASC';
        }

        if ($sortsecond === "qty_DESC") {
            $params['qty'] = 'DESC';
        } else {
            $params['qty'] = 'ASC';
        }

        if ($idCustomer) {
            setcookie("customSortParams[$idCustomer]","$_COOKIE[PHPSESSID],price_$params[price],qty_$params[qty]");
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