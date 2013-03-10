<?php

abstract class Controller {

    /**
     * @return bool
     */
    public function before($request) {
        return true;
    }

    /**
     * @return void
     */
    public function after($request) {
    }

    /**
     * Serve request
     *
     * @return Response
     */
    public function serve($request) {

        $response = new Response();
        $response->setCode(404);

        if ($this->before($request)) {
            if (method_exists($this, $request->action)) {
                ob_start();
                $response = call_user_func_array( array($this, $request->action), array($request) );
                $content = ob_get_clean();

                // Deprecation controller wrapping
                if ($response === null) {
                    $response = new Response($content);
                }

            }
            $this->after($request);
        }

        return $response;
    }

    /**
     * ќбеспечивает перенаправление на заданный URL
     *
     * @param string $url
     * @param integer $status
     * @return Response
     */
    public function redirect($url, $status = 301, $exit = true) {
        $response = new Response();

        // Generate absolute URL name
        if (strpos($url, '://') === false) {
            // Not implemented.
        }

        // Set the response status
        $response->status = $status;

        // Set the location header
        $response->headers['Location'] = $url;

        return $response;
    }


}
