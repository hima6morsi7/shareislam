<?php
class Response_YVTWP {
    
    public  $status=1;
    public  $messages='';
    public  $result='';
    
    public function  __construct($status=NULL,$messages=NULL,$result=NULL) 
    {
        $this->status   = ( is_null($status) ? 1 : $status );
        $this->messages = ( is_null($messages) ? __('Done', 'YVTWP-lang') : $messages ) ;
        $this->result   = ( is_null($result) ? NULL : $result ) ;;
    }
}
?>