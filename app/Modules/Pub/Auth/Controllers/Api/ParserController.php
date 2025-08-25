<?php
/**
 * Created by WyTcorp.
 * User: WyTcorp
 * Date: 05.10.22
 * Site: lockit.com.ua
 * Email: wild.savedo@gmail.com
 */

namespace App\Modules\Pub\Auth\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Admin\Product\Models\CategoryProduct;
use App\Modules\Admin\Product\Models\Images;
use App\Modules\Admin\Product\Models\Product;
use DOMDocument;
use DOMXPath;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Storage;

class ParserController extends Controller
{
    public function index()
    {
        $products = Product::all();

        foreach ($products as $product) {

            $endpoint = $product->url;
            $client = new Client();
            $response = $client->request('GET', $endpoint, [
                'headers' => [
                    'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36',
                    'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
                    'Accept-Language' => 'zh-CN,zh;q=0.9,en;q=0.8,sm;q=0.7',
                    'Accept-Encoding' => 'gzip'
                ],
                'decode_content' => true, // Расшифровать gzip
                'connect_timeout' => 10
            ]);
            $html = (string)$response->getBody();

            $findShortDesc = $this->getElementByClassname($html, 'div', 'product-list-item__content__description');
            $imgs = $this->getElementByClassname($html, 'div', 'swiper-slide');
            // $imgs = $this->getElementByClassname($html, 'picture', 'product-list-item__content__img');

            $characteristics = '';
            if (!empty($findShortDesc)) {
                $dom = new DOMDocument;
                libxml_use_internal_errors(true);
                $dom->loadHTML($findShortDesc);
                libxml_clear_errors();
                $links = $dom->getElementsByTagName('ul');
                if (isset($links[1]->nodeValue)) {
                    $characteristics = $links[1]->nodeValue;
                }
            }

            $findContent = $this->getElementByClassname($html, 'div', 'product-card__description__editor text-editor');
            $content = '';
            if (!empty($findContent)) {
                $content = $findContent;
            }

            $product->content = $content;
            $product->characteristics = $characteristics;
            $product->price = 0;
             $product->save();

            if (!empty($imgs)) {

                $dom = new DOMDocument;
                libxml_use_internal_errors(true);
                $dom->loadHTML($imgs);
                libxml_clear_errors();
                $xpath = new DOMXPath($dom);
                $query = "//a";
                $entries = $xpath->query($query);

                foreach ($entries as $entry) {
                    $href = $entry->getAttribute("href");
                    $explode = explode('/', $href);
                    //$name = $explode[count($explode)-1];
                    // $path = '/images/products/'.$product.'/'.$name;
                    $path = "/images/products/{$product->id}/";
                    $contents = file_get_contents($href);
                    $name = substr($href, strrpos($href, '/') + 1);
                    Storage::disk('public')->put($path . $name, $contents);
                    $img = new Images();
                    $img->product_id = $product->id;
                    $img->title = $name;
                    $img->path = '/storage' . $path . $name;
                    $img->type = 0;
                    $img->save();
                }
            }

        }
    }

    public function getElementByClassname($html, $tag = 'div', $classname)
    {
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($html);
        libxml_clear_errors();

        $xpath = new DOMXpath($dom);
        $nodes = $xpath->query('//' . $tag . '[@class="' . $classname . '"]');

        $tmp_dom = new DOMDocument();
        foreach ($nodes as $node) {
            $tmp_dom->appendChild($tmp_dom->importNode($node, true));
        }

        return trim($tmp_dom->saveHTML());
    }

    public function getProducts()
    {
        $categories = CategoryProduct::all();

        foreach ($categories as $category) {
            for ($x = 1; $x <= 5; $x++) {
                $endpoint = $category->url . ',' . $x;
                $client = new Client();
                try {
                    $response = $client->request('GET', $endpoint, [
                        'headers' => [
                            'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36',
                            'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
                            'Accept-Language' => 'zh-CN,zh;q=0.9,en;q=0.8,sm;q=0.7',
                            'Accept-Encoding' => 'gzip'
                        ],
                        'decode_content' => true, // Расшифровать gzip
                        'connect_timeout' => 10
                    ]);

                    $html = (string)$response->getBody();

                    $findProducts = $this->getElementByClassname($html, 'a', 'product-list-item__heading');
                    if (!empty($findProducts)) {
                        $dom = new DOMDocument;
                        libxml_use_internal_errors(true);
                        $dom->loadHTML($findProducts);
                        libxml_clear_errors();
                        $links = $dom->getElementsByTagName('a');
                        $array = [];
                        foreach ($links as $link) {
                            $newLink = trim(str_replace('14 dni na zwrot', '', str_replace('Wysyłka: do 24h', '', $link->nodeValue)));
                            $newHref = $link->getAttribute('href');
                            $product = Product::firstWhere('title', $newLink);
                            if (empty($product)) {
                                $product = new Product();
                                $product->title = $newLink;
                                $product->content = $newLink;
                                $product->characteristics = $newLink;
                                $product->category_product_id = $category->id;
                                $product->url = $newHref;
                                $product->meta_title = $newLink;
                                $product->meta_description = $newLink;
                                $product->meta_keys = $newLink;
                                $product->save();
                            }
                        }
                    }
                } catch (ClientException $e) {

                }


            }
        }
    }

    public function categories()
    {
        $endpoint = 'https://www.eta-sklep.pl/';
        $client = new Client();
        $response = $client->request('GET', $endpoint, [
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36',
                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
                'Accept-Language' => 'zh-CN,zh;q=0.9,en;q=0.8,sm;q=0.7',
                'Accept-Encoding' => 'gzip'
            ],
            'decode_content' => true, // Расшифровать gzip
            'connect_timeout' => 10
        ]);
        $html = (string)$response->getBody();

        $dom = new DOMDocument;
        libxml_use_internal_errors(true);
        $dom->loadHTML($html);
        libxml_clear_errors();

        //$links = $dom->getElementsByTagName('a');
//        $links = $dom->getElementById('parent-item');
        $links = $dom->getElementsByTagName('a');
        $array = [];
        foreach ($links as $link) {
            $array[] = [
                'val' => $link->nodeValue,
                'href' => 'https://www.eta-sklep.pl' . $link->getAttribute('href')
            ];
        }
        $output = array_slice($array, 3, 60);
        $x = 1;
        foreach ($output as $item) {
            $cat = CategoryProduct::firstWhere('url', $item['href']);
            if (!isset($cat) && empty($cat)) {
                $cat = new CategoryProduct();
                $cat->title = $item['val'];
                $cat->parent_id = NULL;
                $cat->sort_order = $x;
                $cat->url = $item['href'];
                $cat->meta_title = $item['val'];
                $cat->meta_description = $item['val'];
                $cat->meta_keys = $item['val'];
                $cat->save();
            }

            $x++;
        }
    }
}
