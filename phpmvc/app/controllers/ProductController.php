<?php

class ProductController extends Controller {
    
    public function indexAction() {
        $this->ListAction();
    }

    public function listAction() {
        $this->setTitle("Товари");
        $this->getModel('Product')->setSortfield($this->getSortParams())->sortCollection();
        $this->setView();
        $this->renderLayout();
    }

    public function getSortParams() {
        if (isset($_GET['sort'])) {
            $sort = $_GET['sort'];
        } else
        {
            $sort = "name";
        }
        if (isset($_GET['order'])) {
            $order = $_GET['order'];
        } else {
            $order = 0;
        }
        return array($sort, $order);
    }

}