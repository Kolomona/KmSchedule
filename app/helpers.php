<?php
function convert_schedule_tohtml($inputText){

    // @inputText = raw delimited text
        // returns table rows and cells in html format
    // TODO: Add delimiter functionality find a way without global
    global $tblNumCols;
    
    $outstring = "";
    // Fetch each line into an array
    $linesArray = explode("\n", $inputText);
    
    // process each line as a row in the table
    $oddEven = "even";
    $rowCount = 0;
    
    // process each line as a row in the table
    foreach($linesArray as $row) {
      $rowCount = $rowCount + 1;
    
      // used for css styling
      if($oddEven=="even"){$oddEven="odd";}else {$oddEven="even";}
      //echo strlen($row);
      if (strlen($row)>0) { // For some reason there's an empty row at the bottom
        // get individual cells
        $cells = explode("\t", $row);
        if($rowCount==1){$tblNumCols = count($cells);} // get the nuber of columns, used for colspan later
        $outstring = $outstring.'<tr class="'.$oddEven.'">';
        $cellCount = 0;
    
        foreach ($cells as $cell) {
          $cellCount = $cellCount + 1;
          //replace blank cells with a filler otherwise html formatting breaks
          if ($cell=="") {$cell="&nbsp;";}
          // if first row then add css class
          if ($rowCount==1) {
            $outstring = $outstring.'<td class="headerRow kmCell">'.$cell.'</td>';
          }elseif($cellCount==1 || $cellCount== count($cells) ){
              $outstring = $outstring.'<td class="kmName kmCell">'.$cell.'</td>';
            }else{
              $outstring = $outstring.'<td class="kmCell">'.$cell.'</td>';
            }
        }//end cell processing
        $outstring = $outstring."</tr>\n";
       }// end row processing
     } // end line processing
    
    return $outstring;
    }


?>