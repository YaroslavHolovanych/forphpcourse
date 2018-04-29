<?php

class CustomerController extends Controller {

    public function IndexAction() {
        $this->ListAction();
    }

    public function ListAction() {
        $this->setTitle("Покупці");
        $this->registry['customer'] = $this->getModel('Customer')->initCollection()
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

    public function AddAction() {

        $model = $this->getModel('Product');
        $this->setTitle("Додавання товару");
        if ($values = $model->getPostValues()) {
            $model->addItem($values);
        }
        $this->setView();
        $this->renderLayout();
    }

    public function getSortParams() {
        $params = [];
        $sortfirst = filter_input(INPUT_POST, 'sortfirst');
        if ($sortfirst === "first_name_DESC") {
            $params['first_name'] = 'DESC';
        } else {
            $params['first_name'] = 'ASC';
        }
        /*$sortsecond = filter_input(INPUT_POST, 'sortsecond');
        if ($sortsecond === "qty_DESC") {
            $params['qty'] = 'DESC';
        } else {
            $params['qty'] = 'ASC';
        }*/

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