<?php
namespace App\Controllers;
class ImageController extends BaseController
{
    public function  generateImage(){

        try {
            $width = isset($_GET['width']) ? intval($_GET['width']) : 400;
            $height = isset($_GET['height']) ? intval($_GET['height']) : 400;
            $fieldWidth = isset($_GET['fieldWidth']) ? intval($_GET['fieldWidth']) : 20;

            // Create the image with the given width and height
            $image = imagecreatetruecolor($width, $height);

            // Define the colors for the fields
            $black = imagecolorallocate($image, 0, 0, 0);
            $white = imagecolorallocate($image, 255, 255, 255);

            // Draw the fields using a nested loop
            for($y = 0; $y < $height; $y += $fieldWidth) {
                for($x = 0; $x < $width; $x += $fieldWidth) {
                    if(($x + $y) / $fieldWidth % 2 == 0) {
                        imagefilledrectangle($image, $x, $y, $x + $fieldWidth, $y + $fieldWidth, $white);
                    } else {
                        imagefilledrectangle($image, $x, $y, $x + $fieldWidth, $y + $fieldWidth, $black);
                    }
                }
            }

            // Set the header and output the image as PNG
            header('Content-Type: image/png');
            imagepng($image);

            // Free up memory
            imagedestroy($image);
        }catch (\Throwable $th){
            echo $th->getMessage(). " on line #".$th->getLine(). " in ". $th->getFile();
        }
    }
}