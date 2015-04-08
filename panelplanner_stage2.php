<?php

class panel_planner_stage_2{

    function __construct(){
        add_shortcode('panel_planner_2', array($this, 'panel_planner_stage_2'));
    }
    
    public function panel_planner_stage_2(){
        ob_start();
        $this->panel_planner_stage_2_process();
        ob_get_clean();
    }

    static public function panel_planner_stage_2_form() {
        echo "derpdaherp";
        echo file_get_contents(dirname(__FILE__).'/pp_stage2.php');
    }
    
    public function panel_planner_stage_2_process(){
        
        self::panel_planner_stage_2_form();
    }
}

?>