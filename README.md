# blank

pushsilex

Pushbullet integration with Silex
https://docs.pushbullet.com/

## Usage

```php
use Silex\Application;
use PushSilex\Silex\Provider\PushbulletServiceProvider;

$app = new Application(['debug' => true]);

$myToken = include(__DIR__ . '/../conf/token.php');

$app->register(new PushbulletServiceProvider($myToken));

$app->get("/", function () {
    return "Usage: GET /note/{title}/{body}";
});

$app->get("/note/{title}/{body}", function (Application $app, $title, $body) {
    return $app->json($app['pushbullet.note']($title, $body));
});

$app->run();
```

