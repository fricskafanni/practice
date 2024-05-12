<?php
require_once('./config.php');
/*---------------------
     PARTICIPAR
---------------------*/
if (isset($_GET['check'])){
    //CHECK ALL VARS
    if (!isset($_SESSION['ident_long']) 
        || !isset($_GET['email']) || $_GET['email']=='' 
        || !isset($_GET['name']) || $_GET['name']==''
        || !isset($_GET['newsletter']) || $_GET['newsletter']==''){
	    die(json_encode(array("result" => '403', "mensaje" => "ERROR FALTAN DATOS")));
    }
    
    if (!isset($_SESSION['paso1']) || $_SESSION['paso1']==true){
        die(json_encode(array("result" => '200', "mensaje" => "GANADOR:".$_SESSION['userID']."-".$_SESSION['customerID'], "consumer_id" =>$_SESSION['customerID'], "Ident_long" => $_SESSION['ident_long'])));
        
    }
    
    //CLEAN VARS
    $get = new stdClass();
    foreach ($_GET as $key => $value){
        $get->$key = limpiaVar($value);
    }
    
    //CLEAN email
    $emailRAW=normalize_email($get->email);
    $email=md5($emailRAW);
    if (!$email){
        die(json_encode(array("result" => '403', "mensaje" => "ERROR EMAIL")));
    }
    //OTHER DATA
    $nombre=$get->name;
    $_SESSION['nombre_usuario']=$nombre;
    $newsletter=$get->newsletter;
    $Ident_long=$_SESSION['ident_long'];
    
    $hoy = date("Y-m-d");
    //CHECK EMAIL GANADOR
    $mysqli = dbo();
    $_SESSION['userID']=0;
    $stmt = $mysqli->prepare("SELECT id,email,ganador,ultimo_intento FROM usuarios WHERE email=?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $existe=false;
    //LO TENEMOS EN BBDD
    while($fila = $resultado->fetch_assoc()){
        $existe=true;
        $fecha=$fila['ultimo_intento'];
        $ganador=$fila['ganador'];
        $_SESSION['userID']=$fila['id'];
        
        //CHECK SI YA GANADOR ANTERIOR
        if ($ganador==1){
            $stmt = $mysqli->prepare("UPDATE usuarios SET last_date = NOW(), ultimo_intento = ? WHERE email=?");
            $stmt->bind_param('ss', $hoy, $email);
            $stmt->execute();
            session_destroy();
            dbc($mysqli);
            die(json_encode(array("result" => '201', "mensaje" => "ERROR YA HA GANADO-".$fila['ganador'])));
        }
    }
    //NO LO TENEMOS
    if (!$existe){
        $stmt = $mysqli->prepare("INSERT INTO usuarios (email,ultimo_intento,create_date,last_date) VALUES (?,?,NOW(),NOW())");
        $stmt->bind_param('ss', $email,$hoy);
        $stmt->execute();
        $_SESSION['userID']=mysqli_stmt_insert_id ($stmt);
        session_destroy();
        dbc($mysqli);
        die(json_encode(array("result" => '200', "mensaje" => "INSERTADDO-".$fila['ganador'])));
            
    }
    
    
    dbc($mysqli);
    die(json_encode(array("result" => '403', "mensaje" => "NO DEBERIA LLEGAR AQUI")));
}

/*---------------------
  ENVIAR DATOS AMIGO
---------------------*/
if (isset($_GET['friend'])){
    
  
}
/*---------------------
  ENVIAR DATOS USUARIO
---------------------*/
if (isset($_GET['sendme'])){

}
/*---------------------
 FUNCIONES ADICIONALES
---------------------*/
function dbo(){
    $db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $tz = (new DateTime('now', new DateTimeZone('Europe/Madrid')))->format('P');
    $db->query("SET time_zone='$tz';");
    if($db->connect_errno) {
        echo 'Error al conectar a la bbdd.';
        exit();
    } else {
        $db->set_charset("utf8");
    }
    return $db;
}
function dbc($db){
    $db->close();
}
function limpiaVar($txt) {
	if (!is_array($txt)) {
		$txt = htmlspecialchars(strip_tags(stripslashes($txt)));
		return strtr($txt, array("\0" => "","'"  => "&#39;","\"" => "&#34;","\\" => "&#92;","<"  => "&lt;",">"  => "&gt;"));
	}
}
function normalize_email($email) {
    // 'mdlz.com', 'consultix.net', 'ogilvy.com', 
    $bad_domains = array('0815.ru','0wnd.net','0wnd.org','10minutemail.co.za','10minutemail.com','123-m.com','1fsdfdsfsdf.tk','1pad.de','20minutemail.com','21cn.com','2fdgdfgdfgdf.tk','2prong.com','30minutemail.com','33mail.com','3trtretgfrfe.tk','4gfdsgfdgfd.tk','4warding.com','5ghgfhfghfgh.tk','6hjgjhgkilkj.tk','6paq.com','7tags.com','9ox.net','a-bc.net','agedmail.com','ama-trade.de','amilegit.com','amiri.net','amiriindustries.com','anonmails.de','anonymbox.com','antichef.com','antichef.net','antireg.ru','antispam.de','antispammail.de','armyspy.com','artman-conception.com','azmeil.tk','baxomale.ht.cx','beefmilk.com','bigstring.com','binkmail.com','bio-muesli.net','bobmail.info','bodhi.lawlita.com','bofthew.com','bootybay.de','boun.cr','bouncr.com','breakthru.com','brefmail.com','bsnow.net','bspamfree.org','bugmenot.com','bund.us','burstmail.info','buymoreplays.com','byom.de','c2.hu','card.zp.ua','casualdx.com','cek.pm','centermail.com','centermail.net','chammy.info','childsavetrust.org','chogmail.com','choicemail1.com','clixser.com','cmail.net','cmail.org','coldemail.info','cool.fr.nf','courriel.fr.nf','courrieltemporaire.com','crapmail.org','cust.in','cuvox.de','d3p.dk','dacoolest.com','dandikmail.com','dayrep.com','dcemail.com','deadaddress.com','deadspam.com','delikkt.de','despam.it','despammed.com','devnullmail.com','dfgh.net','digitalsanctuary.com','dingbone.com','disposableaddress.com','disposableemailaddresses.com','disposableinbox.com','dispose.it','dispostable.com','dodgeit.com','dodgit.com','donemail.ru','dontreg.com','dontsendmespam.de','drdrb.net','dump-email.info','dumpandjunk.com','dumpyemail.com','e-mail.com','e-mail.org','e4ward.com','easytrashmail.com','einmalmail.de','einrot.com','eintagsmail.de','emailgo.de','emailias.com','emaillime.com','emailsensei.com','emailtemporanea.com','emailtemporanea.net','emailtemporar.ro','emailtemporario.com.br','emailthe.net','emailtmp.com','emailwarden.com','emailx.at.hm','emailxfer.com','emeil.in','emeil.ir','emz.net','ero-tube.org','evopo.com','explodemail.com','express.net.ua','eyepaste.com','fakeinbox.com','fakeinformation.com','fansworldwide.de','fantasymail.de','fightallspam.com','filzmail.com','fivemail.de','fleckens.hu','frapmail.com','friendlymail.co.uk','fuckingduh.com','fudgerub.com','fyii.de','garliclife.com','gehensiemirnichtaufdensack.de','get2mail.fr','getairmail.com','getmails.eu','getonemail.com','giantmail.de','girlsundertheinfluence.com','gishpuppy.com','gmial.com','goemailgo.com','gotmail.net','gotmail.org','gotti.otherinbox.com','great-host.in','greensloth.com','grr.la','gsrv.co.uk','guerillamail.biz','guerillamail.com','guerrillamail.biz','guerrillamail.com','guerrillamail.de','guerrillamail.info','guerrillamail.net','guerrillamail.org','guerrillamailblock.com','gustr.com','harakirimail.com','hat-geld.de','hatespam.org','herp.in','hidemail.de','hidzz.com','hmamail.com','hopemail.biz','ieh-mail.de','ikbenspamvrij.nl','imails.info','inbax.tk','inbox.si','inboxalias.com','inboxclean.com','inboxclean.org','infocom.zp.ua','instant-mail.de','ip6.li','irish2me.com','iwi.net','jetable.com','jetable.fr.nf','jetable.net','jetable.org','jnxjn.com','jourrapide.com','jsrsolutions.com','kasmail.com','kaspop.com','killmail.com','killmail.net','klassmaster.com','klzlk.com','koszmail.pl','kurzepost.de','lawlita.com','letthemeatspam.com','lhsdv.com','lifebyfood.com','link2mail.net','litedrop.com','lol.ovpn.to','lolfreak.net','lookugly.com','lortemail.dk','lr78.com','lroid.com','lukop.dk','m21.cc','mail-filter.com','mail-temporaire.fr','mail.by','mail.mezimages.net','mail.zp.ua','mail1a.de','mail21.cc','mail2rss.org','mail333.com','mailbidon.com','mailbiz.biz','mailblocks.com','mailbucket.org','mailcat.biz','mailcatch.com','mailde.de','mailde.info','maildrop.cc','maileimer.de','mailexpire.com','mailfa.tk','mailforspam.com','mailfreeonline.com','mailguard.me','mailin8r.com','mailinater.com','mailinator.com','mailinator.net','mailinator.org','mailinator2.com','mailincubator.com','mailismagic.com','mailme.lv','mailme24.com','mailmetrash.com','mailmoat.com','mailms.com','mailnesia.com','mailnull.com','mailorg.org','mailpick.biz','mailrock.biz','mailscrap.com','mailshell.com','mailsiphon.com','mailtemp.info','mailtome.de','mailtothis.com','mailtrash.net','mailtv.net','mailtv.tv','mailzilla.com','makemetheking.com','manybrain.com','mbx.cc','mega.zik.dj','meinspamschutz.de','meltmail.com','messagebeamer.de','mezimages.net','ministry-of-silly-walks.de','mintemail.com','misterpinball.de','moncourrier.fr.nf','monemail.fr.nf','monmail.fr.nf','monumentmail.com','mt2009.com','mt2014.com','mycard.net.ua','mycleaninbox.net','mymail-in.net','mypacks.net','mypartyclip.de','myphantomemail.com','mysamp.de','mytempemail.com','mytempmail.com','mytrashmail.com','nabuma.com','neomailbox.com','nepwk.com','nervmich.net','nervtmich.net','netmails.com','netmails.net','neverbox.com','nice-4u.com','nincsmail.hu','nnh.com','no-spam.ws','noblepioneer.com','nomail.pw','nomail.xl.cx','nomail2me.com','nomorespamemails.com','nospam.ze.tc','nospam4.us','nospamfor.us','nospammail.net','notmailinator.com','nowhere.org','nowmymail.com','nurfuerspam.de','nus.edu.sg','objectmail.com','obobbo.com','odnorazovoe.ru','oneoffemail.com','onewaymail.com','onlatedotcom.info','online.ms','opayq.com','ordinaryamerican.net','otherinbox.com','ovpn.to','owlpic.com','pancakemail.com','pcusers.otherinbox.com','pjjkp.com','plexolan.de','poczta.onet.pl','politikerclub.de','poofy.org','pookmail.com','privacy.net','privatdemail.net','proxymail.eu','prtnx.com','putthisinyourspamdatabase.com','putthisinyourspamdatabase.com','qq.com','quickinbox.com','rcpt.at','reallymymail.com','realtyalerts.ca','recode.me','recursor.net','reliable-mail.com','rhyta.com','rmqkr.net','royal.net','rtrtr.com','s0ny.net','safe-mail.net','safersignup.de','safetymail.info','safetypost.de','saynotospams.com','schafmail.de','schrott-email.de','secretemail.de','secure-mail.biz','senseless-entertainment.com','services391.com','sharklasers.com','shieldemail.com','shiftmail.com','shitmail.me','shitware.nl','shmeriously.com','shortmail.net','sibmail.com','sinnlos-mail.de','slapsfromlastnight.com','slaskpost.se','smashmail.de','smellfear.com','snakemail.com','sneakemail.com','sneakmail.de','snkmail.com','sofimail.com','solvemail.info','sogetthis.com','soodonims.com','spam4.me','spamail.de','spamarrest.com','spambob.net','spambog.ru','spambox.us','spamcannon.com','spamcannon.net','spamcon.org','spamcorptastic.com','spamcowboy.com','spamcowboy.net','spamcowboy.org','spamday.com','spamex.com','spamfree.eu','spamfree24.com','spamfree24.de','spamfree24.org','spamgoes.in','spamgourmet.com','spamgourmet.net','spamgourmet.org','spamherelots.com','spamherelots.com','spamhereplease.com','spamhereplease.com','spamhole.com','spamify.com','spaml.de','spammotel.com','spamobox.com','spamslicer.com','spamspot.com','spamthis.co.uk','spamtroll.net','speed.1s.fr','spoofmail.de','stuffmail.de','super-auswahl.de','supergreatmail.com','supermailer.jp','superrito.com','superstachel.de','suremail.info','talkinator.com','teewars.org','teleworm.com','teleworm.us','temp-mail.org','temp-mail.ru','tempe-mail.com','tempemail.co.za','tempemail.com','tempemail.net','tempemail.net','tempinbox.co.uk','tempinbox.com','tempmail.eu','tempmaildemo.com','tempmailer.com','tempmailer.de','tempomail.fr','temporaryemail.net','temporaryforwarding.com','temporaryinbox.com','temporarymailaddress.com','tempthe.net','thankyou2010.com','thc.st','thelimestones.com','thisisnotmyrealemail.com','thismail.net','throwawayemailaddress.com','tilien.com','tittbit.in','tizi.com','tmailinator.com','toomail.biz','topranklist.de','tradermail.info','trash-mail.at','trash-mail.com','trash-mail.de','trash2009.com','trashdevil.com','trashemail.de','trashmail.at','trashmail.com','trashmail.de','trashmail.me','trashmail.net','trashmail.org','trashymail.com','trialmail.de','trillianpro.com','twinmail.de','tyldd.com','uggsrock.com','umail.net','uroid.com','us.af','venompen.com','veryrealemail.com','viditag.com','viralplays.com','vpn.st','vsimcard.com','vubby.com','wasteland.rfc822.org','webemail.me','weg-werf-email.de','wegwerf-emails.de','wegwerfadresse.de','wegwerfemail.com','wegwerfemail.de','wegwerfmail.de','wegwerfmail.info','wegwerfmail.net','wegwerfmail.org','wh4f.org','whyspam.me','willhackforfood.biz','willselfdestruct.com','winemaven.info','wronghead.com','www.e4ward.com','www.mailinator.com','wwwnew.eu','x.ip6.li','xagloo.com','xemaps.com','xents.com','xmaily.com','xoxy.net','yep.it','yogamaven.com','yopmail.com','yopmail.fr','yopmail.net','yourdomain.com','yuurok.com','z1p.biz','za.com','zehnminuten.de','zehnminutenmail.de','zippymail.info','zoemail.net','zomg.info','ask-mail.com','digital-message.com','digitalmail.info','directmail24.net','eoffice.top','freehotmail.net','mail-hub.info','mail-share.com','nextmail.info','webmail24.top','mailboxy.fun');
    // Ensure email is lowercase because of pending in_array check, and more...
    $email = strtolower(trim($email));
    $parts = explode('@', $email);
    // Normalize gmail addresses
    if (in_array($parts[1], ['gmail.com', 'googlemail.com'])) {
                // Check if there is a "+" and return the string before then remove "."
                $before_plus = strstr($parts[0], '+', TRUE);
                $before_at = str_replace('.', '', $before_plus ? $before_plus : $parts[0]);
                // Ensure only @gmail.com addresses are used
                $email = $before_at.'@gmail.com';
    }
    if (in_array($parts[1], $bad_domains)){
                return false;
    }
    return $email;
}

?>