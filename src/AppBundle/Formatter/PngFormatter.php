<?php

namespace AppBundle\Formatter;

use Symfony\Component\HttpFoundation\Response;

/**
 * Class PngFormatter
 */
class PngFormatter extends AbstractFormatter
{
    /**
     * @return Response
     */
    public function getResponse()
    {
        $image = imagecreate(800, 200);
        imagecolorallocate($image, 200, 200, 255);
        $textcolor = imagecolorallocate($image, 0, 0, 255);


        foreach ($this->params as $index => $param) {
            $string = $param->getCaption().': '.$param->getValue();

            imagestring($image, 5, 50, ($index + 1) * 30, $string, $textcolor);
        }

        imagepng($image, '/tmp/1.png');
        imagedestroy($image);

        return new Response(file_get_contents('/tmp/1.png'), 200, ['Content-Type' => 'image/png', '']);
    }
}
