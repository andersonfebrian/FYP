<?php

if (!function_exists('data_from_csv')) {
  function data_from_csv($filename)
  {

    $data = [];

    $file = fopen(asset($filename), 'r');
    $headers = fgetcsv($file);

    while ($row = fgetcsv($file)) {
      $data[] = array_combine($headers, $row);
    }

    fclose($file);

    return $data;
  }
}

if (!function_exists('user_store')) {
  function user_store()
  {
    return Auth::user()->store;
  }
}

if (!function_exists(('base64_to_image'))) {
  function base64_to_image($base64_str, $user_name)
  {

    if (!file_exists(storage_path('app/biosecure/'))) {
      mkdir(storage_path('app/biosecure/'));
    }

    if (!file_exists(storage_path('app/biosecure/' . $user_name))) {
      mkdir(storage_path('app/biosecure/' . $user_name));
    }

    $data = explode(',', $base64_str);

    $filename = uniqid() . '.jpg';

    $file = fopen(storage_path('app/biosecure/' . $user_name . '/' . $filename), 'wb');
    fwrite($file, base64_decode($data[1]));
    fclose($file);

    return $data;
  }
}
