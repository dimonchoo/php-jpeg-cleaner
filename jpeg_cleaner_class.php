<?php

class jpeg_cleaner {
    
    private $filename;
    private $destination;    
    
    public function set_filename($filename) {
        
        $this->filename = $filename;
        
    }
    
    public function set_destination($destination) {
        
        $this->destination = $destination;  
        
    }
    
    public function clean() {
            
      //Zuerst handle erstellen um $filename binï¿½r auszulesen
      $handle = fopen($this->filename, "rb");

      //Anschlieï¿½end immer die Segmente mit der grï¿½ï¿½e auslesen
      $segment[] = fread($handle, 2);

      //Wenn die ersten beiden Bytes nicht 0xFF 0xD8 entsprechen - abbruch!
      if($segment[0] === "\xFF\xD8")
      {

        //Jetzt schauen ob neues Segment 0xFF entspricht - wenn nicht abbruch
        $segment[] = fread($handle, 1);

        //Wenn Segment vorhanden - fahre fort!
        if($segment[1] === "\xFF")
        {
            
          //Dateizeiger an den Anfang setzen
          rewind ($handle);

          //Nun wird die ganze Datei durchsucht
          while(!feof($handle))
          {

            $daten = fread($handle, 2);

            //Prï¿½fe auf spezielle Segmente - falls diese vorhanden sind -> Zeiger neu setzen
            if((preg_match("/FFE[1-9a-zA-Z]{1,1}/i",bin2hex($daten))) || ($daten === "\xFF\xFE"))
            {

              //Position des Dateizeigers
              $position = ftell($handle);

              //Grï¿½ï¿½e des Segments auslesen
              $size = fread($handle, 2);

              //Grï¿½ï¿½e ausrechnen
              $newsize = 256 * ord($size{0}) + ord($size{1});    

              //Hier nun neue Position bestimmen -> Position hinter dieser Zone
              $newpos = $position + $newsize;

              //Dateiziger setzen
              fseek($handle, $newpos);

            } else {

              $newfile[] = $daten;

            }

          }

          //Hier File Handle schlieï¿½en
          fclose($handle);

          //Wenn Schleife durch ist haben wir newfile als Array
          //Dieses wird nun in einen String umgewandelt
          $newfile = implode('',$newfile);    

            //Und schreiben dies nun in Angegebenen destination
            $handle = fopen($this->destination, "wb");
            
            fwrite($handle, $newfile);
            fclose($handle);
            
            return TRUE;

        } else {

        return FALSE;

        }

      } else {

      return FALSE;

      }   
            
    }
    
}

?>
