<?php

class Denkmal_Scraper_Source_Basel_Renee extends Denkmal_Scraper_Source_Basel_Abstract {

    public function run(DateTime $now, array $dateList) {
        $apiResponse = $this->_retrieveEventList($now);
        return $this->processEvents($apiResponse, $now);
    }

    /**
     * @param string     $path
     * @param array|null $params
     * @return mixed
     */
    protected function _sendPrismicRequest($path, array $params = null) {
        /**
         * Would be better to use the official API client here, once we are on Guzzle 6
         * https://github.com/prismicio/php-kit
         */
        $url = CM_Util::link("https://reneech.prismic.io/api${path}", $params);
        $guzzle = new \GuzzleHttp\Client();
        $response = $guzzle->get($url, ['headers' => ['Accept' => 'application/json']]);
        return CM_Util::jsonDecode($response->getBody());
    }

    /**
     * @return string
     */
    protected function _retrieveMasterRef() {
        $result = $this->_sendPrismicRequest('');
        $ref = Functional\first($result['refs'], function ($ref) {
            return $ref['isMasterRef'];
        });
        return $ref['ref'];
    }

    /**
     * @param DateTime $now
     * @return array
     */
    protected function _retrieveEventList(DateTime $now) {
        $dateMinStamp = $now->getTimestamp() * 1000;
        $query = "[[:d = at(document.type, \"event\")][:d = date.after(my.event.from, ${dateMinStamp})]]";
        $ref = $this->_retrieveMasterRef();
        return $this->_sendPrismicRequest('/documents/search', [
            'q'        => $query,
            'pageSize' => 100,
            'ref'      => $ref,
        ]);
    }

    /**
     * @param array    $apiResponse
     * @param DateTime $now
     * @return Denkmal_Scraper_EventData[]
     */
    public function processEvents(array $apiResponse, DateTime $now) {
        $documentList = $apiResponse['results'];

        return Functional\map($documentList, function ($document) use ($now) {
            $data = $document['data'];

            $from = new DateTime($data['event']['from']['value']);

            $textSegments = Functional\map($data['event']['description']['value'], function ($textSegment) {
                return isset($textSegment['text']) ? $textSegment['text'] : null;
            });
            $textSegments = array_filter($textSegments);
            $description = new Denkmal_Scraper_Description(join(' ', $textSegments));

            return new Denkmal_Scraper_EventData($this->getRegion(), 'Renée', $description, $from);
        });
    }
}
