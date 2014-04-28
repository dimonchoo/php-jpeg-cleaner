php-jpeg-cleaner
================


Here now the class of my php jpeg cleaner its fully free to modify and use!
The class grabs the jpg file and cleanes it from metadata as comment blocks and exif headers.

Here an example how to use the class:


firstly create an object from the classe - like this:

  $handler = new jpeg_cleaner();


just define the source file from the class like this:

  $handler->set_filename("not_cleaned.jpg");


and the target file like this:

  $handler->set_destination("cleaned.jpg");


and then just run the clean method:

  $handler->clean();


the return of this class is either FALSE, if the progress was not successfull 
and TRUE, if the progress was successfull!

PS: just look at the example file - index.php!!!


                              __           ._____.                 
   ___________   ____   _____/  |_________ |__\_ |__   ___________ 
  / ___\_  __ \_/ __ \_/ __ \   __\___   / |  || __ \ /  _ \_  __ \
 / /_/  >  | \/\  ___/\  ___/|  |  /    /  |  || \_\ (  <_> )  | \/
 \___  /|__|    \___  >\___  >__| /_____ \ |__||___  /\____/|__|   
/_____/             \/     \/           \/         \/              

