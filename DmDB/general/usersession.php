<?php
  class usersession{
    var $orderField;
    var $orderDirection;
    var $orderCounter=0;
    var $whereStr='';
    var $filterdata;
    var $limit;
    var $lastSite;
    var $actPageNr = 1;
    var $counter=0;

    function setOrderingInfo($field=""){
        
        if ($field == $this->orderField) $this->orderCounter++;
        if ($this->orderCounter<3) {
        	$this->orderField = $field;
        	$this->orderDirection = ($this->orderDirection == 'ASC') ? "DESC":"ASC";
        	$this->orderCounter++;
        }
        else {
            $this->orderCounter = 0;
            $this->orderField = "";
            $this->orderDirection = "";
        }
    }
    
    function setOrderImage($field){
      if ($field == $this->orderField){
        if ($this->orderDirection == "ASC") echo '<img src="style/up.gif" \>';
        if ($this->orderDirection == "DESC") echo '<img src="style/down.gif" \>';
        else echo "";
      }
      else {
        echo "";
      }
    }
    
    function getWhereClause($formdata, $BaseSql="1"){
        $this->filterdata = $formdata;
        $this->actPageNr = 1;
        if ( is_array( $formdata ))
        {
        reset($formdata);
        $str = "";
        while (list($key, $val) = each($formdata)) {
            if ($val != '') {
            	$pos = strrpos($key,'_');
                if ($pos>0) {
                    if (substr($key,$pos) == '_min') {
                        $str .= " AND ".substr($key,0,strlen($key)-4)." >= '$val' ";
                    }
                    if (substr($key,$pos) == '_max') {
                        $str .= " AND ".substr($key,0,strlen($key)-4)." <= '$val' ";
                    }
                    if (substr($key,$pos) == '_val') {
                        $baseFiled=substr($key,0,strlen($key)-4);
                        if (isset($formdata[$baseFiled.'_mode'])) {
                            $mode = $baseFiled.'_mode';
                        	if ($formdata[$mode] == 'EXACTLY') {
                        		$str .= " AND $baseFiled='$val' ";
                        	}
                        	elseif (($formdata[$mode] == 'LIKE')){
                        	    $str .= " AND $baseFiled LIKE '$val%' ";
                        	}
                        }
                        else {
                      	    $str .= " AND $baseFiled LIKE '$val%' ";
                        }
                    }
                    

                }
            	
            }
        }    
        }
        return $this->whereStr=" WHERE $BaseSql $str";
    }
    
    function getValue($field){
        	if (isset($this->filterdata[$field])) {
        		echo ' value="'.$this->filterdata[$field].'"';
        		return ;
        	}
        echo ' value=""';
    }

    function getSelected($field,$value){
        	if (isset($this->filterdata[$field])) {
        	    if ($this->filterdata[$field] == $value) {
        	    	echo " selected ";
        	    	return;
        	    }
        		echo ' ';
        		return ;
        	}
       		return ;
    }
    
    
    function getOrderString(){
        if (isset($this->orderField) && $this->orderField != "") {
        	return " ORDER BY $this->orderField $this->orderDirection ";
        }
    }

  }
  
?>