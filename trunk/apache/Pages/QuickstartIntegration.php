<?php include('.Header.tpl.php'); ?>

<p><a name="Overview"></a><font size="2"><b>Overview</b></font></p>
<div style="padding-left: 10px;">
<p>The easiest and quickest way to get started with FirePHP is to use the <b><i>Default</i> FirePHP API Wrapper</b> provided with the PEAR release. The wrapper takes care of all the initialization work for a standard setup and allows for easy customization via a simple PHP array.</p>
</div>

<p><a name="Code"></a><font size="2"><b>The Code</b></font></p>
<div style="padding-left: 10px;">
<p>Place the following few lines of code at the very beginning of your application.</p>
<p>Security is important as FirePHP can expose a lot of information that others can use to hack your application. So lets get used to being careful right away. Make sure you change the security key to something unique (I recommend a MD5 hash). You must also set this same key as the value to a cookie called <b>FirePHP-AccessKey</b> in your firefox browser. If you don't know how to set this cookie with the SetCookie() PHP function in an authenticated way then I am not sure if you should use FirePHP as you will probably not be able to keep it secure.</p>
<?php ob_start(); ?>

/* Initialize the FirePHP API */
require_once('FirePHP/Init.inc.php');

/* Set the FirePHP-AccessKey which will be compared to the cookie */
FirePHP::SetAccessKey('j8938jghh383hh383ghihgkk93rd3kde');

/* Initialize the Default Wrapper */
FirePHP::InitWrapper('Default');

/* YOUR CODE GOES HERE */

<?php
print highlight_string('<?php '."\n".ob_get_clean().'?>',true);
?>
</div>

<p><a name="Expectations"></a><font size="2"><b>What to Expect</b></font></p>
<div style="padding-left: 10px;">
<p>When you now load a page in your application, the cookie has been set and the FirePHP code is called properly you should see the request appear in the FirePHP tab of your Firebug extension. When selecting the request you should see a few variables and when you click on a variable it's value should also show.</p>
</div>

<p><a name="Expectations"></a><font size="2"><b>Not Working?</b></font></p>
<div style="padding-left: 10px;">
<p>Make sure you have the latest version of <a target="_blank" href="http://www.getfirebug.com/">Firebug</a> installed as well as the <a target="_blank" href="http://www.firephp.org/Downloads/#LatestBuildRelease">latest <font color="#FF6600"><b>BUILD</b></font> version of FirePHP</a>. Also make sure that the <b>FirePHP-AccessKey</b> cookie is set and the server is in fact receiving it. If its still not working <a target="_blank" href="http://www.firephp.org/Contact.htm">Contact</a> me.</p>
</div>



<p><a name="More"></a><font size="2"><b>Ready for more intelligence information?</b></font></p>
<div style="padding-left: 10px;">
<p>Now that your basic setup is working you can get started on generating more intelligence information with the FirePHP API.</p>
<p>Simply use the following method in your application to record additional variables:</p>
<?php ob_start(); ?>

FirePHP::SetVariable(true,'VariableName','VariableValue');

<?php
print highlight_string('<?php '."\n".ob_get_clean().'?>',true);
?>
<p>The <i>VariableValue</i> can be any PHP type (string, integer, array, etc...) but keep in mind that it must be serializable and should not contain too much data as it will be sent over the internet to the client.</p>
<p>For all available API methods see the <a href="/Pages/APIReference.php">API Reference</a>.</p>
<p>To customize the default API wrapper see the <a href="/Pages/DefaultAPIWrapper.php">Default API Wrapper</a> Reference.</p>
</div>



<?php include('.Footer.tpl.php'); ?>