# LinkUnitTest

Taking a stab at creating a unit-test style link checker to test URLs for such attributes as: 
* HTTP Code (200, 404, etc.)
* Length of Body
* Contents of Body (e.g. a particular regex)

## Example of Usage

$test = new LinkUnit();
$test->getURL($some_link);
$test->displayAll();
$test->testHttpCode(200);
$test->testFasterThan(2.5); // seconds
$test->testHasText('Your search text');
$test->testSummary();
