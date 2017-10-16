<?php
/**
 * Created by PhpStorm.
 * User: jlroberts
 * Date: 10/16/17
 * Time: 4:39 PM
 */

$handle = fopen(__DIR__ . '/../data/net.zone', 'r');
if ($handle) {

    $y = 0;
    $x = 0;
    $origin = '';
    while (($line = fgets($handle)) !== false) {

        $x = $x + 1;
        $line = str_replace("\r", '', $line);
        $line = str_replace("\n", '', $line);

        if ($x > 61) {

            $record = explode(' ', $line);

            switch ($record[1]) {
                case 'NS':
                    $domain = $record[0];

                    echo $domain . '.' . $origin . "\n";

                    break;
            }
        } else {

            if (strpos($line, '$ORIGIN') > -1) {

                $origin = str_replace('$ORIGIN ', '', $line);
                $origin = rtrim($origin, '.');
            }
        }

        if($x == 250000) {
            break;
        }
    }

    fclose($handle);
}