# 运行方式
## 前提: docker 19+, Compose 1.24+
- `在当前目录下, 在终端上运行docker-compose up, 第一次运行,因为要下载依赖,可能比较慢`
- `导入数据库的原始数据  sh init_db.sh , TODO: 基于 mysql:5.6.46 ,编译一个docker镜像,带导入初始化数据的功能`
- `关闭 docker-compose down`

```运行日志
(base) ➜  book docker-compose up
WARNING: The Docker Engine you're using is running in swarm mode.

Compose does not use swarm mode to deploy services to multiple nodes in a swarm. All containers will be scheduled on the current node.

To deploy your application across the swarm, use `docker stack deploy`.

Creating network "book_default" with the default driver
Creating swoft-srv ... done
Attaching to swoft-srv
swoft-srv | Loading composer repositories with package information
swoft-srv | Updating dependencies (including require-dev)
swoft-srv | Package operations: 84 installs, 0 updates, 0 removals
swoft-srv |   - Installing swoft/swoole-ide-helper (dev-master d53d7e3): Cloning d53d7e3579 from cache
swoft-srv |   - Installing swoft/stdlib (v2.0.6): Downloading (100%)
swoft-srv |   - Installing swoft/connection-pool (v2.0.6): Downloading (100%)
swoft-srv |   - Installing swoft/server (v2.0.6): Downloading (100%)

安装依赖.....

swoft-srv |   - Installing myclabs/deep-copy (1.9.3): Downloading (100%)
swoft-srv |   - Installing phpunit/phpunit (7.5.16): Downloading (100%)
swoft-srv | toolkit/cli-utils suggests installing inhere/php-validate (Very lightweight data validate tool)
swoft-srv | toolkit/cli-utils suggests installing inhere/console (a lightweight php console application library.)
swoft-srv | monolog/monolog suggests installing graylog2/gelf-php (Allow sending log messages to a GrayLog2 server)
swoft-srv | monolog/monolog suggests installing sentry/sentry (Allow sending log messages to a Sentry server)
swoft-srv | monolog/monolog suggests installing doctrine/couchdb (Allow sending log messages to a CouchDB server)
swoft-srv | monolog/monolog suggests installing ruflin/elastica (Allow sending log messages to an Elastic Search server)
swoft-srv | monolog/monolog suggests installing php-amqplib/php-amqplib (Allow sending log messages to an AMQP server using php-amqplib)
swoft-srv | monolog/monolog suggests installing ext-amqp (Allow sending log messages to an AMQP server (1.0+ required))
swoft-srv | monolog/monolog suggests installing ext-mongo (Allow sending log messages to a MongoDB server)
swoft-srv | monolog/monolog suggests installing mongodb/mongodb (Allow sending log messages to a MongoDB server via PHP Driver)
swoft-srv | monolog/monolog suggests installing aws/aws-sdk-php (Allow sending log messages to AWS services like DynamoDB)
swoft-srv | monolog/monolog suggests installing rollbar/rollbar (Allow sending log messages to Rollbar)
swoft-srv | monolog/monolog suggests installing php-console/php-console (Allow sending log messages to Google Chrome)
swoft-srv | symfony/yaml suggests installing symfony/console (For validating YAML files using the lint command)
swoft-srv | symfony/service-contracts suggests installing symfony/service-implementation
swoft-srv | sebastian/global-state suggests installing ext-uopz (*)
swoft-srv | phpunit/php-code-coverage suggests installing ext-xdebug (^2.6.0)
swoft-srv | phpunit/phpunit suggests installing phpunit/php-invoker (^2.0)
swoft-srv | phpunit/phpunit suggests installing ext-soap (*)
swoft-srv | phpunit/phpunit suggests installing ext-xdebug (*)
swoft-srv | Writing lock file
swoft-srv | Generating autoload files
swoft-srv | 2019/10/27-11:14:19 [INFO] Swoft\SwoftApplication:setSystemAlias(485) Set alias @base=/var/www/swoft
swoft-srv | 2019/10/27-11:14:19 [INFO] Swoft\SwoftApplication:setSystemAlias(486) Set alias @app=@base/app
swoft-srv | 2019/10/27-11:14:19 [INFO] Swoft\SwoftApplication:setSystemAlias(487) Set alias @config=@base/config
swoft-srv | 2019/10/27-11:14:19 [INFO] Swoft\SwoftApplication:setSystemAlias(488) Set alias @runtime=@base/runtime
swoft-srv | 2019/10/27-11:14:19 [INFO] Project path is /var/www/swoft
swoft-srv | 2019/10/27-11:14:19 [WARNING] Swoft\Processor\EnvProcessor:handle(40) Env file(/var/www/swoft/.env) is not exist! skip load it
swoft-srv | 2019/10/27-11:14:30 [INFO] Swoft\Processor\AnnotationProcessor:handle(45) Annotations is scanned(autoloader 33, annotation 450, parser 92)
swoft-srv | 2019/10/27-11:14:31 [INFO] Swoft\Processor\BeanProcessor:handle(55) config path=/var/www/swoft/config
swoft-srv | 2019/10/27-11:14:31 [INFO] Swoft\Processor\BeanProcessor:handle(56) config env=
swoft-srv | 2019/10/27-11:14:31 [INFO] Swoft\Processor\BeanProcessor:handle(60) Bean is initialized(singleton 310, prototype 76, definition 41)
swoft-srv | 2019/10/27-11:14:31 [INFO] Swoft\Processor\EventProcessor:handle(33) Event manager initialized(64 listener, 5 subscriber)
swoft-srv | 2019/10/27-11:14:31 [INFO] Swoft\WebSocket\Server\Listener\AppInitCompleteListener:handle(35) WebSocket server route registered(module 3, message command 12)
swoft-srv | 2019/10/27-11:14:31 [INFO] Swoft\Tcp\Server\Listener\AppInitCompleteListener:handle(37) Tcp server route registered(routes 4)
swoft-srv | 2019/10/27-11:14:31 [INFO] Swoft\Error\Listener\AppInitCompleteListener:handle(34) Error manager init completed(4 type, 5 handler, 5 exception)
swoft-srv | 2019/10/27-11:14:31 [INFO] Swoft\Processor\ConsoleProcessor:handle(38) Console command route registered (group 14, command 43)
swoft-srv |                             Information Panel
swoft-srv |   ***********************************************************************
swoft-srv |   * HTTP     | Listen: 0.0.0.0:18306, type: TCP, mode: Process, worker: 6
swoft-srv |   * RPC      | Listen: 0.0.0.0:18307, type: TCP
swoft-srv |   ***********************************************************************
swoft-srv |
swoft-srv | HTTP server start success !
swoft-srv | 2019/10/27-11:14:31 [INFO] Swoft\Server\Server:startSwoole(491) Swoole\Runtime::enableCoroutine
swoft-srv | 2019/10/27-11:14:31 [INFO] Swoft\Listener\BeforeStartListener:handle(27) Server extra info: pidFile @runtime/swoft.pid
swoft-srv | 2019/10/27-11:14:31 [INFO] Swoft\Listener\BeforeStartListener:handle(28) Registered swoole events:
swoft-srv |  start, shutdown, managerStart, managerStop, workerStart, workerStop, workerError, request, task, finish
swoft-srv | Server start success (Master PID: 379, Manager PID: 382)
```

- `在浏览器上打开 http://localhost:18306/`



# 导入sql文件
`docker exec -i library-on-mysql-srv sh -c 'exec mysql -uroot -p"$MYSQL_ROOT_PASSWORD"' < books.sql`