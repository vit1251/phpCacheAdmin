<?php

class ErrorHandler {

    /**
     * Handles the exception.
     *
     * @param Exception $exception the exception captured
     * @return void
     */
    public static function handleException( $exception ) {

        $trace = $exception->getTrace();

			foreach($trace as $i=>$t)
			{
				if(!isset($t['file']))
					$trace[$i]['file']='unknown';

				if(!isset($t['line']))
					$trace[$i]['line']=0;

				if(!isset($t['function']))
					$trace[$i]['function']='unknown';

				unset($trace[$i]['object']);
        }

        $template = new View( 'template' );
        $template->content = new View( 'exception' );
        $template->content->message = $exception->getMessage();
        $template->content->trace = $trace;

        echo $template;
    }

}

set_exception_handler( array('ErrorHandler', 'handleException') );
