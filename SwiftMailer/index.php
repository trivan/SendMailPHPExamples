<?php
/*
* @author tri.van<vanminhtri88@gmail.com>
*/

$CFG['smtp_debug']        = 2; //0 == off, 1 for client output, 2 for client and server
$CFG['smtp_debugoutput']  = 'html';
$CFG['smtp_server']       = 'smtp.gmail.com';
$CFG['smtp_port']         = '25';
$CFG['smtp_authenticate'] = false;
$CFG['smtp_username']     = 'name@example.com';
$CFG['smtp_password']     = 'yourpassword';
$CFG['smtp_secure']       = 'None';

$from_name             = ( isset($_POST['From_Name'])) ? $_POST['From_Name'] : '';
$from_email            = ( isset($_POST['From_Email'])) ? $_POST['From_Email'] : '';
$to_name               = ( isset($_POST['To_Name'])) ? $_POST['To_Name'] : '';
$to_email              = ( isset($_POST['To_Email'])) ? $_POST['To_Email'] : '';
$cc_email              = ( isset($_POST['cc_Email'])) ? $_POST['cc_Email'] : '';
$bcc_email             = ( isset($_POST['bcc_Email'])) ? $_POST['bcc_Email'] : '';
$subject               = ( isset($_POST['Subject'])) ? $_POST['Subject'] : '';
$message               = ( isset($_POST['Message'])) ? $_POST['Message'] : '';
$test_type             = ( isset($_POST['test_type'])) ? $_POST['test_type'] : 'smtp';
$smtp_debug            = ( isset($_POST['smtp_debug'])) ? $_POST['smtp_debug'] : $CFG['smtp_debug'];
$smtp_server           = ( isset($_POST['smtp_server'])) ? $_POST['smtp_server'] : $CFG['smtp_server'];
$smtp_port             = ( isset($_POST['smtp_port'])) ? $_POST['smtp_port'] : $CFG['smtp_port'];
$smtp_secure           = strtolower(( isset($_POST['smtp_secure'])) ? $_POST['smtp_secure'] : $CFG['smtp_secure']);
$smtp_authenticate     = ( isset($_POST['smtp_authenticate'])) ? $_POST['smtp_authenticate'] : $CFG['smtp_authenticate'];
$authenticate_password = ( isset($_POST['authenticate_password'])) ? $_POST['authenticate_password'] : $CFG['smtp_password'];
$authenticate_username = ( isset($_POST['authenticate_username'])) ? $_POST['authenticate_username'] : $CFG['smtp_username'];

