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

      public function getCommentById($id){
        $this->db->query('SELECT * FROM comments WHERE id = :id');
        $this->db->bind(':id', $id);
  
        $row = $this->db->single();
  
        return $row;
      }

      public function addComment($data){
        $this->db->query('INSERT INTO comments ( user_id, post_id, body) VALUES(:user_id, :post_id, :body)');
        // Bind values
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':post_id', $data['post_id']);
        $this->db->bind(':body', $data['body']);
  
        // Execute
        if($this->db->execute()){
          return true;
        } else {
          return false;
        }
      }

      public function updateComment($data){
        $this->db->query('UPDATE comments SET body = :body WHERE id = :id');
        // Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':body', $data['body']);
  
        // Execute
        if($this->db->execute()){
          return true;
        } else {
          return false;
        }
      }

      public function deleteComment($id){
        $this->db->query('DELETE FROM comments WHERE id = :id');
        // Bind values
        $this->db->bind(':id', $id);
  
        // Execute
        if($this->db->execute()){
          return true;
        } else {
          return false;
        }
      }
   
    
  }



