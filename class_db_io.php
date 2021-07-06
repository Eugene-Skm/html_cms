<?php
/*
 * require_once('./Controller/Connect.php');
 * $select = new SelectData();
 *
 * $connect= new connect();
 * $sql="INSERT INTO `svg_info`(`fname`, `css`, `js`) VALUES (:fname,:css,:js) ";
 * $connect->plural($sql, $fname, false, false);
 *
 * https://cbc-study.com/training/advanced/class1
 * https://qiita.com/BRS_matsuoka/items/ebcc8ab655bb373e36c7
 */
class connect {
    //定数の宣言
    const DB_NAME = 'svguser';
    const HOST = 'localhost';
    const UTF = 'utf8';
    const USER = 'root';
    const PASS = '';
    //データベースに接続する関数
    function pdo() {
        $dsn = "mysql:dbname=" . self::DB_NAME . ";host=" . self::HOST . ";charset=" . self::UTF;
        $user = self::USER;
        $pass = self::PASS;
        try {
            $pdo = new PDO( $dsn, $user, $pass, array( PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ' . SELF::UTF ) );
        } catch ( Exception $e ) {
            echo 'error' . $e->getMesseage;
            die();
        }
        //エラーを表示してくれる。
        $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
        return $pdo;
    }
    //SELECT文用。
    //汎用
    function select( $sql ) {
        $hoge = $this->pdo();
        $stmt = $hoge->query( $sql );
        $items = $stmt->fetchAll( PDO::FETCH_ASSOC );
        return $items;
    }
    //特化
    function select_listsvg() {
        $sql="SELECT * FROM `svg_info`";
        return $this->select($sql);        
    }
    //以下SELECT,INSERT,UPDATE,DELETE文
    function inset_svg( $fname, $css, $js ) {
        $sql = "INSERT INTO `svg_info`(`fname`, `css`, `js`) VALUES (:fname,:css,:js) ";
        $hoge = $this->pdo();
        $stmt = $hoge->prepare( $sql );
        $stmt->execute( array( ':fname' => $fname, ':css' => $css, ':js' => $js ) );
        return $stmt;
    }
}

?>