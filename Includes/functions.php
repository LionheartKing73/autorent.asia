<?php
function GetPartnerVisitFromIP( $connect )
{
 // Retrieves the last visit from this IP address and returns the partner (if found)
 
 $partnervisit=0;
 
 $S = new SqlHandler( $connect );
 $S->Sql = "select partner_visit_id, visit_datetime from partner_visit ";
 $S->Sql .= " WHERE ip_address = '".$_SERVER['REMOTE_ADDR']."' ";
 $S->Sql .= " AND DATE_ADD( now() , INTERVAL  -6 HOUR ) < visit_datetime ORDER BY visit_datetime DESC ";
  

 $S->Execute();
 
 
 if ( ! $S->SqlErrorNo )
 {
     $rec = $S->GetRecord();
     $partnervisit = $rec["partner_visit_id"];
 }   
    
 
 if ( ! $partnervisit )
    $partnervisit = 0;
    
    
 return $partnervisit;   
}