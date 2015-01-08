# PHP client library for encoding videos with HeyWatch

## Install

To install the HeyWatch PHP library, you need [composer](http://getcomposer.org) first:

``` language-console
curl -sS https://getcomposer.org/installer | php
```

Edit `composer.json`:

```language-javascript
{
    "require": {
        "heywatch/heywatch": "2.*"
    }
}
```

Install the depencies by executing `composer`:

``` language-console
php composer.phar install
```

## Submitting the job

Use the [API Request Builder](https://app.heywatch.com/job/new) to generate a config file that match your specific workflow.

Example of `heywatch.conf`:

``` language-hw
var s3 = s3://accesskey:secretkey@mybucket

set source  = http://yoursite.com/media/video.mp4
set webhook = http://mysite.com/webhook/heywatch

-> mp4  = $s3/videos/video.mp4
-> webm = $s3/videos/video.webm
-> jpg_300x = $s3/previews/thumbs_#num#.jpg, number=3
```

Here is the PHP code to submit the config file:

``` language-php
<?php

$conf = file_get_contents("heywatch.conf");
$job = HeyWatch::submit($conf, "api-key");

if($job->{"status"} == "ok") {
  echo $job->{"id"};
} else {
  echo $job->{"error_code"};
  echo $job->{"error_message"};
}

?>
```

Note that you can use the environment variable `HEYWATCH_API_KEY` to set your API key.

*Released under the [MIT license](http://www.opensource.org/licenses/mit-license.php).*

---

* HeyWatch website: http://www.heywatchencoding.com
* API documentation: http://www.heywatchencoding.com/docs
* Github: http://github.com/heywatch/heywatch_api-php
* Contact: [support@heywatch.com](mailto:support@heywatch.com)
* Twitter: [@heywatch](http://twitter.com/heywatch) / [@sadikzzz](http://twitter.com/sadikzzz)