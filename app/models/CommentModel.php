<?php

class CommentModel extends DB
{
  public function getCommentsByNewsId($newsId)
  {
    // Fetches comments and the commenter's name
    $sql = "SELECT c.*, u.fullname 
            FROM comments c 
            JOIN users u ON c.user_id = u.user_id 
            WHERE c.news_id = :news_id 
            ORDER BY c.created_at ASC";
    $result = $this->query($sql, [':news_id' => $newsId]);
    return $result->fetchAll(PDO::FETCH_ASSOC);
  }

  public function addComment($newsId, $userId, $content, $parentId = null)
  {
    $sql = "INSERT INTO comments (news_id, user_id, content, parent_id) 
            VALUES (:news_id, :user_id, :content, :parent_id)";
    $params = [
      ':news_id' => $newsId,
      ':user_id' => $userId,
      ':content' => $content,
      ':parent_id' => $parentId
    ];
    return $this->query($sql, $params);
  }

  public function deleteComment($commentId)
  {
    // This could be restricted to admin or the comment owner
    $sql = "DELETE FROM comments WHERE id = :id";
    return $this->query($sql, [':id' => $commentId]);
  }
}