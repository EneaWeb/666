<?php
// Routes

$app->get('/', function ($request, $response, $args) {
    return $this->renderer->render($response, 'index.phtml');
});

/**
 * Routes group for APIs security controls
 */

// latest 20 posts
// starting_id = 0 for first 20 records, [int] for id value. It asks for ids >= starting_id
// key = API key
// 
// 
$app->add(new RKA\Middleware\IpAddress());

$app->get('/api/take/{starting_id}/{key}', function ($request, $response, $args) use ($container) {
	// check if server IP is the same as the request one
	//if ($request->getAttribute('ip_address') === $_SERVER['SERVER_ADDR'] ) {
		// check the api key val
		if ( $args['key'] == $this->get('settings')['api']['key'] ) {
			// get values from starting id (>=)
			if ($args['starting_id'] == '0') {
				$data = $container->get('db')->table('posts')->orderBy('id', 'desc')->take(5)->get();
			} else {
				$data = $container->get('db')->table('posts')->where('id', '<', $args['starting_id'])->orderBy('id', 'desc')->take(5)->get();
			}
			// if everything is ok.. return JSON formatted response
			if ($data->isEmpty())
				$data = '';
			return $response->withJson($data);
		}
	//}
	// return error if something was wrong
	return 'Error';
});