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
$app->add(new RKA\Middleware\IpAddress());
$app->get('/api/take/{starting_id}/{key}', function ($request, $response, $args) use ($container) {
	return var_dump($request->getAttribute('ip_address'));
	if ( isset($args['key']) && $args['key'] == $this->get('settings')['api']['key'] ) {
		$data = $container->get('db')->table('posts')->where('id', '>', $args['starting_id'])->take(20)->get();
		return $response->withJson($data);
	} else {
		return 'error';
	}
});