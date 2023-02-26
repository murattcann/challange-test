<?php

/**
 * All routes must be defined here to reach a controller action
 * - controller key => Related controller
 * - action key => A method of the related controller
 */
return [
    "home" => [
          "controller" => App\Controllers\HomeController::class,
          "action" => "index",
    ],
    "change-text" => [
        "controller" => App\Controllers\TextController::class,
        "action" => "changeText",
    ],
    "change-text-post" => [
        "controller" => App\Controllers\TextController::class,
        "action" => "changeTextPost",
    ],
    "create-image" => [
        "controller" => \App\Controllers\ImageController::class,
        "action" => "generateImage"
    ],
    "import-excel" => [
        "controller" => \App\Controllers\ExcelController::class,
        "action" => "importExcel"
    ],
    "job-report" => [
        "controller" => \App\Controllers\ExcelController::class,
        "action" => "getJobReport"
    ],
];