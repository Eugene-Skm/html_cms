<?php
class file_io {
    private $fp;
    private $tmpfp;

    function __construct( $fpath ) {
        if ( !file_exists( $fpath ) ) {
            $this->tmpfp = "./tmp/" . basename( $fpath );
        } else {
            $this->tmpfp = $fpath;
        }
        return $this->tmpfp;
    }

    function tmpcopy() {
        $original_fp = $this->tmpfp;

        $pathData = pathinfo( $this->tmpfp );
        $this->tmpfp = $pathData[ "dirname" ] . "/tmp_" . basename( $this->tmpfp );
        $flg = copy( $original_fp, $this->tmpfp );
        return $flg;
    }

    function replace( $newpath ) {
        $flg = rename( $this->tmpfp, $newpath );
        return $flg;
    }

    function delete() {
        $flg = unlink( $this->tmpfp );
        return $flg;
    }

    function dl(){
        // ファイルのパス
        //$filepath = 'bigimg.jpg';
        
        // リネーム後のファイル名
       // $filename = 'ダウンロード.jpg';
        
        // ファイルタイプを指定
        header('Content-Type: application/force-download');
        
        // ファイルサイズを取得し、ダウンロードの進捗を表示
        header('Content-Length: '.filesize($this->tmpfp));
        
        // ファイルのダウンロード、リネームを指示
        //header('Content-Disposition: attachment;');
        //header('Content-Disposition: attachment; filename="'.$filename.'"');
        
        // ファイルを読み込みダウンロードを実行
        $flg= readfile($this->tmpfp);

        return $flg;
    }
    function write_content( $contents ) {
        $contents = mb_convert_encoding( $contents, "UTF-8" );
        $filename = $this->tmpfp;

        $handle = fopen( $filename, 'w' );
        fwrite( $handle, $contents );
        fclose( $handle );
    }

    function getcontent() {
        $filename = $this->tmpfp;
        $fp = fopen( $filename, "r" );
        $data = fread( $fp, filesize( $filename ) );
        fclose( $fp );

        return $data;
    }

    function write_csv( array $content ) {
        $fp = fopen( $this->tmpfp, 'w' );

        foreach ( $content as $value ) {
            fputcsv( $fp, $value );
        }
        fclose( $fp );
    }

    function get_csv() {
        $fp = fopen( $this->tmpfp, 'r' );
        $array_data = [];
        while ( $data = fgetcsv( $fp ) ) {
            array_push( $array_data, $data );
        }
        fclose( $fp );

        return $array_data;
    }
    
/*------------file_ioクラス専属　関連アルゴリズム------------*/

    function merge( array $filelist ) {
        $data = "";
        $outpath = $this->tmpfp;
        foreach ( $filelist as $file ) {
            $filedata = file_get_contents( $file );
            $data .= $filedata;
        }
        $flg = file_put_contents( $outpath, $data );
        return $flg;
    }

    function get_type_of_folder_path( $type ) {
        $csv = $this->get_csv();
        $paths = array_filter(
            $csv,
            function ( $val )use( $type ) {
                return $val[ 0 ] == $type;
            }
        );
        $returnpath = [];
        foreach ( $paths as $v ) {
            array_push( $returnpath, $v[ 1 ] );
        }
        return $returnpath;
    }

    function get_type_of_file_path( $file_type ) {
        $ps = $this->get_type_of_folder_path( $file_type );

        $fPathes = [];
        foreach ( $ps as $p ) {
            $paths = glob( $p . "*" );
            $fPathes = array_merge( $fPathes, $paths );
        }
        sort($fPathes, SORT_STRING);
        return array_filter( $fPathes, 'is_file' );
    }
}

?>