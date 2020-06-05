<?php
class Products extends Controller
{
    public function __construct()
    {
        // Instantiate product
        $this->productModel = $this->model('Product');

        // Instantiate genre
        $this->genreModel = $this->model('Genre');

        // Instantiate category
        $this->categoryModel = $this->model('Category');
    }

    public function index()
    {
        // Get products
        $products = $this->productModel->getProducts();

        // Set data as products
        $data = ['products' => $products];

        $this->view('products/index', $data);
    }

    public function add()
    {
        // Add new product
        $genres = $this->genreModel->getGenres();
        $categories = $this->categoryModel->getCategories();

        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = ['name' => trim($_POST['name']) , 'quantity' => trim($_POST['quantity']) , 'price' => trim($_POST['price']) , 'long_description' => trim($_POST['long_description']) , 'description' => trim($_POST['description']) , 'image_link' => trim($_POST['image_link']) , 'genres' => $genres, 'genre' => trim($_POST['genre']) , 'categories' => $categories, 'category' => trim($_POST['category']) , 'name_err' => '', 'quantity_err' => '', 'price_err' => '', 'description_err' => '', 'long_description_err' => '', 'image_link_err' => '', 'genre_err' => '', 'category_err' => ''];

            // Validate data
            if (empty($data['name']))
            {
                $data['name_err'] = 'Please enter name';
            }
            if (empty($data['quantity']))
            {
                $data['quantity_err'] = 'Please enter quantity';
            }
            if (empty($data['price']))
            {
                $data['price_err'] = 'Please enter price';
            }
            if (empty($data['description']))
            {
                $data['description_err'] = 'Please enter description';
            }
            if (empty($data['long_description']))
            {
                $data['long_description_err'] = 'Please enter a long description';
            }
            if (empty($data['image_link']))
            {
                $data['image_link_err'] = 'Please enter image link';
            }
            if ($data['genre'] === 'Choose...')
            {
                $data['genre_err'] = 'Please enter genre';
            }
            if ($data['category'] === 'Choose...')
            {
                $data['category_err'] = 'Please enter category';
            }

            // Make sure no errors
            if (empty($data['name_err']) && empty($data['quantity_err']) && empty($data['price_err']) && empty($data['description_err']) && empty($data['long_description_err']) && empty($data['image_link_err']) && empty($data['genre_err']) && empty($data['category_err']))
            {
                // Validated
                $genre = $this->genreModel->getGenreByName($data['genre']);
                $category = $this->categoryModel->getcategoryByName($data['category']);

                $newProduct = ['name' => $data['name'], 'quantity' => $data['quantity'], 'price' => $data['price'], 'description' => $data['description'], 'long_description' => $data['long_description'], 'image_link' => $data['image_link'], 'genre_id' => $genre->id, 'category_id' => $category->id];
                if ($this->productModel->addProduct($newProduct))
                {
                    flash('post_message', 'Product Added');
                    redirect('products');
                }
                else
                {
                    die('Something went wrong');
                }
            }
            else
            {
                // Load view with errors
                $this->view('products/add', $data);
            }
        }
        else
        {
            $data = ['name' => '', 'quantity' => '', 'price' => '', 'description' => '', 'long_description' => '', 'image_link' => '', 'genre' => '', 'genres' => $genres, 'category' => '', 'categories' => $categories];

            $this->view('products/add', $data);
        }
    }

    public function edit($id)
    {
        // Edit an existing product
        $genres = $this->genreModel->getGenres();
        $categories = $this->categoryModel->getCategories();

        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = ['id' => $id, 'name' => trim($_POST['name']) , 'quantity' => trim($_POST['quantity']) , 'price' => trim($_POST['price']) , 'description' => trim($_POST['description']) , 'long_description' => trim($_POST['long_description']) , 'image_link' => trim($_POST['image_link']) , 'genres' => $genres, 'genre' => trim($_POST['genre']) , 'categories' => $categories, 'category' => trim($_POST['category']) , 'name_err' => '', 'quantity_err' => '', 'price_err' => '', 'long_description_err' => '', 'description_err' => '', 'image_link_err' => '', 'genre_err' => '', 'category_err' => ''];

            // Validate data
            if (empty($data['name']))
            {
                $data['name_err'] = 'Please enter name';
            }
            if (empty($data['quantity']))
            {
                $data['quantity_err'] = 'Please enter quantity';
            }
            if (empty($data['price']))
            {
                $data['price_err'] = 'Please enter price';
            }
            if (empty($data['description']))
            {
                $data['description_err'] = 'Please enter description';
            }
            if (empty($data['long_description']))
            {
                $data['long_description_err'] = 'Please enter a long description';
            }
            if (empty($data['image_link']))
            {
                $data['image_link_err'] = 'Please enter image link';
            }
            if ($data['genre'] === 'Choose...')
            {
                $data['genre_err'] = 'Please enter genre';
            }
            if ($data['category'] === 'Choose...')
            {
                $data['category_err'] = 'Please enter category';
            }

            // Make sure no errors
            if (empty($data['name_err']) && empty($data['quantity_err']) && empty($data['price_err']) && empty($data['description_err']) && empty($data['long_description_err']) && empty($data['image_link_err']) && empty($data['genre_err']) && empty($data['category_err']))
            {
                // Validated
                $genre = $this->genreModel->getGenreByName($data['genre']);
                $category = $this->categoryModel->getcategoryByName($data['category']);

                $newProduct = ['id' => $id, 'name' => $data['name'], 'quantity' => $data['quantity'], 'price' => $data['price'], 'description' => $data['description'], 'long_description' => $data['long_description'], 'image_link' => $data['image_link'], 'genre_id' => $genre->id, 'category_id' => $category->id];

                if ($this->productModel->updateProduct($newProduct))
                {
                    flash('post_message', 'Product edited');
                    redirect('products');
                }
                else
                {
                    die('Something went wrong');
                }
            }
            else
            {
                // Load view with errors
                $this->view('products/edit', $data);
            }            
        }
        else
        {
            // Get existing product from model
            $product = $this->productModel->getProductById($id);
            $genre = $this->genreModel->getGenreById($product->genre_id);
            $category = $this->categoryModel->getCategoryById($product->category_id);

            $data = ['id' => $id, 'name' => $product->name, 'quantity' => $product->quantity, 'price' => $product->price, 'description' => $product->description, 'long_description' => $product->long_description, 'image_link' => $product->image_link, 'genre' => $genre->name, 'genres' => $genres, 'category' => $category->name, 'categories' => $categories, ];

            $this->view('products/edit', $data);
        }
    }

    public function show($id)
    {
        //Show details of product
        $product = $this->productModel->getProductById($id);

        $data = ['product' => $product, ];

        $this->view('products/show', $data);
    }

    public function delete($id)
    {
        //Delete an existing product
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {

            // Check for admin
            if (!$_SESSION['admin'] > 0)
            {
                redirect('pages/index');
            }

            if ($this->productModel->deleteProduct($id))
            {
                flash('post_message', 'Product Removed');
                redirect('products');
            }
            else
            {
                die('Something went wrong');
            }
        }
        else
        {
            redirect('products');
        }
    }

    public function shop()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = ['text_search' => trim($_POST['text_search']) , 'min_price_search' => trim($_POST['min_price_search']) , 'max_price_search' => trim($_POST['max_price_search']) , ];

            $products = $this->productModel->getProductBySearch($data);

            $afterData = ['products' => $products, 'text_search' => '', 'min_price_search' => '', 'max_price_search' => ''];
            // Pass view
            $this->view('products/shop', $afterData);

        }
        else
        {
            // Get Products
            $products = $this->productModel->getProducts();

            $data = ['products' => $products, 'text_search' => '', 'min_price_search' => '', 'max_price_search' => ''];
            // Pass view
            $this->view('products/shop', $data);
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
            $products = $this->productModel->getProducts();

            // set data as products
            $data = ['products' => $products];
            $this->view('products/manage', $data);
        }
        else
        {
            redirect('pages/index');
        }
    }
}