$results_messages[] = "";

  if ( isset($_POST["submit"]) && $_POST['submit'] == "Submit" ) {

      require_once 'lib/swift_required.php';

    echo $smtp_server."<br/>";
    echo $smtp_port."<br/>";
    echo $authenticate_username."<br/>";

    $transport = Swift_SmtpTransport::newInstance($smtp_server, $smtp_port)
        ->setUsername($authenticate_username)
        ->setPassword($authenticate_password);

    $mailer = Swift_Mailer::newInstance($transport);

    $message = Swift_Message::newInstance('Wonderful Subject')
        ->setFrom(array('tri.van@kiss-concept.com' => 'Tri Van'))
        ->setTo(array('vanminhtri88@gmail.com', 'vanminhtri88@gmail.com' => 'Tri'));

    $message->setBody('<html>
    <body>
        <h2>Hi John!</h2><br><br>

        Johanna (johanna82) sent you a message.<br>

        <p>
            Hi John. Amazing picture... <a href="http://www.awesome.com/msg/12345/read/">login and read the full message</a>
        </p>

        Best regards,<br>
        Photos4Lulz
    </body>
</html>');

    if (!$mailer->send($message, $errors))
    {
        echo "Error:";
        print_r($errors);
    }
  }

?><!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>SwiftMailer Test Page</title>
  <script type="text/javascript" src="scripts/shCore.js"></script>
  <script type="text/javascript" src="scripts/shBrushPhp.js"></script>
  <link type="text/css" rel="stylesheet" href="styles/shCore.css">
  <link type="text/css" rel="stylesheet" href="styles/shThemeDefault.css">
  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
      font-size: 1em;
      padding: 1em;
    }
    table {
      margin:0 auto;
      border-spacing: 0;
      border-collapse: collapse;
    }
    table.column {
      border-collapse: collapse;
      background-color: #FFFFFF;
      padding: 0.5em;
      width: 35em;
    }
    td {
      font-size: 1em;
      padding: 0.1em 0.25em;
      -moz-border-radius: 1em;
      -webkit-border-radius: 1em;
      border-radius: 1em;
    }
    td.colleft {
      text-align: right;
      width: 35%;
    }
    td.colrite {
      text-align: left;
      width: 65%;
    }
    fieldset {
      padding: 1em 1em 1em 1em;
      margin: 0 2em ;
      border-radius: 1.5em;
      -webkit-border-radius: 1em;
      -moz-border-radius: 1em;
    }
    fieldset.inner {
      width:40%;
    }
    fieldset:hover, tr:hover {
      background-color: #fafafa;
    }
    legend {
      font-weight: bold;
      font-size: 1.1em;
    }
    div.column-left {
      float:left;
      width:45em;
      height:31em;
    }
    div.column-right {
      display:inline;
      width:45em;
      max-height:31em;
    }
    input.radio {
      float:left;
    }
    div.radio {
      padding: 0.2em;
    }
  </style>
  <script>
    SyntaxHighlighter.config.clipboardSwf = 'scripts/clipboard.swf';
    SyntaxHighlighter.all();

    function startAgain() {
      var post_params = {
        "From_Name" :            "<?php echo $from_name; ?>",
        "From_Email":            "<?php echo $from_email; ?>",
        "To_Name"   :            "<?php echo $to_name; ?>",
        "To_Email"  :            "<?php echo $to_email; ?>",
        "cc_Email"  :            "<?php echo $cc_email; ?>",
        "bcc_Email" :            "<?php echo $bcc_email; ?>",
        "Subject"   :            "<?php echo $subject; ?>",
        "Message"   :            "<?php echo $message; ?>",
        "test_type" :            "<?php echo $test_type; ?>",
        "smtp_debug":            "<?php echo $smtp_debug; ?>",
        "smtp_server":           "<?php echo $smtp_server; ?>",
        "smtp_port"  :           "<?php echo $smtp_port; ?>",
        "smtp_secure":           "<?php echo $smtp_secure; ?>",
        "smtp_authenticate":     "<?php echo $smtp_authenticate; ?>",
        "authenticate_username": "<?php echo $authenticate_username; ?>",
        "authenticate_password": "<?php echo $authenticate_password; ?>"
      };

      var resetForm = document.createElement("form");
      resetForm.setAttribute("method", "POST");
      resetForm.setAttribute("path", "index.php");

      for(var k in post_params) {
        var h = document.createElement("input");
        h.setAttribute("type", "hidden");
        h.setAttribute("name", k);
        h.setAttribute("value", post_params[k]);
        resetForm.appendChild(h);
      }

      document.body.appendChild(resetForm);
      resetForm.submit();
    }

    function showHideDiv(test, element_id) {
      var ops = {"smtp-options-table" : "smtp"};

      if (test == ops[element_id]) {
        document.getElementById(element_id).style.display="block";
      } else {
        document.getElementById(element_id).style.display="none";
      }
    }
  </script>
