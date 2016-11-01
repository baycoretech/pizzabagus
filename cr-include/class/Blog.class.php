<?php
/**
 * Class Blog
 *
 * @author baycore
 */

class Blog {
    private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function view_blog_type() {
        $result = $this->pdo->query("SELECT * FROM cr_blogtype ORDER BY cr_blogtypeID asc");
        while($rows = $result->fetch(PDO::FETCH_OBJ))
            $data[] = $rows;
        return $data;
    }
    public function get_total_blog($page_link) {
        $result = $this->pdo->query("SELECT * FROM cr_blog, cr_blogcategory, cr_blogtype, cr_admin WHERE cr_blog.cr_blogcategoryID = cr_blogcategory.cr_blogcategoryID AND cr_blogcategory.cr_blogcategoryLink = '$page_link' AND cr_blog.cr_blogtypeID = cr_blogtype.cr_blogtypeID AND cr_blog.cr_blogStatus = 'publish' AND cr_blog.cr_adminID = cr_admin.cr_adminID ORDER BY cr_blog.cr_blogID desc");
        $total  = $result->rowCount();
        return $total;
    }
    public function view_blog($page_link, $start, $records_per_page) {
        $result = $this->pdo->query("SELECT * FROM cr_blog, cr_blogcategory, cr_blogtype, cr_admin WHERE cr_blog.cr_blogcategoryID = cr_blogcategory.cr_blogcategoryID AND cr_blogcategory.cr_blogcategoryLink = '$page_link' AND cr_blog.cr_blogtypeID = cr_blogtype.cr_blogtypeID AND cr_blog.cr_blogStatus = 'publish' AND cr_blog.cr_adminID = cr_admin.cr_adminID ORDER BY cr_blog.cr_blogID desc LIMIT $start, $records_per_page");
        if($result->rowCount()<1) {
            return false;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
        }
    }
    public function view_blog_tag($start, $records_per_page, $tag_name) {
        $result = $this->pdo->query("SELECT * FROM cr_blog, cr_blogcategory, cr_blogtype, cr_admin WHERE cr_blog.cr_blogcategoryID = cr_blogcategory.cr_blogcategoryID AND cr_blog.cr_blogtypeID = cr_blogtype.cr_blogtypeID AND cr_blog.cr_blogStatus = 'publish' AND cr_blog.cr_adminID = cr_admin.cr_adminID AND MATCH (cr_blog.cr_blogTags) AGAINST ('$tag_name' IN BOOLEAN MODE) ORDER BY cr_blog.cr_blogID desc LIMIT $start, $records_per_page");
        if($result->rowCount()<1) {
            return false;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
        }
    }
    public function get_total_blog_tag($tag_name) {
        $result = $this->pdo->query("SELECT * FROM cr_blog, cr_blogcategory, cr_blogtype, cr_admin WHERE cr_blog.cr_blogcategoryID = cr_blogcategory.cr_blogcategoryID AND cr_blog.cr_blogtypeID = cr_blogtype.cr_blogtypeID AND cr_blog.cr_blogStatus = 'publish' AND cr_blog.cr_adminID = cr_admin.cr_adminID AND MATCH (cr_blog.cr_blogTags) AGAINST ('$tag_name' IN BOOLEAN MODE)");
        $total  = $result->rowCount();
        return $total;
    }
    public function view_blog_in_category($page_link, $ex_link) {
        $result = $this->pdo->query("SELECT * FROM cr_blog, cr_blogcategory, cr_blogtype, cr_admin WHERE cr_blog.cr_blogcategoryID = cr_blogcategory.cr_blogcategoryID AND cr_blogcategory.cr_blogcategoryLink = '$page_link' AND cr_blogcategory.cr_blogcategorySlug = '$ex_link' AND cr_blog.cr_blogtypeID = cr_blogtype.cr_blogtypeID AND cr_blog.cr_blogStatus = 'publish' AND cr_blog.cr_adminID = cr_admin.cr_adminID ORDER BY cr_blog.cr_blogID desc");
        if($result->rowCount()<1) {
            return false;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
        }
    }
    public function view_blog_detail($id_link) {
        $result = $this->pdo->query("SELECT * FROM  cr_blog, cr_blogcategory, cr_blogtype, cr_admin WHERE cr_blog.cr_blogcategoryID = cr_blogcategory.cr_blogcategoryID AND cr_blog.cr_blogtypeID = cr_blogtype.cr_blogtypeID AND cr_blog.cr_blogLink = '$id_link' AND cr_blog.cr_adminID = cr_admin.cr_adminID");
        if($result->rowCount()<1) {
            return false;
        }
        else {
            $rows = $result->fetch(PDO::FETCH_OBJ);
            return $rows;
        }
    }
    public function get_category_name($ex_link) {
        $result = $this->pdo->query("SELECT * FROM cr_blogcategory WHERE cr_blogcategorySlug='$ex_link'");
        $rows = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_related_post($blog_title, $blog_category_id, $blog_link) {
        $result = $this->pdo->query("SELECT *, MATCH(cr_blogTitle, cr_blogContent) AGAINST('$blog_title' IN BOOLEAN MODE) AS relatedpost FROM cr_blog WHERE MATCH(cr_blogTitle, cr_blogContent) AGAINST('$blog_title' IN BOOLEAN MODE) AND cr_blogcategoryID = '$blog_category_id' AND cr_blogStatus = 'publish' AND cr_blogLink <> '$blog_link' ORDER BY relatedpost DESC LIMIT 6");
        if($result->rowCount()<1) {
            return false;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
        }

    }
    public function view_related_post_category($blog_category_id) {
        $result = $this->pdo->query("SELECT * FROM cr_blogcategory WHERE cr_blogcategoryID = '$blog_category_id'");
        $rows = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_related_post_type($blog_type_id) {
        $result = $this->pdo->query("SELECT * FROM cr_blogtype, cr_blog WHERE cr_blog.cr_blogtypeID = '$blog_type_id' AND cr_blogtype.cr_blogtypeID = cr_blog.cr_blogtypeID");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_blog_visitor($blog_id) {
        $result = $this->pdo->query("SELECT * FROM cr_blogvisitor WHERE cr_blogID = '$blog_id'");
        $total  = $result->rowCount();
        return $total;
    }
    public function view_blog_likes($blog_id) {
        $result = $this->pdo->query("SELECT * FROM cr_blog, cr_bloglikes WHERE cr_blog.cr_blogID = cr_bloglikes.cr_blogID AND cr_blog.cr_blogLink = '$blog_id'");
        $total  = $result->rowCount();
        return $total;
    }
    public function check_ip_likes($blog_id, $ip) {
        $result = $this->pdo->query("SELECT * FROM cr_bloglikes WHERE cr_blogID='$blog_id' AND cr_bloglikesIP = '$ip' LIMIT 1");
        $total  = $result->rowCount();
        return $total;
    }
    public function count_comments($blog_id) {
        $result = $this->pdo->query("SELECT * FROM cr_comment WHERE cr_blogID = '$blog_id' AND (cr_commentStatus = '2' OR cr_commentStatus = '3')");
        $total  = $result->rowCount();
        return $total;
    }
    public function count_likes($blog_id) {
        $result = $this->pdo->query("SELECT * FROM cr_bloglikes WHERE cr_blogID = '$blog_id'");
        $total  = $result->rowCount();
        return $total;
    }
    public function count_likes_front($blog_name) {
        $result = $this->pdo->query("SELECT * FROM cr_bloglikes, cr_blog WHERE cr_bloglikes.cr_blogID = cr_blog.cr_blogID AND cr_blog.cr_blogLink = '$blog_name'");
        $total  = $result->rowCount();
        return $total;
    }
    public function get_ip_likes($blog_name, $visitor_ip) {
        $result = $this->pdo->query("SELECT * FROM cr_bloglikes, cr_blog WHERE cr_bloglikes.cr_blogID = cr_blog.cr_blogID AND cr_blog.cr_blogLink = '$blog_name' AND cr_bloglikes.cr_bloglikesIP = '$visitor_ip'");
        $total  = $result->rowCount();
        return $total;
    }
    public function add_likes($blog_id, $ip, $now_date) {
        $result = $this->pdo->query("INSERT INTO cr_bloglikes (cr_bloglikesIP, cr_bloglikesDate, cr_blogID) VALUES ('$ip', '$now_date', '$blog_id')");
    }
    public function view_popular_blog() {
        $result = $this->pdo->query("SELECT cr_blog.cr_blogID, cr_blog.cr_blogTitle, cr_blog.cr_blogLink, cr_blog.cr_blogContent, cr_blog.cr_blogPostdate, cr_blog.cr_blogFeatured, cr_blog.cr_blogStatus, cr_blog.cr_blogtypeID, cr_blog.cr_blogcategoryID, COUNT(*) FROM cr_blog INNER JOIN cr_bloglikes ON cr_blog.cr_blogID = cr_bloglikes.cr_blogID WHERE cr_blog.cr_blogStatus = 'publish' GROUP BY cr_blog.cr_blogID ORDER BY count(*) desc LIMIT 10");
        if($result->rowCount()<1) {
            return false;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
        }
    }
    public function view_popular_blog_category($blog_id) {
        $result = $this->pdo->query("SELECT * FROM cr_blog, cr_blogcategory WHERE cr_blog.cr_blogID = '$blog_id' AND cr_blog.cr_blogcategoryID = cr_blogcategory.cr_blogcategoryID");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_popular_blog_user($blog_id) {
        $result = $this->pdo->query("SELECT * FROM cr_blog, cr_admin WHERE cr_blog.cr_blogID = '$blog_id' AND cr_blog.cr_adminID = cr_admin.cr_adminID");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_popular_blog_like($blog_id) {
        $result = $this->pdo->query("SELECT * FROM cr_blog, cr_bloglikes WHERE cr_blog.cr_blogID = '$blog_id' AND cr_blog.cr_blogID = cr_bloglikes.cr_blogID");
        $total  = $result->rowCount();
        return $total;
    }
    public function check_blog_type($blog_id) {
        $result = $this->pdo->query("SELECT * FROM cr_blog, cr_blogtype WHERE cr_blog.cr_blogID = '$blog_id' AND cr_blog.cr_blogtypeID = cr_blogtype.cr_blogtypeID");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_blog_random() {
        $result = $this->pdo->query("SELECT * FROM cr_blog, cr_blogcategory, cr_blogtype WHERE cr_blog.cr_blogStatus = 'publish' AND cr_blog.cr_blogcategoryID = cr_blogcategory.cr_blogcategoryID AND cr_blog.cr_blogtypeID = cr_blogtype.cr_blogtypeID ORDER BY RAND() LIMIT 6");
        if($result->rowCount()<1) {
            return false;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
        }
    }
    public function count_blog_random() {
        $result = $this->pdo->query("SELECT * FROM cr_blog WHERE cr_blogStatus = 'publish' ORDER BY RAND() LIMIT 6");
        $total  = $result->rowCount();
        return $total;
    }
    public function view_recent_blog() {
        $result = $this->pdo->query("SELECT * FROM  cr_blog, cr_blogcategory, cr_blogtype, cr_admin WHERE cr_blog.cr_blogcategoryID = cr_blogcategory.cr_blogcategoryID AND cr_blog.cr_blogtypeID = cr_blogtype.cr_blogtypeID AND cr_blog.cr_blogStatus = 'publish' AND cr_admin.cr_adminID = cr_blog.cr_adminID ORDER BY cr_blog.cr_blogDate desc LIMIT 3");
        if($result->rowCount()<1) {
            return false;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
        }
    }
    public function all_blog_tags() {
        $result  = $this->pdo->query("SELECT * FROM cr_blogtags ORDER BY RAND()");
        if($result->rowCount() < 1){
            return false;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
        }
    }
    public function save_blog_visitor($ip, $bid, $now_date) {
        $check_ip  = $this->pdo->query("SELECT * FROM cr_blogvisitor WHERE cr_blogvisitorIP = '$ip' AND cr_blogID='$bid'");
        $insert_ip = $this->pdo->prepare("INSERT INTO cr_blogvisitor (cr_blogvisitorIP, cr_blogvisitorDate, cr_blogID) VALUES (?, ?, ?)");
        $insert_ip->bindParam(1, $ip);
        $insert_ip->bindParam(2, $now_date);
        $insert_ip->bindParam(3, $bid);
        if($check_ip->rowCount() == 0) {
            $insert_ip->execute();
        }
    }
}
?>