<?
class LinkUnit
{
    public $header_size;
    public $header;
    public $body_size;
    public $body;
    public $time;
    public $http_code;
    private $tests_passed = array();
    private $tests_failed = array();

    //    public $header_size
    public function getURL($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        $response = curl_exec($ch);
        $info = curl_getinfo($ch);
        //        var_dump($info);
        $this->header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $this->header = substr($response, 0, $header_size);
        $this->body = substr($response, $header_size);
        $this->body_size = curl_getinfo($ch, CURLINFO_SIZE_DOWNLOAD);
        $this->http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $this->time = curl_getinfo($ch, CURLINFO_TOTAL_TIME);
        curl_close($ch);

    }

    public function displayAll () {
        print "<li>Header Size: $this->header_size Bytes</li>";
        print "<li>Body Size: $this->body_size Bytes</li>";
        print '<li>Total Time: '.$this->time.' seconds</li>';
        print '<li>HTTP Code: '. $this->http_code.'</li>';
    }
    
    public function testSummary() {
        print '<h3>URL Summary</h3>';
        print '<ul>';
        print '<li>Tests passed: '.sizeof($this->tests_passed).'</li>';
        print '<li>Tests failed: '.sizeof($this->tests_failed).'</li>';
        print '</ul>';
    }

    public function testHasText($str) {
        $result = $this->hasText($str);
        $test_info = ['test'=>'testHasText','var'=>$str];
        if ($result === true) { 
            array_push($this->tests_passed, $test_info);
        }
        else {
            array_push($this->tests_failed, $test_info);
        }
        print '<li>Testing: has Text: <b>'.$str.'</b><br>';
        print '<div class="result">'.var_dump($result).'</div>';
        print '</li>';
        
    }

    private function hasText($regex) {
        return (boolean)(preg_match("/$regex/",$this->body));
    }
}