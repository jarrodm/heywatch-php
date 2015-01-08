<?php
class HeyWatchTest extends PHPUnit_Framework_TestCase {

  /*
    To run these tests, you need to set your API key with the
    environment variable `HEYWATCH_API_KEY`
  */

  public function testSubmitJob() {
    $config = "
set source = https://s3-eu-west-1.amazonaws.com/media.heywatch.com/test.mp4
-> mp4 = s3://a:s@bucket/video.mp4
";
    $job = HeyWatch::submit($config);
    $this->assertEquals("ok", $job->{"status"});
    $this->assertTrue($job->{"id"} > 0);
  }

  public function testSubmitBadConfig() {
    $config = "
set source = https://s3-eu-west-1.amazonaws.com/media.heywatch.com/test.mp4
";

    $job = HeyWatch::submit($config);
    $this->assertEquals("error", $job->{"status"});
    $this->assertEquals("config_not_valid", $job->{"error_code"});
  }

  public function testSubmitConfigWithAPIKey() {
    $config = "
set source = https://s3-eu-west-1.amazonaws.com/media.heywatch.com/test.mp4
";

    $job = HeyWatch::submit($config, "k-4d204a7fd1fc67fc00e87d3c326d9b75");
    $this->assertEquals("error", $job->{"status"});
    $this->assertEquals("authentication_failed", $job->{"error_code"});
  }
}