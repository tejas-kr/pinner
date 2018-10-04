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
                $img = ltrim($img, '/');
                $img = ltrim($img, ':');
            } catch (Exception $e) {

            }
            return ["text" => $text, "img" => $img];
        }
    }