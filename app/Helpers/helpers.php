<?php

if(!function_exists('data_from_csv')) {
  function data_from_csv($filename) {

    $data = [];

    $file = fopen(asset($filename), 'r');
    $headers = fgetcsv($file);

    while($row = fgetcsv($file)) {
      $data[] = array_combine($headers, $row);
    }

    fclose($file);

    return $data;
  }
}

if(!function_exists('user_store')) {
  function user_store() {
    return Auth::user()->store;
  }
}