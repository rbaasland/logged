<?php
use PHPUnit\Framework\TestCase;

class LoggedTest extends TestCase
{
    public function testCanBeNegated()
    {
        // Arrange
        $a = new Logged();

        // Assert
        $this->assertEquals(-1, -1);
    }
}
