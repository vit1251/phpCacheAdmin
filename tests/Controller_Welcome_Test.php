<?php

class Controller_Welcome_Test extends PHPUnit_Framework_TestCase {

    /**
     * Test on method "index"
     *
     * @group Controller
     */
    public function testIndexAction() {
        $controllerWelcome = new Controller_Welcome();
        $request = new Request();
        $response = $controllerWelcome->index($request);
        $this->assertNotNull($response);
    }

}
