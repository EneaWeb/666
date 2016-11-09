<?php
// Routes

$app->get('/', function ($request, $response, $args) {
    return $this->renderer->render($response, 'index.phtml');
});

$app->get('/policy', function($request, $response, $args) {
	return $this->renderer->render($response, 'policy.phtml');
});

// latest x posts
// starting_id = 0 for first 20 records, [int] for id value. It asks for ids >= starting_id
// key = API key
// 
$app->add(new RKA\Middleware\IpAddress());
// num posts
$num_posts = 20;

$app->get('/api/take/{starting_id}/{key}', function ($request, $response, $args) use ($container, $num_posts) {
	// check if server IP is the same as the request one
	//if ($request->getAttribute('ip_address') === $_SERVER['SERVER_ADDR'] ) {
		// check the api key val
		if ( $args['key'] == $this->get('settings')['api']['key'] ) {
			// get values from starting id (>=)
			if ($args['starting_id'] == '0') {
				$data = $container->get('db')->table('posts')->orderBy('id', 'desc')->take($num_posts)->get();
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