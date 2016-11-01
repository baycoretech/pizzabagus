<?php
/**
 * Class Blog Comments
 *
 * @author baycore
 */

class Blog_Comments {
    private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function view_total_comments($id_link) {
        $result = $this->pdo->query("SELECT * FROM cr_comment, cr_blog WHERE cr_comment.cr_blogID = cr_blog.cr_blogID AND (cr_comment.cr_commentStatus = '2' OR cr_comment.cr_commentStatus = '3') AND cr_blog.cr_blogLink = '$id_link'");
        $total  = $result->rowCount();
        return $total;
    }
    public function view_comments($id_link) {
        $result    = $this->pdo->query("SELECT * FROM cr_blog, cr_comment WHERE cr_blog.cr_blogLink = '$id_link' AND cr_blog.cr_blogID = cr_comment.cr_blogID AND cr_comment.cr_commentStatus = '2' ORDER BY cr_comment.cr_commentDate asc");
        if($result->rowCount()<1) {
            $alert = 0;
            return $alert;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
        }
    }
    public function view_comments_reply($blog_id, $comment_id) {
        $result  = $this->pdo->query("SELECT * FROM cr_comment WHERE cr_blogID = '$blog_id' AND cr_commentReply = '$comment_id' AND cr_commentStatus = '3' ORDER BY cr_commentDate asc");
        if($result->rowCount() < 1){
            return false;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[]=$rows;
            return $data;
        }
    }
    public function view_reply($reply_id) {
        $result = $this->pdo->query("SELECT * FROM cr_comment WHERE cr_commentID = '$reply_id'");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function get_admin_data($admin_id) {
        $result  = $this->pdo->query("SELECT * FROM cr_admin WHERE cr_adminID = '$admin_id' LIMIT 1");
        $rows    = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function send_comment($comment_name, $comment_email, $comment_website, $comment_message, $blog_id, $now_date) {
        $status = "1";
        $reply  = "0";
        $result = $this->pdo->prepare("INSERT INTO cr_comment(
                        cr_commentName, cr_commentEmail, cr_commentWebsite, cr_commentContent, cr_commentDate, cr_commentStatus, cr_commentReply, cr_blogID) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $result->bindParam(1, $comment_name);
        $result->bindParam(2, $comment_email);
        $result->bindParam(3, $comment_website);
        $result->bindParam(4, nl2br($comment_message));
        $result->bindParam(5, $now_date);
        $result->bindParam(6, $status);
        $result->bindParam(7, $reply);
        $result->bindParam(8, $blog_id);
        $result->execute();
    }
    public function get_blog_menu($blog_id) {
        $result = $this->pdo->query("SELECT * FROM cr_blog, cr_blogcategory, cr_menu WHERE cr_blog.cr_blogcategoryID = cr_blogcategory.cr_blogcategoryID AND cr_blogcategory.cr_blogcategoryLink  =cr_menu.cr_menuLink AND cr_blog.cr_blogID = '$blog_id'");
        if($result->rowCount()<1) {
            $result2  = $this->pdo->query("SELECT * FROM cr_blog, cr_blogcategory, cr_submenu WHERE cr_blog.cr_blogcategoryID = cr_blogcategory.cr_blogcategoryID AND cr_blogcategory.cr_blogcategoryLink = cr_submenu.cr_submenuLink AND cr_blog.cr_blogID = '$blog_id'");
            $rows2    = $result2->fetch(PDO::FETCH_OBJ);
            return $rows2->cr_submenuLink;
        }
        else {
            $rows = $result->fetch(PDO::FETCH_OBJ);
            return $rows->cr_menuLink;
        }
    }
}
?>