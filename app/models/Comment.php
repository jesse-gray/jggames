<?php
  class Comment {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getCommentsForPost($id){
        
        $this->db->query('  SELECT 
                            comments.id as commentId,
                            comments.user_id as commentUserId,
                            comments.post_id as commentPostId,
                            comments.body as commentBody,
                            comments.created_at as commentCreated,
                            users.name as commentUserName
                            FROM comments
                            LEFT JOIN users
                            ON comments.user_id = users.id
                            WHERE comments.post_id = :id');

        $this->db->bind(':id', $id);
  
        $results = $this->db->resultSet();


  
        return $results;
      }



    //   SELECT  
    //                 posts.id as postId,
    //                 posts.created_at as postCreated,
    //                 posts.body as postBody,
    //                 posts.user_id as postUserId,
    //                 comments.id as commentId,
    //                 comments.user_id as commentUserId,
    //                 comments.post_id as commentPostId,
    //                 comments.body as commentBody,
    //                 usersPost.name as postUserName,
    //                 usersComment.name as commentUserName
    //                 FROM posts
    //                 LEFT JOIN comments
    //                 ON posts.id = comments.post_id
    //                 LEFT JOIN users as usersPost
    //                 ON posts.user_id = usersPost.id
    //                 LEFT JOIN users as usersComment
    //                 ON comments.user_id = usersComment.id
    //                 WHERE posts.id = :id
    
  }



