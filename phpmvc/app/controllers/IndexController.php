<?php

class IndexController extends Controller {
    
    public function indexAction() {
        $this->setTitle("Test shop");
        $this->setView();
        $this->renderLayout();
    }

    public function testAction() {
        $this->setTitle("TestAction");
        $this->setView();
        $this->renderLayout();
    
    }

}