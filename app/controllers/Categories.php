<?php
class Categories extends Controller
{
    public function __construct()
    {
        // this makes all forums only for logged in users
        if (!isLoggedIn())
        {
            redirect('users/login');
        }

        // Check for admin
        if (!$_SESSION['admin'] > 0)
        {
            redirect('pages');
        }

        // instantiate category
        $this->categoryModel = $this->model('Category');
    }

    public function index()
    {
        // Get categories
        $categories = $this->categoryModel->getCategories();

        // Set data as categories
        $data = ['categories' => $categories];

        $this->view('categories/index', $data);
    }

    public function add()
    {
        // add new category
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = ['name' => trim($_POST['name']) , 'name_err' => ''

            ];

            // Validate data
            if (empty($data['name']))
            {
                $data['name_err'] = 'Please enter name';
            }

            // Make sure no errors
            if (empty($data['name_err']))
            {
                // Validated
                if ($this->categoryModel->addCategory($data))
                {
                    flash('post_message', 'Category Added');
                    redirect('categories');
                }
                else
                {
                    die('Something went wrong');
                }
            }
            else
            {
                // Load view with errors
                $this->view('categories/add', $data);
            }
        }
        else
        {
            $data = ['name' => '', ];
            $this->view('categories/add', $data);
        }
    }

    public function edit($id)
    {
        // Edits an existing category
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {

            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = ['id' => $id, 'name' => trim($_POST['name']) , 'name_err' => ''

            ];

            // Validate data
            if (empty($data['name']))
            {
                $data['name_err'] = 'Please enter name';
            }

            // Make sure no errors
            if (empty($data['name_err']))
            {
                // Validated
                if ($this->categoryModel->updateCategory($data))
                {
                    flash('post_message', 'Category edited');
                    redirect('categories');
                }
                else
                {
                    die('Something went wrong');
                }
            }
            else
            {
                // Load view with errors
                $this->view('categories/edit', $data);
            }

        }
        else
        {
            // Get existing category from model
            $category = $this->categoryModel->getCategoryById($id);

            $data = ['id' => $id, 'name' => $category->name, ];

            $this->view('categories/edit', $data);
        }
    }

    public function show($id)
    {
        $category = $this->categoryModel->getCategoryById($id);

        $data = ['category' => $category, ];

        $this->view('categories/show', $data);
    }

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {

            // Check for admin
            if (!$_SESSION['admin'] > 0)
            {
                redirect('pages/index');
            }

            if ($this->categoryModel->deleteCategory($id))
            {
                flash('post_message', 'Category Removed');
                redirect('categories');
            }
            else
            {
                die('Something went wrong');
            }
        }
        else
        {
            redirect('categories');
        }
    }

    public function manage()
    {
        if (!isLoggedIn())
        {
            redirect('users/login');
        }
        else if ($_SESSION['admin'] > 0)
        {
            $categories = $this->categoryModel->getCategories();

            // set data as products
            $data = ['categories' => $categories];
            $this->view('categories/manage', $data);
        }
        else
        {
            redirect('pages/index');
        }
    }
}