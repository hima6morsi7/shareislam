<?php
class YoutubeDuration_YVTWP {
  
  protected $hours;

  protected $minutes;

  protected $seconds;

  public function __construct($hours, $minutes, $seconds){
    $this->hours = $hours;
    $this->minutes = $minutes;
    $this->seconds = $seconds;
  }

  public static function fromAPIFormat($duration){
    preg_match_all('/^PT((\d+)H)?((\d+)M)?((\d+)S)?/', $duration, $result, PREG_SET_ORDER);

    if(count($result) == 0){
      throw new Exception(__("The specified value is not a Youtube API duration format. Should be (PT1H20M10S).", 'YVTWP-lang'));
    }

    $result = $result[0];
    $hours = isset($result[2]) && !empty($result[2]) ? $result[2] : 0;
    $minutes = isset($result[4]) && !empty($result[4]) ? $result[4] : 0;
    $seconds = isset($result[6]) && !empty($result[6]) ? $result[6] : 0;
    
    return new YoutubeDuration_YVTWP($hours, $minutes, $seconds);
  }
  /*
   * 
   */
  public static function getCleanedDuration($duration)
  {
        $str_duration='';
        $youtubeDuration=  self::fromAPIFormat($duration);

        $str_duration=$youtubeDuration->minutes.':'.$youtubeDuration->seconds;
        if($youtubeDuration->hours!=0)
        {
          $str_duration=$youtubeDuration->hours.':'.$str_duration;
        }
        
        return $str_duration;
  }

  public function hours(){
    return $this->hours;
  }

  public function minutes(){
    return $this->minutes;
  }

  public function seconds(){
    return $this->seconds;
  }
}
