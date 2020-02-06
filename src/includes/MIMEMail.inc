 <?

/*
 * Class mime_mail              
 * Original implementation by Sascha Schumann <sascha@schumann.cx>
 * Modified by Tobias Ratschiller <tobias@dnet.it>:
 * - General code clean-up   
 * - separate body- and from-property
 * - killed some mostly un-necessary stuff
 * Modified by James Oltmans <joltmans@americanselect.com>:
 * - AOL/Netscape/Comcast compatibility added
 * - support for multipart/alternative added
*/


   
class mime_mail
{
   var $parts;
   var $to;
   var $from;
   var $headers;        
   var $subject;
   var $body;

/*
* void mime_mail()
* class constructor
*/                 
function mime_mail()
{
   $this->parts = array();
   $this->to = "";
   $this->from = "";
   $this->subject = "";       
   $this->headers = "";
   $this->body = "";
} 

/*
* void add_attachment(mixed message, [string name], [string ctype])
* Add an attachment to the mail object
*/
function add_attachment($message, $name = "", $ctype = "application/octet-stream")
{
   // Handle multipart/alternative
   // Allows for HTML, plain text, or any alternate representation of the data you choose
   // Proper usage is as follows:
   // The format you most prefer to show the user should be added last
   // while the format you least prefer (most compatible) should be added first
   // To add a multipart/alternative section all you need do is create an array like 
   // $multipartMsg = array("text/plain" => "Normal message", "text/html" => "<html>Formatted message</html>");
   // Then add it: add_attachment($multipartMsg);

   if(is_array($message))
   {
       $multi_boundary = "----=_".md5(uniqid(time()));
       foreach($message as $type => $altPart)
       {
           $tmpArr[] = array(
                   "ctype" => $type,      
                   "message" => $altPart
               );
       }
       $this->parts[] = array(
               "isAlt" => true,
               "boundary" => $multi_boundary, 
               "altParts" => $tmpArr
           );
   }
   // Normal attachment
   else
   {
       if(strstr($name, '/')) 
       { 
           $tmp = explode('/', $name); 
           $name = $tmp[count($tmp)-1]; // grab only the name not the directory junk
       }
       $this->parts[] = array (               
          "ctype" => $ctype,      
          "message" => $message,        
          "encode" => $encode,
          "name" => $name,
       );
   }
}

   
/*
* void build_message(array part=
* Build message parts of an multipart mail
*/
function build_message($part)
{
   $msgStr = "";
   $message = $part['message'];          
   
   if($part['ctype'] == "text/html" || $part['ctype'] == "text/plain")
   {   
       $msgStr = "Content-Type: {$part['ctype']};\n\tcharset=\"iso-8859-1\"" 
               . "\nContent-Transfer-Encoding: 8bit\n"
               . "\n$message\n";
   }
   else // must be a normal attachment
   {   
       // Only 64 bit encode chunks that aren't text
       $message = chunk_split(base64_encode($message));
       // Writes out:
       // Content-Type: <type, AKA application/octet-stream> OR
       // Content-Type: <type>;\n\tname = "<name>"
       $msgStr = "Content-Type: {$part['ctype']}" . ($part[ "name"]? ";\n\tname = \"{$part['name']}\"" : "") 
               . "\nContent-Transfer-Encoding: base64\n"
               . "Content-Disposition: attachment;\n\tfilename=\"{$part["name"]}\"\n"
               . "\n$message\n";
   }
   
   return $msgStr;
}             
           
/*           
* void build_multipart()
* Build a multipart mail
*/           
function build_multipart()
{ 
   $boundary = "----=_".md5(uniqid(time()));
   $multipart = "Content-Type: multipart/mixed;\n\t"
              .      "boundary=\"$boundary\"\n"
              . "\n"
              . "This is a multi-part message in MIME format.\n"
              . "\n"
              . "--$boundary";
   
   foreach($this->parts as $currPart)
   {
       // Build multipart/alternative
       if($currPart['isAlt'])
       {
           $tmpBoundary = $currPart['boundary'];
           $multipart .= "\nContent-Type: multipart/alternative;" 
                       . "\n\tboundary=\"$tmpBoundary\"\n"
                       . "\n"
                       . "\n"
                       . "--$tmpBoundary";
           foreach($currPart['altParts'] as $tmpParts)
           {
              $multipart .= "\n".$this->build_message($tmpParts). "--$tmpBoundary";
           }
           $multipart .= "--\n\n--$boundary";
       }
       else
       {
           $multipart .= "\n".$this->build_message($currPart). "--$boundary";
       }
   }
   return $multipart.= "--";
}
   
/*
* void send()
* Send the mail (last class-function to be called)
*/
function send()
{ 
   $mime = "";
   if (!empty($this->from))
      $mime .= "From: ".$this->from. "\n";
   if (!empty($this->headers))
      $mime .= $this->headers. "\n";
   if (!empty($this->body))
      $this->add_attachment($this->body, "", "text/plain");
      
   $mime .= "MIME-Version: 1.0\n".$this->build_multipart();
   mail($this->to, $this->subject, "", $mime);
} 
}; // end of class              
?> 