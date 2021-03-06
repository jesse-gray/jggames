<?php
class Orders extends Controller
{
    public function __construct()
    {
        // Only for logged in users
        if (!isLoggedIn())
        {
            redirect('users/login');
        }

        // instantiate order
        $this->orderModel = $this->model('Order');
    }

    public function index()
    {
        // Get orders
        $orders = $this->orderModel->getOrdersByUserId($_SESSION['user_id']);

        // set data as order
        $data = ['orders' => $orders];

        $this->view('orders/index', $data);
    }

    public function show($id)
    {
        $order = $this->orderModel->getOrderById($id);

        $data = ['order' => $order, ];

        $this->view('orders/show', $data);
    }

    public function manage()
    {
        if (!isLoggedIn())
        {
            redirect('users/login');
        }
        else if ($_SESSION['admin'] > 0)
        {
            $orders = $this->orderModel->getOrders();

            // set data as products
            $data = ['orders' => $orders];
            $this->view('orders/manage', $data);
        }
        else
        {
            redirect('pages/index');
        }
    }
}