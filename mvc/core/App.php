<?php
class App
{
    //http:localhost/dacsan.travinh/Home/SomeThing/abc/a/b
    protected $page = ""; //Đại điện cho Home
    protected $action = ""; // Đại diện cho SomeThing
    protected $param = []; //Đại diện cho abc/a/b

    //Contructor khởi tạo
    function __construct()
    {
        //Lấy mảng URL
        //[0] ==> Home
        //[1] ==> SomeThing
        //[2] ==> abc
        //...
        // $arrayURL = $this->UrlProcess();

        $array = array();
        foreach ($_GET as $getParam => $value) {
            array_push($array, "$value");
        }
        // print_r($array);

        //Xử lý xem file Controller
        if (isset($_GET["add-to-cart"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        } else if (isset($_GET["tim-kiem"])) {
            require_once "./mvc/controllers/SanPham.php";
            $sp = new SanPham;
            call_user_func(array($sp, "tim_kiem"), $_GET["tim-kiem"]);
        } else if (!isset($_GET["page"])) {
            header("Location: index.php?page=Home&action=DashBoard");
        } else if (file_exists("./mvc/controllers/" . @$array[0] . ".php")) {
            $this->page = @$array[0];

            require_once "./mvc/controllers/" . $this->page . ".php";
            $this->page = new $this->page;

            if (method_exists($this->page, @$array[1])) {
                $this->action = @$array[1];
                unset($array[0]);
                unset($array[1]);

                $this->param = !empty($array) ? array_values($array) : [null];

                call_user_func_array([$this->page, $this->action], $this->param);
            } else {
                require_once "./mvc/views/Pages/page-not-found.php";
            }
        } else {
            require_once "./mvc/views/Pages/page-not-found.php";
        }
        //Hủy arrayURL[0]
        // unset($arrayURL[0]);

        // require_once "./mvc/controllers/" . $this->page . ".php";
        // $this->page = new $this->page;



        // //Xử lý Function(Action) của Controller
        // //Kiểm tra xem người dùng có nhập action hay không
        // if (isset($arrayURL[1])) {
        //     //Kiểm tra xem action (function) người dùng nhập vào có tồn tại hay không
        //     if (method_exists($this->controller, $arrayURL[1])) {
        //         $this->action = $arrayURL[1];
        //     }
        //     //Hủy arrayURL[1]
        //     unset($arrayURL[1]);
        // }

        // //Xử lý param
        // //Gán toàn bộ dữ liệu của mảng URL cho param
        // $this->param = $arrayURL ? array_values($arrayURL) : [];

        // //Gọi class có tên controller, hàm action, tham số param
        // // call_user_func_array([$this->controller, $this->action], $this->param)
        // if (empty($this->param)) {
        //     $this->param = [null];

        // }
        // call_user_func_array([$this->controller, $this->action], $this->param);
    }

    //Xử lý URL của người dùng nhập vào
    // function UrlProcess()
    // {
    //     if (isset($_GET["url"])) {
    //         //Cắt URL ra thành một mảng
    //         return explode("/", filter_var(trim($_GET["url"], "/")));
    //     }
    // }
}
