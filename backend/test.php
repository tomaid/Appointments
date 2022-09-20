<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class VerRefRepo {
private array $results;
    private int $count_results;

    public function __construct() {

        $this->count_results= count($this->results);
    }

    public function getCountResults(): int
    {
        return $this->count_results;
    }

}

$a = new VerRefRepo();
$z = $a->getCountResults();
print_r($z);
?>