</head>
<body>
  <?php
    if (version_compare(PHP_VERSION, '5.0.0', '<')) {
      echo 'Current PHP version: ' . phpversion() . "<br>";
      echo exit("ERROR: Wrong PHP version. Must be PHP 5 or above.");
    }

    if (count($results_messages) > 0) {
      echo '<h2>Run results : </h2>';
      echo '<ul>';
      foreach ($results_messages as $result) {
		if(!empty($result))
        echo "<li>$result</li>";
      }
      echo '</ul>';
    }

    if (isset($_POST["submit"]) && $_POST["submit"] == "Submit") {
        echo "<button type=\"submit\" onclick=\"startAgain();\">Start Over</button><br>\n";
        echo "<br><span>Script:</span>\n";
        echo "<pre class=\"brush: php;\">\n";
        echo $example_code;
        echo "\n</pre>\n";
        echo "\n<hr style=\"margin: 3em;\">\n";
      }
  ?>
  <form method="POST" enctype="multipart/form-data">
    <div>
      <div class="column-left">
        <fieldset>
          <legend>Mail Details</legend>
          <table border="1" class="column">
            <tr>
              <td class="colleft">
                <label for="From_Name"><strong>From</strong> Name</label>
              </td>
              <td class="colrite">
                <input type="text" id="From_Name" name="From_Name" value="<?php echo $from_name; ?>" style="width:95%;" autofocus placeholder="Your Name">
              </td>
            </tr>
            <tr>
              <td class="colleft">
                <label for="From_Email"><strong>From</strong> Email Address</label>
              </td>
              <td class="colrite">
                <input type="text" id="From_Email" name="From_Email" value="<?php echo $from_email; ?>" style="width:95%;" required placeholder="Your.Email@example.com">
              </td>
            </tr>
            <tr>
              <td class="colleft">
                <label for="To_Name"><strong>To</strong> Name</label>
              </td>
              <td class="colrite">
                <input type="text" id="To_Name" name="To_Name" value="<?php echo $to_name; ?>" style="width:95%;" placeholder="Recipient's Name">
              </td>
            </tr>
            <tr>
              <td class="colleft">
                <label for="To_Email"><strong>To</strong> Email Address</label>
              </td>
              <td class="colrite">
                <input type="text" id="To_Email" name="To_Email" value="<?php echo $to_email; ?>" style="width:95%;" required placeholder="Recipients.Email@example.com">
              </td>
            </tr>
            <tr>
              <td class="colleft">
                <label for="cc_Email"><strong>CC Recipients</strong><br><small>(separate with commas)</small></label>
              </td>
              <td class="colrite">
                <input type="text" id="cc_Email" name="cc_Email" value="<?php echo $cc_email; ?>" style="width:95%;" placeholder="cc1@example.com, cc2@example.com">
              </td>
            </tr>
            <tr>
              <td class="colleft">
                <label for="bcc_Email"><strong>BCC Recipients</strong><br><small>(separate with commas)</small></label>
              </td>
              <td class="colrite">
                <input type="text" id="bcc_Email" name="bcc_Email" value="<?php echo $bcc_email; ?>" style="width:95%;" placeholder="bcc1@example.com, bcc2@example.com">
              </td>
            </tr>
            <tr>
              <td class="colleft">
                <label for="Subject"><strong>Subject</strong></label>
              </td>
              <td class="colrite">
                <input type="text" name="Subject" id="Subject" value="<?php echo $subject; ?>" style="width:95%;" placeholder="Email Subject">
              </td>
            </tr>
            <tr>
              <td class="colleft">
                <label for="Message"><strong>Message</strong><br><small>If blank, will use content.html</small></label>
              </td>
              <td class="colrite">
                <textarea name="Message" id="Message" style="width:95%;height:5em;" placeholder="Body of your email"><?php echo $message; ?></textarea>
              </td>
            </tr>
          </table>
          <div style="margin:1em 0;">Test will include two attachments.</div>
        </fieldset>
      </div>
      <div class="column-right">
        <fieldset class="inner"> <!-- SELECT TYPE OF MAIL -->
          <legend>Mail Test Specs</legend>
          <table border="1" class="column">
            <tr>
              <td class="colleft">Test Type</td>
              <td class="colrite">
                <div class="radio">
                  <label for="radio-smtp">SMTP</label>
                  <input class="radio" type="radio" name="test_type" value="smtp" id="radio-smtp" onclick="showHideDiv(this.value, 'smtp-options-table');" <?php echo ( $test_type == 'smtp') ? 'checked' : ''; ?> required>
                </div>
              </td>
            </tr>
          </table>
          <div id="smtp-options-table" style="margin:1em 0 0 0; <?php if($test_type != 'smtp') {echo "display: none;";}?>">
            <span style="margin:1.25em 0; display:block;"><strong>SMTP Specific Options:</strong></span>
            <table border="1" class="column">
              <tr>
                <td class="colleft"><label for="smtp_server">SMTP Server</label></td>
                <td class="colrite">
                  <input type="text" id="smtp_server" name="smtp_server" value="<?php echo $smtp_server; ?>" style="width:95%;" placeholder="smtp.server.com">
                </td>
              </tr>
              <tr>
                <td class="colleft" style="width: 5em;"><label for="smtp_port">SMTP Port</label></td>
                <td class="colrite">
                  <input type="text" name="smtp_port" id="smtp_port" size="3" value="<?php echo $smtp_port; ?>" placeholder="Port">
                  </td>
              </tr>
              <tr>
                <td class="colleft" ><label for="smtp_secure">SMTP Security</label></td>
                <td>
                  <select size="1" name="smtp_secure" id="smtp_secure">
                    <option <?php echo ( $smtp_secure == 'none') ? 'selected' : ''?>>None</option>
                    <option <?php echo ( $smtp_secure == 'tls')  ? 'selected' : ''?>>TLS</option>
                    <option <?php echo ( $smtp_secure == 'ssl')  ? 'selected' : ''?>>SSL</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td class="colleft"><label for="smtp-authenticate">SMTP Authenticate?</label></td>
                <td class="colrite">
                  <input type="checkbox" id="smtp-authenticate" name="smtp_authenticate" <?php if ($smtp_authenticate!=''){ echo "checked";} ?> value="<?php echo $smtp_authenticate; ?>">
                </td>
              </tr>
              <tr>
                <td class="colleft"><label for="authenticate_username">Authenticate Username</label></td>
                <td class="colrite">
                  <input type="text" id="authenticate_username" name="authenticate_username" value="<?php echo $authenticate_username; ?>" style="width:95%;" placeholder="SMTP Server Username">
                </td>
              </tr>
              <tr>
                <td class="colleft"><label for="authenticate_password">Authenticate Password</label></td>
                <td class="colrite">
                  <input type="password" name="authenticate_password" id="authenticate_password" value="<?php echo $authenticate_password; ?>" style="width:95%;" placeholder="SMTP Server Password">
                </td>
              </tr>
            </table>
          </div>
        </fieldset>
      </div>
      <br style="clear:both;">
      <div style="margin-left:2em; margin-bottom:5em; float:left;">
        <div style="margin-bottom: 1em; ">
          <input type="submit" value="Submit" name="submit">
        </div>
        <?php echo 'Current PHP version: ' . phpversion(); ?>
      </div>
    </div>
  </form>
</body>
</html>