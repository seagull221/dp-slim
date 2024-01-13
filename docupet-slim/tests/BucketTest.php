<?php

use PHPUnit\Framework\TestCase;
use App\Models\MainModel;

final class BucketTest extends TestCase
{
    public function testEqualBucket()
    {
        $input = [1,2,3,4,5,6];
        $output = array (
            0 => 
            array (
              'bucket' => 
              array (
                'start' => 0,
                'end' => 2.666666666666667,
                'width' => 1.6666666666666667,
              ),
              'numset' => 
              array (
                0 => 1,
              ),
            ),
            1 => 
            array (
              'bucket' => 
              array (
                'start' => 2.666666666666667,
                'end' => 4.333333333333334,
                'width' => 1.6666666666666667,
              ),
              'numset' => 
              array (
                0 => 2,
                1 => 3,
              ),
            ),
            2 => 
            array (
              'bucket' => 
              array (
                'start' => 4.333333333333334,
                'end' => 6.000000000000001,
                'width' => 1.6666666666666667,
              ),
              'numset' => 
              array (
                0 => 4,
                1 => 5,
                2 => 6,
              ),
            ),
          );
        $result = [];

        $result = MainModel::sortEqual($input);

        $this->assertEquals($output, $result);
    }

    public function testFrequencyBucket()
    {
        $input = [1,2,3,4,5,6];
        $output = array (
            1 => 
            array (
              0 => 1,
              1 => 2,
            ),
            2 => 
            array (
              0 => 3,
              1 => 4,
            ),
            3 => 
            array (
              0 => 5,
              1 => 6,
            ),
          );

        $result = [];

        $result = MainModel::sortFrequency($input);

        $this->assertEquals($output, $result);
    }
}