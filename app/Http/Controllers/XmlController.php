<?php

namespace App\Http\Controllers;

use App\Models\Admin\Products\Product;
use SimpleXMLElement;

class XmlController extends Controller
{
    public function getXml()
    {
        function array_to_xml($data, &$xml_data)
        {
            foreach ($data as $key => $value) {
                if (is_numeric($key)) {
                    $key = 'item' . $key; //dealing with <0/>..<n/> issues
                }
                if (is_array($value)) {
                    $subnode = $xml_data->addChild($key);
                    array_to_xml($value, $subnode);
                } else {
                    $xml_data->addChild("$key", htmlspecialchars("$value"));
                }
            }
        }

        $data = Product::all();
        $xml_data = new SimpleXMLElement('<?xml version="1.0"?><data></data>');
        array_to_xml($data, $xml_data);
        $result = $xml_data->asXML('name.xml');
//        dd($result);

    }
}
