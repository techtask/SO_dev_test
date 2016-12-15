<?php

namespace silverorange\DevTest\Database;

use silverorange\DevTest\Exceptions\NoSuchRecordException;

class PostCRUD extends DatabaseAccessLayer
{
    public function create($id, $title, $body, $created_at, $modified_at, $author)
    {
        $pdo = $this->db->getConnection();
        try {
            $pdo->beginTransaction();
            $stmt = $pdo->prepare("INSERT INTO posts (id, title, body, created_at, modified_at, author) VALUES (:id, :title, :body, :created_at, :modified_at, :author)");
            $stmt->bindParam(":id",$id);
            $stmt->bindParam(":title",$title);
            $stmt->bindParam(":body",$body);
            $stmt->bindParam(":created_at",$created_at);
            $stmt->bindParam(":modified_at",$modified_at);
            $stmt->bindParam(":author",$author);
            $res = $stmt->execute();
            $pdo->commit();

            if ($res !== true) {
               return false;
            }

            $count = $stmt->rowCount();
            if($count === 0) {
                throw new NoSuchRecordException("No Insert was performed.");
            }
        }
        catch (\PDOException $e) {
            // FIXME Error handling here.
            echo "WHAT IS IT?" . $e->getMessage();
            $pdo->rollback();
            return false;
        }
        return true;
    }

    public function read($id)
    {
        $pdo = $this->db->getConnection();
        try {
            $stmt = $pdo->prepare("SELECT * FROM posts WHERE id = :id"); 
            $stmt->bindParam(":id",$id);
            $res = $stmt->execute();
        }
        catch (\PDOException $e) {
            // FIXME Error handling here.
            return null;
        }
        return $res;
    }

    public function update($id, $title, $body, $created_at, $modified_at, $author)
    {
        $pdo = $this->db->getConnection();
        try {
            $pdo->beginTransaction();
            $stmt = $pdo->prepare("UPDATE posts SET title = :title, body = :body, created_at = :created_at, modified_at = :modified_at, author = :author WHERE id = :id");
            $stmt->bindParam(":id",$id);
            $stmt->bindParam(":title",$title);
            $stmt->bindParam(":body",$body);
            $stmt->bindParam(":created_at",$created_at);
            $stmt->bindParam(":modified_at",$modified_at);
            $stmt->bindParam(":author",$author);
            $res = $stmt->execute();
            $pdo->commit();

            if ($res !== true) {
               return false;
            }
            $count = $stmt->rowCount();
            if($count === 0) {
                throw new NoSuchRecordException("No updates were made.");
            }
        }
        catch (\PDOException $e) {
            // FIXME Error handling here.
            $pdo->rollback();
            return false;
        }
        return true;
    }

    public function destroy($id)
    {
        $pdo = $this->db->getConnection();
        try {
            $pdo->beginTransaction();
            $stmt = $pdo->prepare("DELETE FROM posts WHERE id = :id"); 
            $stmt->bindParam(":id",$id);
            $res = $stmt->execute();
            if ($res !== true) {
               return false;
            }
            $count = $stmt->rowCount();
            if($count === 0) {
                throw new NoSuchRecordException("No deletions were made.");
            }
            $pdo->commit();
        }
        catch (\PDOException $e) {
            // FIXME Error handling here.
            $pdo->rollback();
            return false;
        }
        return true;
    }
}
