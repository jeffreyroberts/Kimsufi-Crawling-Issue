<?php
/**
 * Created by PhpStorm.
 * User: jlroberts
 * Date: 10/16/17
 * Time: 4:43 PM
 */

require __DIR__ . '/../vendor/autoload.php';
$rollingCurl = new \RollingCurl\RollingCurl();
$domains = array();
$handle = fopen(__DIR__ . '/../data/fresh', 'r');
if ($handle) {

    $y = 0;
    $x = 0;
    $origin = '';
    while (($line = fgets($handle)) !== false) {

        $x = $x + 1;
        $line = str_replace("\r", '', $line);
        $line = str_replace("\n", '', $line);

        $domains[] = $line;
    }

    fclose($handle);
}

shuffle($domains);

foreach($domains as $domain) {
    $rollingCurl->get('http://' . $domain . '/');
}

$results['start'] = new \DateTime('now');
$results['count'] = 0;

$rollingCurl
    ->setCallback(function(\RollingCurl\Request $request, \RollingCurl\RollingCurl $rollingCurl) use (&$results) {

        $end = new \DateTime('now');
        $diff = $end->getTimestamp() - $results['start']->getTimestamp();

        $results['count'] = $results['count'] + 1;

        echo '[' . $results['count'] . '][' . $diff . ']' . "Fetch complete for (" . $request->getUrl() . ")" . PHP_EOL;
    })
    ->setSimultaneousLimit(100)
    ->execute();