<?php

function __autoload($className) {
    include $className.'.class.php';
}

class Access {
    private $task;
    
    public function __construct() {
        if(isset($_POST['step_1_next'])) {
            unset($_POST['step_1_next']);
            $this->task = new CurrentFirm();
        
        } else if(isset($_POST['step_1_new'])) {
            unset($_POST['step_1_new']);
            $this->task = new NewFirm();
            
        } else if(isset($_POST['step_2_next'])) {
            unset($_POST['step_2_next']);
            $this->task = new CurrentProject();
            
        } else if(isset($_POST['step_2_new'])) {
            unset($_POST['step_2_new']);
            $this->task = new NewProject();
            
        } else if(isset($_FILES['step_3_new'])) {
            //unset($_FILES['step_3_new']);
            $this->task = new UploadFile();
            
        } else if(isset($_POST['step_3_next'])) {
            unset($_POST['step_3_next']);
            $this->task = new UploadConfirm();
            
        } else if(isset($_POST['step_4_update'])) {
            unset($_POST['step_4_update']);
            $this->task = new UpdateFileDescription();
            
        } else if(isset($_POST['step_4_delete'])) {
            unset($_POST['step_4_delete']);
            $this->task = new DeleteFile();
            
        } else if(isset($_POST['step_4_next'])) {
            unset($_POST['step_4_next']);
            $this->task = new NewPage();
            
        } else if(isset($_POST['step_0_change_name'])) {
            unset($_POST['step_0_change_name']);
            $this->task = new ChangeName();
            
        } else if(isset($_POST['step_0_view'])) {
            unset($_POST['step_0_view']);
            $this->task = new ViewProject();
            
        } else if(isset($_POST['step_0_edit'])) {
            unset($_POST['step_0_edit']);
            $this->task = new EditProject();
            
        } else if(isset($_POST['step_0_delete'])) {
            unset($_POST['step_0_delete']);
            $this->task = new DeleteProject();
            
        } else if(isset($_REQUEST['LogOff'])) {
            unset($_REQUEST['LogOff']);
            $this->task = new LogOff();
        }
    }
}

$worker = new Access();

?>