<?php

class CustomerController extends Controller {

    public function IndexAction() {
        $this->ListAction();
    }

    public function ListAction() {
        //if (!Helper::isAdmin()) {
            //Helper::redirect('/');
        //}
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


    public function RegisterAction() {
        $this->setTitle("Реєстрація");

        if (!empty($_POST)) {
            // Валідація введених значень
            $fieldTemplate = array(
                'first_name' => array('/^[A-ZА-Я0-9]+$/i','Невірний формат Імені, тільки символи'),
                'last_name' => array('/^[A-ZА-Я0-9]+$/i','Невірний формат Фамілії, тільки символи'),
                'telephone' => array('/^\+[0-9]{12}$/','Невірний формат номеру Телефона, міжнародний стандарт'),
                'email' => array('/^[a-z0-9\.\-\_]+@[a-z0-9\.\-\_]+\.[a-z]{2,4}$/i','Невірний формат Email'),
                'city' => array('/^[A-ZА-Я]+$/i','Невірний формат Міста, тільки символи'),
                'password' => array('/^(?=([a-z]+\d+|\d+[a-z]+))[0-9a-z]{8,}$/i','Невірний формат пароля'),
                'passwordCheck' => array('/^(?=([a-z]+\d+|\d+[a-z]+))[0-9a-z]{8,}$/i','Невірний формат пароля'),
                'passwordsNoMatch' => array("/.*/",'Паролі не співпадають'),
            );
            $this->registrationErrorsMessage = array();
            foreach ($_POST as $nameField=>$valueField) {
                $valueField =trim($valueField);
                if (preg_match($fieldTemplate[$nameField][0],$valueField) == 0) {
                    $this->registrationErrorsMessage[$nameField] = $fieldTemplate[$nameField][1];
                }
            }
            // Чи співпадають паролі
            if ($_POST['password'] !== $_POST['passwordCheck']) {
                $this->registrationErrorsMessage['passwordsNoMatch'] = $fieldTemplate['passwordsNoMatch'][1];}

            if(empty($this->registrationErrorsMessage)) {
                //Перевірка чи присутній користувач
                $params =array (
                    'email'=>$_POST['email']
                );
                $customer = $this->getModel('customer')->initCollection()
                    ->filter($params)
                    ->getCollection()
                    ->selectFirst();
                if (empty($customer)) {
                    // Запис користувача до БД
                    $this->getModel('Customer')->addCustomer($_POST);
                } else {
                    if(empty($this->savingCustomerCompleted)) {
                        $this->registrationErrorsMessage['email'] = 'Користувач з таким адресом існує';
                    }
                    $this->savingCustomerCompleted = true;

                }
            }
        }
        $this->setView();
        $this->renderLayout();
    }

    public function LoginAction() {
        $this->setTitle("Вхід");
        if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
            $email = filter_input(INPUT_POST, 'email');
            $password = md5(filter_input(INPUT_POST, 'password'));
            $params =array (
                'email'=>$email,
                'password'=> $password
            );
            $customer = $this->getModel('customer')->initCollection()
                ->filter($params)
                ->getCollection()
                ->selectFirst();
            if(!empty($customer)) {
                $this->invalid_password = 0;
                $_SESSION['id'] = $customer['customer_id'];
                //var_dump($_COOKIE);
                Helper::redirect('/customer/account');
            } else {
                $this->invalid_password = 1;
            }
        }
        $this->setView();
        $this->renderLayout();
    }

    public function AccountAction() {
        $customer = Helper::getCustomer();
        $this->customer = $customer;
        $this->setTitle($customer['first_name']." ".$customer['last_name']);
        $this->setView();
        $this->renderLayout();
    }

    public function LogoutAction() {
        $_SESSION = [];
        $this->customer = [];

        if (!empty($_COOKIE[session_name()]))
        {
            setcookie(session_name(), "", time() - 3600, "/");
        }

        session_destroy();
        Helper::redirect('/');
    }


}