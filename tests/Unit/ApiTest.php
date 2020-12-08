<?php

namespace Tests\Unit;

use App\Models\Status;
use PHPUnit\Framework\TestCase;

class ApiTest extends TestCase
{
    /** @test */
    public function status_model_can_return_comma_separated_list() {
        $list = array('One', 'Two', 'Three');
        $expected = 'One, Two, and Three';

        $this->assertEquals(Status::commaSeparatedList($list), $expected);

        $list = array('One', 'Two');
        $expected = 'One and Two';

        $this->assertEquals(Status::commaSeparatedList($list), $expected);

        $list = array('One');
        $expected = 'One';

        $this->assertEquals(Status::commaSeparatedList($list), $expected);
    }

    /** @test */
    public function status_model_can_return_summary_message() {
        $list = array('One' => 1, 'Two' => 1);
        $expected = 'One and Two have degraded performance.';

        $this->assertEquals(Status::createStatusMessage($list), $expected);

        $list = array('One' => 1);
        $expected = 'One has degraded performance.';

        $this->assertEquals(Status::createStatusMessage($list), $expected);
    }
}
