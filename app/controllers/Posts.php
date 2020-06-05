<?php
class Posts extends Controller
{
    public function __construct()
    {
        // Instantiate post
        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
        $this->commentModel = $this->model('Comment');
    }

    public function index()
    {
        // Get posts
        $posts = $this->postModel->getPosts();

        // set data as posts
        $data = ['posts' => $posts];

        $this->view('posts/index', $data);
    }

    public function add()
    {
        // Add new post
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = ['title' => trim($_POST['title']) , 'body' => trim($_POST['body']) , 'user_id' => $_SESSION['user_id'], 'title_err' => '', 'body_err' => ''];

            // Validate data
            if (empty($data['title']))
            {
                $data['title_err'] = 'Please enter title';
            }
            if (empty($data['body']))
            {
                $data['body_err'] = 'Please enter body text';
            }

            // Make sure no errors
            if (empty($data['title_err']) && empty($data['body_err']))
            {
                // Validated
                if ($this->postModel->addPost($data))
                {
                    flash('post_message', 'Post Added');
                    redirect('posts');
                }
                else
                {
                    die('Something went wrong');
                }
            }
            else
            {
                // Load view with errors
                $this->view('posts/add', $data);
            }
        }
        else
        {
            $data = ['title' => '', 'body' => ''];

            $this->view('posts/add', $data);
        }
    }

    public function edit($id)
    {
        // Edit existing post
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = ['id' => $id, 'title' => trim($_POST['title']) , 'body' => trim($_POST['body']) , 'user_id' => $_SESSION['user_id'], 'title_err' => '', 'body_err' => ''];

            // Validate data
            if (empty($data['title']))
            {
                $data['title_err'] = 'Please enter title';
            }
            if (empty($data['body']))
            {
                $data['body_err'] = 'Please enter body text';
            }

            // Make sure no errors
            if (empty($data['title_err']) && empty($data['body_err']))
            {
                // Validated
                if ($this->postModel->updatePost($data))
                {
                    flash('post_message', 'Post Updated');
                    redirect('posts');
                }
                else
                {
                    die('Something went wrong');
                }
            }
            else
            {
                // Load view with errors
                $this->view('posts/edit', $data);
            }            
        }
        else
        {
            // Get existing post from model
            $post = $this
                ->postModel
                ->getPostById($id);

            // Check to make sure user is owner.
            if ($post->user_id != $_SESSION['user_id'])
            {
                redirect('posts');
            }

            $data = ['id' => $id, 'title' => $post->title, 'body' => $post->body];

            $this->view('posts/edit', $data);
        }
    }

    public function show($id)
    {
        $post = $this->postModel->getPostById($id);
        $user = $this->userModel->getUserById($post->user_id);
        $comments = $this->commentModel->getCommentsForPost($id);

        $data = ['post' => $post, 'user' => $user, 'comments' => $comments];

        $this->view('posts/show', $data);
    }

    public function delete($id)
    {
        //Delete an existing post
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            // Get existing post from model
            $post = $this->postModel->getPostById($id);

            // Check for owner
            if ($post->user_id != $_SESSION['user_id'])
            {
                redirect('posts');
            }

            if ($this->postModel->deletePost($id))
            {
                flash('post_message', 'Post Removed');
                redirect('posts');
            }
            else
            {
                die('Something went wrong');
            }
        }
        else
        {
            redirect('posts');
        }
    }

    public function addComment($id)
    {
        // Add new comment
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = ['body' => trim($_POST['body']) , 'user_id' => $_SESSION['user_id'], 'post_id' => $id, 'body_err' => ''];

            // Validate data
            if (empty($data['body']))
            {
                $data['body_err'] = 'Please enter body text';
            }

            // Make sure no errors
            if (empty($data['body_err']))
            {
                // Validated
                if ($this
                    ->commentModel
                    ->addComment($data))
                {
                    flash('post_message', 'Post Added');
                    redirect('posts/show/' . $id);
                }
                else
                {
                    die('Something went wrong');
                }
            }
            else
            {
                // Load view with errors
                $this->view('posts/addComment', $data);
            }
        }
        else
        {
            $data = ['post_id' => $id, 'body' => ''];

            $this->view('posts/addComment', $data);
        }
    }

    public function editComment($id)
    {
        // Edit post with post request
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $comment = $this->commentModel->getCommentById($id);

            $data = ['id' => $id, 'body' => trim($_POST['body']) , 'user_id' => $_SESSION['user_id'], 'post_id' => $comment->post_id, 'body_err' => ''];

            // Validate data
            if (empty($data['body']))
            {
                $data['body_err'] = 'Please enter body text';
            }

            // Make sure no errors
            if (empty($data['body_err']))
            {
                // Validated
                if ($this->commentModel->updateComment($data))
                {
                    flash('post_message', 'Comment Updated');
                    redirect('posts/show/' . $comment->post_id);
                }
                else
                {
                    die('Something went wrong');
                }
            }
            else
            {
                // Load view with errors
                $this->view('posts/editComment', $data);
            }            
        }
        else
        {
            // Get existing post from model
            $comment = $this->commentModel->getCommentById($id);

            // Check for owner.
            if ($comment->user_id != $_SESSION['user_id'])
            {
                redirect('posts/show/' . $comment->post_id);
            }

            $data = ['id' => $id, 'body' => $comment->body, 'post_id' => $comment->post_id];

            $this->view('posts/editComment', $data);
        }
    }

    public function deleteComment($commentId)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            // Get existing post from model
            $comment = $this->commentModel->getCommentById($commentId);

            // Check if owner of comment
            if ($comment->user_id != $_SESSION['user_id'])
            {
                redirect('posts/show/');
            }

            if ($this
                ->commentModel
                ->deleteComment($commentId))
            {
                flash('post_message', 'Comment Removed');
                redirect('posts/show/' . $comment->post_id);
            }
            else
            {
                die('Something went wrong');
            }
        }
        else
        {
            redirect('posts/show/');
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
            $posts = $this->postModel->getPosts();

            // set data as products
            $data = ['posts' => $posts];
            $this->view('posts/manage', $data);
        }
        else
        {
            redirect('pages/index');
        }
    }
}