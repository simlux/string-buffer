# StringBuffer [![Build Status](https://travis-ci.org/simlux/string-buffer.svg?branch=master)](https://travis-ci.org/simlux/string-buffer)
Manipulate strings object oriented.

## Installation
The preferred method of installation is via Packagist and Composer. Run the following command to install the package and add it as a requirement to your project's composer.json:

```
composer require simlux/string-buffer
```

## Examples
```php
<?php
use Simlux\String\StringBuffer();

$buffer = new StringBuffer('test');
$buffer->append('bar');
$buffer->prepend('foo');
echo $buffer->toString(); // footestbar

// with factory method
echo StringBuffer::create('Test')                   // Test
    ->append('Bar')                                 // TestBar
    ->prepend('Foo')                                // FooTestBar
    ->appendIf(true, 'AppendIf', 'AppendElse')      // FooTestBarAppendIf
    ->appendIf(false, 'AppendIf', 'AppendElse')     // FooTestBarAppendIfAppendElse
    ->prependIf(true, 'PrependIf', 'PrependElse')   // PrependIfFooTestBarAppendIfAppendElse
    ->prependIf(false, 'PrependIf', 'PrependElse'); // PrependElsePrependIfFooTestBarAppendIfAppendElse
```

## SonarQube
### Docker Repository: https://hub.docker.com/_/sonarqube/
```sh
docker run -d --name sonarqube -p 9000:9000 -p 9092:9092 sonarqube
```

### Sonar Runner via Docker
```sh
docker run --link sonarqube \         
  --entrypoint /opt/sonar-runner-2.4/bin/sonar-runner \
  -e SONAR_USER_HOME=/data/.sonar-cache \
  -v $(pwd):/data -u $(id -u) sebp/sonar-runner \
    -Dsonar.host.url=http://sonarqube:9000 \
    -Dsonar.jdbc.url=jdbc:h2:tcp://sonarqube/sonar \
    -Dsonar.jdbc.username=sonar \
    -Dsonar.jdbc.password=sonar \
    -Dsonar.jdbc.driverClassName=org.h2.Driver \
    -Dsonar.embeddedDatabase.port=9092
```

### Sonar Runner: https://docs.sonarqube.org/display/SONARQUBE45/Installing+and+Configuring+SonarQube+Runner
```sh
wget http://repo1.maven.org/maven2/org/codehaus/sonar/runner/sonar-runner-dist/2.4/sonar-runner-dist-2.4.zip
unzip sonar-runner-dist-2.4.zip
./sonar-runner-2.4/bin/sonar-runner
```
