<?

include_once 'connection.php';
	
	class myclass
    {

        private $db;
        private $connection;

        function __construct()
        {
            $this->db = new DB_Connection();
            $this->connection = $this->db->getConnection();
        }


//dis
    public function dist_active(){

        $query= "Select * from dist_active where dist_a_id='1' ";
        $result = mysqli_query($this->connection, $query);
        $row=mysqli_fetch_array($result);

        return $row;
    }


    public function dist_pro_n1($a) {

        $query = "Select * from `dist` WHERE dist_cont='$a'";
        $result = mysqli_query($this->connection, $query);
        $arr=array();

        while ($row=mysqli_fetch_array($result)){

            $arr[]=$row;

        }

        return $arr;
    }

    public function dist_pro_n($a) {

        $query = "Select * from `dist` WHERE dist_country='$a'";
        $result = mysqli_query($this->connection, $query);
        $arr=array();

        while ($row=mysqli_fetch_array($result)){

            $arr[]=$row;

        }

        return array_unique($arr);
    }


    public function get_country2() {

        $query = "Select * from `apps_countries` ORDER BY country_name ASC ";
        $result = mysqli_query($this->connection, $query);
        $arr=array();

        while ($row=mysqli_fetch_array($result)){

            $arr[]=$row;

        }

        return $arr;
    }

//user

    public function add_user($a1,$a2,$a3,$a4,$a5,$a6){



        $query= ("INSERT INTO `user_s` (`user_name`, `user_company`,`user_mobile`, `user_email`, `user_pass`, `user_country`) VALUES ('$a1', '$a2','$a3', '$a4','$a5','$a6') ");
        $result = mysqli_query($this->connection, $query);

    }

    public function check_email($p1){

        $query= "Select * from user_s where user_email='$p1' ";
        $result = mysqli_query($this->connection, $query);
        $row=mysqli_fetch_array($result);

        return $row;
    }

    public function check_mobile($p2){

        $query= "Select * from user_s where user_mobile='$p2' ";
        $result = mysqli_query($this->connection, $query);
        $row=mysqli_fetch_array($result);

        return $row;
    }

    public function up_user1($p2,$p4){


        $query=("update user_s set user_mobile='$p2' where user_id='$p4'");
        $result = mysqli_query($this->connection, $query);
    }


    public function up_pass($p,$p2){


        $p=$this ->make_safe($p);

        $hash = hash('sha256', 'saleh'. hash('sha256', $p) );

        $query=("update user_s set user_pass='$hash' where user_id='$p2'");
        $result = mysqli_query($this->connection, $query);
    }


    public function get_account($u){


        $u=	$this ->make_safe($u);



        $query="select * from user_s where user_email='$u' ";

        $result = mysqli_query($this->connection, $query);

        $userData = mysqli_fetch_array($result);

        return $userData;



    }





    public function check_login($u,$p){



        $u=	$this ->make_safe($u);

        $p=	$this ->make_safe($p);





        $query="select * from user_s where user_email='$u' ";

        $result = mysqli_query($this->connection, $query);


        if (mysqli_num_rows($result)!=0) {



            $userData = mysqli_fetch_array($result);

            $hash = hash('sha256', 'saleh'. hash('sha256', $p) );



            if($hash != $userData['user_pass']){ return false;}else {

                return true;

            }

        }



        else {

            return false;

        }



    }


    function rand_str($length = 5, $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890')

    {

        // Length of character list

        $chars_length = (strlen($chars) - 1);



        // Start our string

        $string = $chars{rand(0, $chars_length)};



        // Generate random string

        for ($i = 1; $i < $length; $i = strlen($string))

        {

            // Grab a random character from our list

            $r = $chars{rand(0, $chars_length)};



            // Make sure the same two characters don't appear next to each other

            if ($r != $string{$i - 1}) $string .=  $r;

        }



        // Return the string

        return $string;

    }





    function tokenTruncate($string, $your_desired_width) {

        $parts = preg_split('/([\s\n\r]+)/', $string, null, PREG_SPLIT_DELIM_CAPTURE);

        $parts_count = count($parts);



        $length = 0;

        $last_part = 0;

        for (; $last_part < $parts_count; ++$last_part) {

            $length += strlen($parts[$last_part]);

            if ($length > $your_desired_width) { break; }

        }



        return implode(array_slice($parts, 0, $last_part));

    }




    public function createSalt()

    {

        $string = md5(uniqid(rand(), true));

        return substr($string, 0, 3);

    }





    function strip_html_tags( $text )

    {

        $text = preg_replace(

            array(

                // Remove invisible content

                '@<head[^>]*?>.*?</head>@siu',

                '@<style[^>]*?>.*?</style>@siu',

                '@<script[^>]*?.*?</script>@siu',

                '@<object[^>]*?.*?</object>@siu',

                '@<embed[^>]*?.*?</embed>@siu',

                '@<applet[^>]*?.*?</applet>@siu',

                '@<noframes[^>]*?.*?</noframes>@siu',

                '@<noscript[^>]*?.*?</noscript>@siu',

                '@<noembed[^>]*?.*?</noembed>@siu'

            ),

            array(

                '', '', '', '', '', '', '', '', ''), $text );



        return strip_tags( $text);

    }





    function make_safe($variable) {

        $variable = $this->strip_html_tags($variable);

        $variable = mysqli_real_escape_string($this->connection,trim($variable));

        $variable =htmlspecialchars($variable);

        return $variable;

    }






//product

    public function pro_s($a) {

        $query = "Select * from `product_add` WHERE product_model LIKE '%$a%' OR product_title LIKE '%$a%' OR upc_number LIKE '%$a%'  ORDER BY product_id DESC ";
        $result = mysqli_query($this->connection, $query);
        $arr=array();

        while ($row=mysqli_fetch_array($result)){

            $arr[]=$row;

        }

        return $arr;
    }

    public function get_pro_account2($a) {

        $query = "Select * from `product_add` WHERE product_model= '$a' ORDER BY product_title ASC  ";
        $result = mysqli_query($this->connection, $query);
        $arr=array();

        while ($row=mysqli_fetch_array($result)){

            $arr[]=$row;

        }

        return $arr;
    }

    public function get_pro_account() {

        $query = "Select * from `product_add` ORDER BY product_title ASC   ";
        $result = mysqli_query($this->connection, $query);
        $arr=array();

        while ($row=mysqli_fetch_array($result)){

            $arr[]=$row;

        }

        return $arr;
    }
    public function get_pro_coming($a,$b,$c) {

        $query = "Select * from `product_add` where pro_coming='1' ORDER BY product_title $b limit $a,$c ";
        $result = mysqli_query($this->connection, $query);
        $arr=array();

        while ($row=mysqli_fetch_array($result)){

            $arr[]=$row;

        }

        return $arr;
    }
    public function get_pro_n_s($a,$b,$c) {

        $query = "Select * from `product_add` where `product_s`='1' AND  pro_coming='0' ORDER BY product_title $b limit $a,$c ";
        $result = mysqli_query($this->connection, $query);
        $arr=array();

        while ($row=mysqli_fetch_array($result)){

            $arr[]=$row;

        }

        return $arr;
    }

    public function get_pro_n($a,$b,$c) {

        $query = "Select * from `product_add` ORDER BY product_title $b limit $a,$c ";
        $result = mysqli_query($this->connection, $query);
        $arr=array();

        while ($row=mysqli_fetch_array($result)){

            $arr[]=$row;

        }

        return $arr;
    }

    public function get_pro_c($a,$b,$d,$c) {

        $query = "Select * from `product_add` WHERE product_cat='$b' ORDER BY product_title $d limit $a,$c ";
        $result = mysqli_query($this->connection, $query);
        $arr=array();

        while ($row=mysqli_fetch_array($result)){

            $arr[]=$row;

        }

        return $arr;
    }
    public function get_pro_all($a,$d) {

        $query = "Select * from `product_add` WHERE product_cat='19' or product_cat='20' or product_cat='21' or product_cat='22' or product_cat='23'  ORDER BY product_title $d limit $a,9 ";
        $result = mysqli_query($this->connection, $query);
        $arr=array();

        while ($row=mysqli_fetch_array($result)){

            $arr[]=$row;

        }

        return $arr;
    }
    public function get_p_all($a) {

        $query = "Select * from `product_add` WHERE product_cat='$a' and pro_coming='0' ORDER BY product_id DESC limit 1 ";
        $result = mysqli_query($this->connection, $query);
        $row = mysqli_fetch_array($result);
        return $row;
    }

    public  function  count_pro_c2() {
        $query = "SELECT COUNT(*) AS numberOfRows FROM product_add WHERE product_cat='19' or product_cat='20' or product_cat='21' or product_cat='22' or product_cat='23'";
        $result = mysqli_query($this->connection, $query);
        $row = mysqli_fetch_array($result);
        return $row;

    }

    public  function  count_pro_c($a) {
        $query = "SELECT COUNT(*) AS numberOfRows FROM product_add WHERE product_cat='$a'";
        $result = mysqli_query($this->connection, $query);
        $row = mysqli_fetch_array($result);
        return $row;

    }

    public  function  count_pro() {
        $query = "SELECT COUNT(*) AS numberOfRows FROM product_add ";
        $result = mysqli_query($this->connection, $query);
        $row = mysqli_fetch_array($result);
        return $row;

    }
    public  function  count_pro_coming() {
        $query = "SELECT COUNT(*) AS numberOfRows FROM product_add where `pro_coming`='1' ";
        $result = mysqli_query($this->connection, $query);
        $row = mysqli_fetch_array($result);
        return $row;

    }
	
    public  function  count_pro_s() {
        $query = "SELECT COUNT(*) AS numberOfRows FROM product_add where `product_s`='1' ";
        $result = mysqli_query($this->connection, $query);
        $row = mysqli_fetch_array($result);
        return $row;

    }

    public function get_pro() {

        $query = "Select * from `product_add` WHERE pro_last_pro='1' ORDER BY product_id DESC limit 10 ";
        $result = mysqli_query($this->connection, $query);
        $arr=array();

        while ($row=mysqli_fetch_array($result)){

            $arr[]=$row;

        }

        return $arr;
    }

    public function get_pro_b($p1){

        $query= "Select * from product_add where product_id='$p1' ";
        $result = mysqli_query($this->connection, $query);
        $row=mysqli_fetch_array($result);

        return $row;

    }
    public function get_link($p1){

        $query= "Select * from info_page where info_id='$p1' ";
        $result = mysqli_query($this->connection, $query);
        $row=mysqli_fetch_array($result);

        return $row;

    }
	    public function get_model_name($p1){

        $query= "Select * from product_add where product_model='$p1' ";
        $result = mysqli_query($this->connection, $query);
        $row=mysqli_fetch_array($result);

        return $row;

    }

    public function pro_img($a) {

        $query = "Select * from `product_img` where img_pro_id='$a' ORDER BY img_id DESC  ";
        $result = mysqli_query($this->connection, $query);
        $arr=array();

        while ($row=mysqli_fetch_array($result)){

            $arr[]=$row;

        }

        return $arr;
    }
    public function pro_file($a) {

        $query = "Select * from `product_zip` where zip_pro_id='$a' ORDER BY zip_id DESC  ";
        $result = mysqli_query($this->connection, $query);
        $arr=array();

        while ($row=mysqli_fetch_array($result)){

            $arr[]=$row;

        }

        return $arr;
    }
	public function pro_file2($a) {

        $query = "Select * from `product_zip2` where zip_pro_id='$a' ORDER BY zip_id DESC  ";
        $result = mysqli_query($this->connection, $query);
        $arr=array();

        while ($row=mysqli_fetch_array($result)){

            $arr[]=$row;

        }

        return $arr;
    }

	    public function pro_soft($a) {

        $query = "Select * from `product_soft` where zip_pro_id='$a' ORDER BY zip_id DESC  ";
        $result = mysqli_query($this->connection, $query);
        $arr=array();

        while ($row=mysqli_fetch_array($result)){

            $arr[]=$row;

        }

        return $arr;
    }
    public function pro_soft_all($a) {

        $query = "Select * from `product_soft`  ORDER BY zip_pro_id ASC limit $a,20 ";
        $result = mysqli_query($this->connection, $query);
        $arr=array();

        while ($row=mysqli_fetch_array($result)){

            $arr[]=$row;

        }

        return $arr;
    }
    public  function  count_soft() {
        $query = "SELECT COUNT(*) AS numberOfRows FROM product_soft ";
        $result = mysqli_query($this->connection, $query);
        $row = mysqli_fetch_array($result);
        return $row;

    }

//news
    public  function  count_news() {
        $query = "SELECT COUNT(*) AS numberOfRows FROM web_news ";
        $result = mysqli_query($this->connection, $query);
        $row = mysqli_fetch_array($result);
        return $row;

    }
    public function get_news1($a) {

        $query = "Select * from `web_news` ORDER BY p_id DESC LIMIT  $a,5 ";
        $result = mysqli_query($this->connection, $query);
        $arr=array();

        while ($row=mysqli_fetch_array($result)){

            $arr[]=$row;

        }

        return $arr;
    }

    public function news_a($p1)
    {

        $query = "Select * from web_news where p_id='$p1' ";
        $result = mysqli_query($this->connection, $query);
        $row = mysqli_fetch_array($result);

        return $row;


    }
    public function user_a($p1)
    {

        $query = "Select * from user_s where user_email='$p1' ";
        $result = mysqli_query($this->connection, $query);
        $row = mysqli_fetch_array($result);

        return $row;


    }

    public function page_a($p1)
    {

        $query = "Select * from pages where page_id='$p1' ";
        $result = mysqli_query($this->connection, $query);
        $row = mysqli_fetch_array($result);

        return $row;


    }

    public function get_news() {

        $query = "Select * from `web_news` ORDER BY p_id DESC LIMIT 2 ";
        $result = mysqli_query($this->connection, $query);
        $arr=array();

        while ($row=mysqli_fetch_array($result)){

            $arr[]=$row;

        }

        return $arr;
    }
    //reg.pro
    public function add_war($a1,$a2,$a3,$a4,$a5,$a6,$a7,$a8,$a9,$a10,$a11,$a12){

        $query= ("INSERT INTO `warranty_info` (`war_prod`, `war_model`, `war_name`, `war_uid`,`war_serial`, `war_country`, `war_address1`,`war_address2`, `war_file`, `war_purchase`,`war_submit`, `war_status`) VALUES ('$a1', '$a2','$a3', '$a4','$a5', '$a6','$a7', '$a8','$a9', '$a10','$a11','$a12') ");
        $result = mysqli_query($this->connection, $query);

    }
    public function get_war($a) {

        $query = "Select * from `warranty_info` WHERE war_uid='$a' ORDER BY war_id DESC  ";
        $result = mysqli_query($this->connection, $query);
        $arr=array();

        while ($row=mysqli_fetch_array($result)){

            $arr[]=$row;

        }

        return $arr;
    }





//adv


    public function get_adv() {

        $query = "SELECT * FROM `adv_img` WHERE `adv_active`=1 ORDER BY adv_id ASC  ";
        $result = mysqli_query($this->connection, $query);
        $arr=array();

        while ($row=mysqli_fetch_array($result)){

            $arr[]=$row;

        }

        return $arr;
    }
//slider
    public function get_slider() {

        $query = "Select * from `slider_img` WHERE `slider_active`=1 ORDER BY slider_number ASC  ";
        $result = mysqli_query($this->connection, $query);
        $arr=array();

        while ($row=mysqli_fetch_array($result)){

            $arr[]=$row;

        }

        return $arr;
    }
//catalog

    public function get_catalog() {

        $query = "Select * from `catalog1` ORDER BY catlog_year ASC";
        $result = mysqli_query($this->connection, $query);
        $arr=array();

        while ($row=mysqli_fetch_array($result)){

            $arr[]=$row;

        }

        return $arr;
    }


//cat//
    public function get_cat_sub($a) {

        $query = "Select * from `cat_product` WHERE cat_main='$a' ORDER BY cat_name ASC";
        $result = mysqli_query($this->connection, $query);
        $arr=array();

        while ($row=mysqli_fetch_array($result)){

            $arr[]=$row;

        }

        return $arr;
    }

    public function get_menu_tree2($parent_id)
    {
        $menu = "";
        $query =("Select * from cat_product where cat_main='" .$parent_id . "' ORDER BY cat_name ASC ");
        $result = mysqli_query($this->connection, $query);
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
        {
            if($_GET['cat']==$row['cat_id']) {
                $ac = "active";
            }else{$ac = "";}
            $menu .="<li ><a  href='categories.php?cat=".$row['cat_id']."' class=\"d_block f_size_large color_dark relative $ac\">".$row['cat_name']."<span  class=\"bg_light_color_1 r_corners f_right color_dark talign_c\"></a>";

            if($row['has_sub']==0){echo"";}else{ $menu .= "<ul>".$this->get_menu_tree2($row['cat_id'])."</ul>";}; //call  recursively

            $menu .= "</li>";

        }

        return $menu;
    }
    public function get_menu_tree3($parent_id)
    {
        $menu = "";
        $query =("Select * from cat_product where cat_main='" .$parent_id . "' ORDER BY cat_name ASC ");
        $result = mysqli_query($this->connection, $query);
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
        {

            $menu .="<li><a href='../categories.php?cat=".$row['cat_id']."'>".$row['cat_name']."</a>";

            if($row['has_sub']==0){echo"";}else{ $menu .= "<ul>".$this->get_menu_tree3($row['cat_id'])."</ul>";}; //call  recursively

            $menu .= "</li>";

        }

        return $menu;
    }

    public function get_menu_tree($parent_id)
    {
        $menu = "";
        $query =("Select * from cat_product where cat_main='" .$parent_id . "' ORDER BY cat_name ASC ");
        $result = mysqli_query($this->connection, $query);
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
        {

            $menu .="<li><a href='categories.php?cat=".$row['cat_id']."'>".$row['cat_name']."</a>";

            if($row['has_sub']==0){echo"";}else{ $menu .= "<ul>".$this->get_menu_tree($row['cat_id'])."</ul>";}; //call  recursively

            $menu .= "</li>";

        }

        return $menu;
    }

    public function cat_a($p1)
    {

        $query = "Select * from cat_product where cat_id='$p1' ";
        $result = mysqli_query($this->connection, $query);
        $row = mysqli_fetch_array($result);

        return $row;


    }



}


?>