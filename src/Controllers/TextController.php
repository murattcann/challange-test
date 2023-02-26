<?php
namespace App\Controllers;

use App\Enums\DirectionEnum;
use App\Helpers\TextHelper;

class TextController extends BaseController
{
    public function  changeText(){
        return $this->view("text-scrambler", ["title" => "Text Scramble"]);
    }

    public function changeTextPost(){
        try {
            $data = $_POST;

            if(trim(strlen($data["text"])) < 4 || str_replace(" ", '',strlen($data["text"])) < 4){
                throw  new \Exception(message: "You must enter at least 4 characted words");
            }

            if($data["direction"] === DirectionEnum::REVERSE->value && isset($_SESSION["originalWords"]) && count($_SESSION["originalWords"]) <= 0){
                throw  new \Exception(message: "There is no words to compare with original. You have to convert a text directly");
            }
            // checking if original words exists
            if($data["direction"] === DirectionEnum::REVERSE->value && count($_SESSION["originalWords"]) <= 0){
                throw  new \Exception(message: "There is no words to compare with original. You have to convert a text directly");
            }

            $responseData = [
                "status" => 200,
                "text" => $data["direction"] == DirectionEnum::REVERSE->value ? TextHelper::unscramble($data["text"]) : TextHelper::scramble($data["text"]),
                "originalText" => $data["text"]
            ];

            echo  json_encode($responseData);
        }catch (\Throwable $th){
            echo json_encode([
                "status" => $th->getCode(),
                "message" => $th->getMessage()
            ]);
        }
    }
}