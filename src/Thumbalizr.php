<?php

namespace Thumbalizr;

use Zend\Http\Client;

/**
 * Class Thumbalizr
 * Date: 19/03/2015
 * @author Paolo Agostinetto <paul.ago@gmail.com>
 */
class Thumbalizr {

	/**
	 * API Key
	 * @var string
	 */
	protected $apiKey;

	/**
	 * @param string $apiKey
	 */
	public function __construct($apiKey = null){
		$this->apiKey = $apiKey;
	}

	/**
	 * Prepare req
	 * 
	 * @param Request $request
	 * @return Client
	 * @author Paolo Agostinetto <paul.ago@gmail.com>
	 */
	protected function prepareHttpRequest(Request $request){

		$client = new Client("https://api.thumbalizr.com/", array(
			'adapter' => 'Zend\Http\Client\Adapter\Curl',
			'curloptions' => array(
				CURLOPT_FOLLOWLOCATION => TRUE,
				CURLOPT_SSL_VERIFYPEER => FALSE
			)
		));
		$client->setStream(); // Use temp file
		$client->setParameterGet(array(
			"api_key" => $this->apiKey,
			"quality" => $request->getQuality(),
			"width" => $request->getWidth(),
			"encoding" => $request->getEncoding(),
			"delay" => $request->getDelay(),
			"mode" => $request->getMode(),
			"bwidth" => $request->getBrowserWidth(),
			"bheight" => $request->getBrowserHeight(),
			"url" => $request->getUrl()
		));

		return $client;
	}

	/**
	 * Capture
	 * 
	 * @param Request $request
	 * @param string $destination
	 * @return void
	 * @throws Exception
	 * @author Paolo Agostinetto <paul.ago@gmail.com>
	 */
	public function capture(Request $request, $destination){

		$client = $this->prepareHttpRequest($request);

		// This API works with a queue, we make the first call and then retry every 3
		// seconds checking if it's done

		$timeoutSeconds = 60;
		$isDone = false;
		$timeStart = microtime(true);

		while(!$isDone){

			// Check timeout
			$elapsed = microtime(true) - $timeStart;
			if((int)$elapsed >= $timeoutSeconds){
				throw new Exception("Timeout occurred");
			}

			// HTTP Call
			/* @var $response \Zend\Http\Response\Stream */
			$response = $client->send();

			if($response->getStatusCode() == 200){
				$status = $response->getHeaders()->get("X-Thumbalizr-Status");

				if($status->getFieldValue() == "OK"){ // Ok, done
					$isDone = true;
				}
				elseif($status->getFieldValue() == "FAILED"){ // Error
					$error = $response->getHeaders()->get("X-Thumbalizr-Error");

					throw new Exception(sprintf("Render failed: %s",
						$error->getFieldValue()
					));
				}
			}
			else{
				throw new Exception(sprintf("API Error - HTTP %d: %s",
					$response->getStatusCode(),
					$response->getBody()
				));
			}
		}

		// Copy file to destination
		copy($response->getStreamName(), $destination);
	}
}
