<?php

namespace src;

/**
 * Created by PhpStorm.
 * User: w8
 * Date: 28.2.2019
 * Time: 20:31
 */
class FunctionClass
{

//    function __construct($a)
//    {
//        print_r($_ENV['islem']);
//    }


    function yeniKlasor($yol, $dosyaisim)
    {
        $dosyaisim = $this->toString($dosyaisim);
        $sayi = "";
        do {
            $durum = file_exists($yol . $dosyaisim . $sayi);

            if ($durum) {
                $sayi++;
            }
        } while ($durum);
        mkdir($yol . $dosyaisim . $sayi, '0655');
        header("location:$dosyaisim$sayi");
    }


    function yeniDosya($yol, $dosyaisim)
    {
        $dosyaisim = $this->toString($dosyaisim);
        $uzanti = $this->ext($dosyaisim);
        if (empty($uzanti)) {
            header("location:./");
        }
        $dosyaisim = explode(".", explode($uzanti, $dosyaisim)[0]);

        $sayi = "";

        do {
            $durum = file_exists($yol . $dosyaisim[0] . $sayi . "." . $uzanti);
            if ($durum) {
                $sayi++;
            }
        } while ($durum);
        touch("$yol$dosyaisim[0]$sayi.$uzanti");
        header("location:./");
    }

    function sil($yol, $dosyaisim)
    {
        $dosyaisim = $this->toString($dosyaisim);

        if (in_array($dosyaisim, $config['DONT_REMOVES'])) {
            echo "aaaaaaaaaa";
        } else {

            if (is_dir($yol . $dosyaisim)) {
                $this->delete_directory($yol . $dosyaisim);
            } else {
                echo "un";
                unlink($yol . $dosyaisim);
            }
        }
        header("location:./");
    }

    function duzenle($yol, $dosyaisim, $eskidosyaisim)
    {
        $handle = rename($yol . $eskidosyaisim, $yol . $dosyaisim);
        if ($handle) {
            header("location:./");
        } else {
            echo "hata oldu";
        }

    }

    function ext($dosyaisim)
    {
        $dosyaisim = strtolower(pathinfo($dosyaisim, PATHINFO_EXTENSION));
        return $dosyaisim;
    }

    function toString($icerik)
    {
        $icerik = (string)trim($icerik);
        $icerik = htmlspecialchars(stripslashes(strip_tags($icerik)));
        $find = array(
            'Ç', 'Ş', 'Ğ', 'Ü', 'İ', 'Ö', 'ç', 'ş', 'ğ', 'ü', 'ö', 'ı', '+', '#'
        );
        $replace = array(
            'c', 's', 'g', 'u', 'i', 'o', 'c', 's', 'g', 'u', 'o', 'i', 'plus', 'sharp'
        );
        $icerik = strtolower(str_replace($find, $replace, $icerik));
        $icerik = preg_replace("@[^A-Za-z0-9\-_\.\+]@i", ' ', $icerik);
        $icerik = trim(preg_replace('/\s+/', ' ', $icerik));
        $icerik = str_replace(' ', '-', $icerik);
        return $icerik;
    }

    function delete_directory($dirname)
    {
        if (is_dir($dirname))
            $dir_handle = opendir($dirname);
        if (!$dir_handle)
            return false;
        while ($file = readdir($dir_handle)) {
            if ($file != "." && $file != "..") {
                if (!is_dir($dirname . "/" . $file))
                    unlink($dirname . "/" . $file);
                else
                    $this->delete_directory($dirname . '/' . $file);
            }
        }
        closedir($dir_handle);
        rmdir($dirname);
        return true;
    }
}