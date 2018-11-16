<?php
	
	namespace helper\JsonResponse;

	use Symfony\Component\HttpFoundation\Response;

	class JsonResponse
	{

		public function __construct($data)
		{
			$response = new Response();
            $response->headers->add([
                    'Content-Type'=>'application/json'
            ]);
            $response->setContent(json_encode(['response'=>$data]));
            return $response;
		}
	}