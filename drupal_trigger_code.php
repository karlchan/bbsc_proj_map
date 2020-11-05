//This action is run by cron handled by a trigger setup in the 'system tab' of trigger configuration page.
$view = views_get_view('json_partner_data');
$display = $view->preview('page_2');


$good = array();
$count = 1;
foreach(preg_split("/(\r?\n)/", $display) as $line)
{
    //This is hard coded to grab line 6 from the views display specified above. If for some reason this changes, you need to put all the contents of display into the file and find the right line number again.
    if($count==6)
    {
            //needed to remove the last div tag from the line.
            $line = str_replace("</div>","",$line);
            //fixing something wrong with this one partner (301/woonsocket) (lattitude adds some scientific notation)
            $line = str_replace("42.8499999996827E-5","42.000969",$line);
            $good[] = $line;
    }
$count++;
}

file_unmanaged_save_data($good, 'public://bbsc-partner-map.json', FILE_EXISTS_REPLACE);