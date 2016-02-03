<?php


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class ActiveRecordLogableBehavior extends CActiveRecordBehavior
{
    private $_oldattributes = array();
    private $_primarykeys;
    private $desc;
    public function afterSave($event)
    {   
        if(is_array($this->Owner->getPrimaryKey()))
        $_primarykeys = implode(',', $this->Owner->getPrimaryKey()) ;
        else
          $_primarykeys = $this->Owner->getPrimaryKey();  
        
        if(get_class($this->getOwner()) === 'Evaluator'){
            $desc ='ID = '. $_primarykeys . 'and name = '. $this->getOwner()->username;
        }else if(get_class($this->getOwner()) === 'Criteria'){
            $desc = 'ID = ' . $_primarykeys .'and name = '. $this->getOwner()->name;
        }
        else if(get_class($this->getOwner()) === 'AppelOffre'){
            $desc = 'ID = ' . $_primarykeys .'and titre = '. $this->getOwner()->titre;
        }
        else{
            $desc = $_primarykeys;
        }
    
        if (!$this->Owner->isNewRecord) {
                
            // new attributes
            $newattributes = $this->Owner->getAttributes();
            $oldattributes = $this->getOldAttributes();
            
            // compare old and new
            foreach ($newattributes as $name => $value) {
                if (!empty($oldattributes)) {
                    $old = $oldattributes[$name];
                } else {
                    $old = '';
                }
 
                if ($value != $old) {
                    
                    $log=new UserLog;
                    $log->details = 'User ' . Yii::app()->user->name 
                                            . ' changed ' . $name . ' for ' 
                                            . get_class($this->Owner) 
                                            . '[' . $desc .'].';
                    $log->action = 'Update';
                    $log->username = Yii::app()->user->Name;
                    $log->ipaddress = $_SERVER['REMOTE_ADDR'];
                    $log->logtime = date("Y-m-d H:i:s");
                    $log->controller = get_class($this->Owner);
                    
                    $log->save();
                }
            }
        } else {
            $log=new UserLog;
            $log->details=  'User ' . Yii::app()->user->Name 
                                    . ' created ' . get_class($this->Owner) 
                                    . '[' . $_primarykeys .'].';
            $log->action=       'CREATE';
            $log->username = Yii::app()->user->Name;
                    $log->ipaddress = $_SERVER['REMOTE_ADDR'];
                    $log->logtime = date("Y-m-d H:i:s");
                    $log->controller = get_class($this->Owner);
            $log->save();
        }
    }
 
    public function afterDelete($event)
    {
         if(is_array($this->Owner->getPrimaryKey()))
        $_primarykeys = implode(',', $this->Owner->getPrimaryKey()) ;
        else
          $_primarykeys = $this->Owner->getPrimaryKey();
        $log=new UserLog;
            $log->details=  'User ' . Yii::app()->user->Name 
                                    . ' deleted ' . get_class($this->Owner) 
                                    . '[' .$_primarykeys .'].';
        $log->action=       'DELETE';
        $log->username = Yii::app()->user->Name;
                    $log->ipaddress = $_SERVER['REMOTE_ADDR'];
                    $log->logtime = date("Y-m-d H:i:s");
                    $log->controller = get_class($this->Owner);
            $log->save();
    }
 
    public function afterFind($event)
    {
        // Save old values
        $this->setOldAttributes($this->Owner->getAttributes());
    }
 
    public function getOldAttributes()
    {
        return $this->_oldattributes;
    }
 
    public function setOldAttributes($value)
    {
        $this->_oldattributes=$value;
    }
}
?>
