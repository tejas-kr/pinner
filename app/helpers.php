<?php
    use Goutte\Client;
    if (! function_exists('scrape_webpage')) {
        function scrape_webpage($url='')
        {
            $client = new Client();
            $crawler = $client->request('GET', $url);

            $text = '';
            $img = '';
            try {
                $text = '';
                foreach($crawler->filter('p') as $c) {
                    if ($c->nodeValue != "") {
                        $text = $c->nodeValue;
                        break;
                    }
                }

                $img = $crawler->filter('img')->attr('src');
                if ($img[0] == '/') {
                    $img = ltrim($img, '/');
                    $img = $url . '/' . $img;
                    /**
                     * Remain to fix for wikipedia
                     */
                }

            } catch (Exception $e) {

            }
            return ["text" => $text, "img" => $img];
        }
    }