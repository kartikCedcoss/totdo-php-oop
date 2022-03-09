<?php
session_start();
if(!isset($_SESSION['add'])){
    $_SESSION['add'] = array();
}
if(!isset($_SESSION['comp'])){
    $_SESSION['comp'] = array();
}
?>

<?php
 $work= $_POST['w'];
 $uptask = $_POST['uptask'];
 $uid = $_POST['upid'];
 $removeid = $_POST['removeid'];
 $cid=$_POST['id'];
 $action= $_POST['action'];

 class todo{
    public $act;
    public $id;
    public function __construct($work){
        $this->act = $work;
    }
    function add(){
       
        array_push($_SESSION['add'],$this->act);
        
    }

    function update(){
        
        array_splice($_SESSION['add'],$_POST['upid'] ,1, $this->act);
        
        
    }
    function remove(){
        array_splice($_SESSION['add'],$this->act ,1);
    }
   function complete(){
    array_push($_SESSION['comp'],$_SESSION['add'][$this->act]);
    array_splice($_SESSION['add'],$this->act ,1);

   }
 }



switch($action){

    case 'add':
        {
            $obj = new todo($work);
            $obj->add();
            echo json_encode($_SESSION['add']);
        }
        break;
    case 'update':
            {
            
              $obj = new todo($uptask);
               $obj->update();
            echo json_encode($_SESSION['add']);
            }
            break;

            case 'remove':
                {
                
                  $obj = new todo($removeid);
                   $obj->remove();
                echo json_encode($_SESSION['add']);
                }
                break;

                case 'comp':
                    {
                    
                      $obj = new todo($cid);
                       $obj->complete();
                    echo json_encode($_SESSION['comp']);
                    }
                    break;

}



?>