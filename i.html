<?php
require_once "mail/class.phpmailer.php";
//singletion Yapısı
//$y = ints::singb(ints::tipyer());
abstract class ints{
		function __construct(){
			
			$ayarcek = new ayarlar();
			$ayar = $ayarcek->ayaral();
			
			$veri = Autoloader::sunucu();
			$sunucutipi = $veri["mysqlnd"]["API Extensions "];
			
			if($ayar[4]==2){
				if(strstr($sunucutipi,"mysqli")){ 
					$dbb = @new mysqli($ayar[0],$ayar[1],$ayar[2],$ayar[3]);
					$result = mysqli_query($dbb,"SELECT * FROM ayar");
					@$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
					return @$row['ayar_bagtip'];
				}else{
					echo "Sunucuda [Mysqli] Drive Yüklü değil<br>Normal Mysql ile bağlanın<br>";
					exit();
				}
			}else{
				if(strstr($sunucutipi,"mysqli")){ 
					echo "Sunucuda [mysql] Yeni versiyonu Yüklü Lütfen Mysqli İle bağlanın<br>";
					exit();
				}else{
					$dbb = mysql_connect($ayar[0],$ayar[1],$ayar[2]);
					mysql_select_db($ayar[3],$dbb);
					$result = mysql_query("SELECT * FROM ayar");
					$row = mysql_fetch_array($result);	
					return $row['ayar_bagtip'];
				}
			}
			
		}
	
		private static $instance;
		
		static function tipyer(){
			foreach(get_declared_classes() as $class){
				$c[] = $class;
			}
			return	$c = end($c);
		}
		
		static function singletion($x){
				if(!self::$instance instanceof $x){
					self::$instance = new $x();
				}
				return self::$instance;
		}
		
		static function singb($x){
			self::$instance = null;
			return $x = self::singletion($x);
		}
		
}
class database extends ints{
	
			private $sayfa; // gelen url'i tutacak
			private $toplamkayit;// Toplam sayfa sayısını tutacak
			private $sayfasayisi;// sayfa sayısını tutacak
			private $limit;// kaç tane veri gelecegini tutacak
			private $html;//html çıktı
			
			public  $ip;        //istemci ip adresi
			public  $saat;      //zaman Y-m-d G:i:s
			public  $bugun;     //zaman Y-m-d
			public  $yıl;    	//zaman    Y
	
			protected $vt;
			private $ayarlar;
			protected $sor;
			public $veri;
			protected $sql;
			public $sonid;
			public $say;
			public $ikontrol;
			public $sunucutipveri;
			public $dbtip;
			
			
			function __get($name){return $name . " isimli değişken Erişilemez";}
			
			function __set($name,$value){return $name."isimli değişkene = ".$value." Atanamaz";}
			public function __clone(){
				trigger_error('Nesne çoğaltılamaz!', E_USER_ERROR);
			}
			
			function __construct(){
				$this->dbtip = parent::__construct();
				$veri = Autoloader::sunucu();
				$this->sunucutipveri = $veri["mysqlnd"]["API Extensions "];
				if($this->dbtip==2){
						if(strstr($this->sunucutipveri,"mysqli")){ 
							$this->baglan();
						}else{
							echo "Şuan [2 seçenek] Mysqli Tipinde Ayarlarınız<br>";
							echo "Sunucunuz Mysql Destekliyor !! Seçtiğiniz [MYSQLİ 'olan ] bağlantı tipini değiştirin";
							exit();
						}
				}else{
					if(strstr($this->sunucutipveri,"mysqli")){ 
						echo "Şuan [1 seçenek] Mysql Tipinde Ayarlarınız<br>";
						echo "Sunucunuz Mysqli destekliyor !! Seçtiğiniz [MYSQL ' olan] bağlantı tipini değiştirin";
						exit();
					}else{
						$this->baglan();
					}	
				}
			}	
			
			
			function __destruct(){
				if($this->dbtip==2){
					if(strstr($this->sunucutipveri,"mysqli")){ 
						@mysqli_close($this->vt);
					}
				}else{
					if(!strstr($this->sunucutipveri,"mysqli")){
						@mysql_free_result($this->sor);
						@mysql_close($this->vt);
					}
				}				
			}
			
			
			function baglan(){
				$this->ayarlar = new ayarlar();
				$t = $this->ayarlar->ayaral();	
				if($this->dbtip==2){
						$this->vt = @new mysqli($t[0],$t[1],$t[2],$t[3]);
						if($this->vt->connect_error) die('baglanti hatası'.$this->vt->connect_error);
							if(function_exists('mysqli_stmt_get_result')==false){
								die('mysqli msqInd Sürücü Desteği sunucunuzda yok');
							}
						$this->varsayılan();
						$this->_init_charset();
				}else{
						 $this->vt = mysql_connect($t[0],$t[1],$t[2]) or die("Mysql Hatası");
						 if($this->vt){
							 $db = mysql_select_db($t[3],$this->vt) or die("Tablo Adi hatası");
							 mysql_query("SET NAMES 'utf8'");
							 $this->varsayılan();
							 $this->_init_charset();
						 }	
				}
			}
			
			function dbtipgetir(){
				echo $this->dbtip;
			}
			
		
			public function verioku(){
				if($this->dbtip==2){
					return $veri = @mysqli_fetch_object($this->sor);
				}else{
					if(!strstr($this->sunucutipveri,"mysqli")){ 
						return $veri = @mysql_fetch_object($this->sor);
					}
				}
			}
			
			function sql(){
				echo $this->sql;
			}
			
			
			function array_insert($arr){
				foreach($arr as $key=>$val){@$keys.="$key,";@$vals.="$val,";}
				$keys=substr($keys,0,-1);
				$vals=substr($vals,0,-1);
				return array($keys,$vals);
			}
			
			function array_update($arr){ 
				foreach($arr as $key=>$val)	
					@$str.="$key=$val,";
				return substr($str,0,-1);
			}
			
			private function varsayılan(){
				$this->ip = hfk::kontrol($_SERVER['REMOTE_ADDR'],'text');
				$this->saat=date('Y-m-d G:i:s' ,strtotime('now'));
				$this->bugun=date('Y-m-d',strtotime('now'));
				$this->yıl=date('Y',strtotime('now'));
			}
			
			
			public function _init_charset(){ 
				if($this->dbtip==2){
					mysqli_query($this->vt,"SET NAMES UTF8"); 
					mysqli_query($this->vt,"SET character_set_client = 'utf8'"); 
					mysqli_query($this->vt,"SET character_set_results = 'utf8'"); 
					mysqli_query($this->vt,"SET character_set_connection = 'utf8'"); 
				}else{
					mysql_query("SET NAMES UTF8"); 
					mysql_query("SET character_set_client = 'utf8'"); 
					mysql_query("SET character_set_results = 'utf8'"); 
					mysql_query("SET character_set_connection = 'utf8'"); 
				}
			}
			
			
			//Kullanımı -> kolonad("test","a",true);
			//tablo ismi verilecek
			public function kolonad($tablo,$dbtip){
				$dbtablo = new ayarlar();
				$tb = $dbtablo->ayaral();
				if($dbtip==2){
					$this->sor = mysqli_query($this->vt,"SHOW COLUMNS FROM {$tablo}");
					echo ''.$tablo.'-->Tablosunun / kolonlari<br>';
					while($d=mysqli_fetch_array($this->sor)){
					echo $d[0]."->"; //Sutun adini yazar
					echo "".$d[1]."  <br>";// Sutun tipini yazar
					}
				}else{
					//Sunucuya Atıldığı zaman
					mysql_select_db($tb[3]);
					$this->sor = mysql_query("SHOW COLUMNS FROM {$tablo}");
					echo ''.$tablo.'-->Tablosunun / kolonlari<br>';
					while($d=mysql_fetch_array($this->sor)){
					echo $d[0]."->"; //Sutun adini yazar
					echo "".$d[1]."  <br>";// Sutun tipini yazar
					}  
				}
			}
			
			//Kullanımı tabload("test",true);
			//database kendi adı verilecek panel2019
			public function tabload($tablo,$dbtip){
				$dbtablo1 = new ayarlar();
				$tb1 = $dbtablo1->ayaral();
				$this->_init_charset();
				if($dbtip==2){
					$this->sor = mysqli_query($this->vt,"SHOW TABLES FROM {$tablo}");
					echo '<hr>'.$tablo.'-->Database Kolonlari<br>';
					while($d=mysqli_fetch_array($this->sor)){
						echo $d[0]."    <a href=''>Boşalt</a>  |  <a href=''>Tablo Sil</a><br>"; //Sutun adini yazar
					}  
				}else{
					//Sunucuya Atıldığı zaman
					mysql_select_db($tb1[3]);
					$this->sor = mysql_query("SHOW TABLES FROM {$tablo}");
					echo '<hr>'.$tablo.'-->Database Kolonlari<br>';
					while($d=mysql_fetch_array($this->sor)){
						echo $d[0]."<br>"; //Sutun adini yazar
					}  
				}
			}
			
			
			//sayfalama
			public function pagination($toplamkayit, $sayfalimit, $url,$tips=1){
				$this->limit = $sayfalimit;
				$this->toplamkayit = $toplamkayit;
				$this->sayfasayisi = ceil($this->toplamkayit / $this->limit);
				if($tips) { $this->sayfa = isset($_GET[$url]) ? $_GET[$url] : 1;}//normal link
				else {//seolu link için
					$sayfa = $_GET['link'];
					$sayfa = rtrim($sayfa, '/');
					$link =explode('/',$sayfa);
					$linksayisi = count($link);
					if($linksayisi >= 2 && ($link[$linksayisi-2]=='sayfa')) {
						$sayfa = $link[$linksayisi-1];
						$sayfa = isset($sayfa) ? (int) $sayfa : 1;
						if($sayfa < 1) $sayfa = 1; 
						if($sayfa >   $this->sayfasayisi) $sayfa =   $this->sayfasayisi; 
					}else{$sayfa =1;}
					$this->sayfa = $sayfa;
				}
				if($this->sayfa) $start = ($this->sayfa * $this->limit) - $this->limit;
				else $start = 0;
				return array(
					"start" => $start,
					"limit" => $this->limit
				);
			}
			/**
			 * @param $url
			 * @return html
			*/
	
			public function showPagination($url){
				if ($this->toplamkayit > $this->limit) {
					$this->html ='<span class="sayfa">'.$this->sayfasayisi.' sayfadan '.$this->sayfa.'. görüntüleniyor.</span>';
					if($this->sayfa  != 1) $this->html .= '<a href="' . str_replace('[sayfa]',$this->sayfa-1 , $url) . '">Önceki</a>';
					//echo $this->sayfa;
				
					$bitis = ($this->sayfa==1) ? $this->sayfa + 7 + 1 : $this->sayfa + 4 + 1;
					for ($i = $this->sayfa - 4; $i < $bitis; $i++) {
						if ($i > 0 && $i <= $this->sayfasayisi) {
							$this->html .= ' <a ';
							$this->html .= ($i == $this->sayfa ? 'class="aktif"' : null);
							$this->html .= ' href="' . str_replace('[sayfa]', $i, $url) . '">' . $i . '</a>';
						}
					}
					if($this->sayfa != $this->sayfasayisi) $this->html .= '<a href="' . str_replace('[sayfa]', $this->sayfa+1, $url) . '">&nbsp;Sonraki</a>';
					return $this->html;
				}
			}
			
			function sayfalimitsay(){
				return array($this->sayfasayisi,$this->sayfa);
			}
			
			// Sadece Tarih date("d-m-Y") 04-10-2016 //
			// $a->bugun 2016-07-21 -> tcevir($tarih) // 21.07.2016 // normal
			// Kullanıcı elle girerse 2018-01-18 database text yada data
			function tcevir($tarih){
				$parcala = explode("-",$tarih);
				$yeni_tarih= $parcala[0]." / ".$parcala[1]." / ".$parcala[2];
				return $yeni_tarih;
			}
			
			//Gün ay yıl 19 ağustos 2019
			//elle $date = date("Y-m-d H:i:s"); echo $a->timeTR($date,1); 1 zaman gösterme 0 göster
			//database echo $a->timeTR($tarih2,0) 0 gösterme 1 göster | Database timestap Current
			function timeTR($par,$durum){
				$explode = explode(" ", $par);
				$explode2 = explode("-", $explode[0]);
				@$zaman = substr($explode[1], 0, 5);
				if ($explode2[1] == "1") $ay = "Ocak";
				elseif ($explode2[1] == "2") $ay = "Şubat";
				elseif ($explode2[1] == "3") $ay = "Mart";
				elseif ($explode2[1] == "4") $ay = "Nisan";
				elseif ($explode2[1] == "5") $ay = "Mayıs";
				elseif ($explode2[1] == "6") $ay = "Haziran";
				elseif ($explode2[1] == "7") $ay = "Temmuz";
				elseif ($explode2[1] == "8") $ay = "Ağustos";
				elseif ($explode2[1] == "9") $ay = "Eylül";
				elseif ($explode2[1] == "10") $ay = "Ekim";
				elseif ($explode2[1] == "11") $ay = "Kasım";
				elseif ($explode2[1] == "12") $ay = "Aralık";
				if($durum==1){
					return $explode2[2]." ".$ay." ".$explode2[0];
				}else{
					return $explode2[2]." ".$ay." ".$explode2[0]."  ".$zaman;
				}
			}
			
			//Gün ay yıl 19 ağustos 2019
			//Gecen zaman
			//elle $date = date("Y-m-d H:i:s");
			//Database timestap olarak eklenmeli
			function gecenzaman($tarih){
				$zaman = time() - strtotime($tarih);
				$durum=array("yıl"=>31556926,"ay"=>2629743.83,"hafta"=>604800,"gün"=>86400,"saat"=>3600,"dakika"=>60,"saniye"=>1);
				foreach($durum as $isim => $saniye){
					$gecen_zaman=floor($zaman/$saniye);
					$gecen=$gecen_zaman . "  ". $isim .' önce';
				   if($gecen_zaman > 0) break;
				}
				echo $gecen;	
			}
			
			
			//harf kısalt
			function kek($kelime, $str){
				if (strlen($kelime) > $str){
					if (function_exists("mb_substr")) $kelime = mb_substr(strip_tags($kelime), 0, $str, "UTF-8").'..';
					else $kelime = substr(strip_tags($kelime), 0, $str).'...';
				}
				return $kelime;
			}
			
			//Metin Bölme
			function metink($metin, $uzunluk){
				// substr ile belirlenen uzunlukta kesiyoruz
				$metin = substr($metin, 0, $uzunluk)."...";
				// kesilen metindeki son kelimeyi buluyoruz
				$metin_son = strrchr($metin, " ");
				// son kelimeyi " ..." ile değiştiriyoruz
				$metin = str_replace($metin_son,"...", $metin);
				return strip_tags($metin);
			}
			
			// Turnb Resim JPG Cevirme
			function tnr($resim){	
				$uzanti =	explode(".",$resim);
				if($uzanti[1]=="gif"){
					return $uzanti[0].".jpg";
				}else{
					return $resim;
				}
			}
			
		
			
			/* tamam
			$a->bkontrol("ad|text soyad|text");
			if($a->bkontrol==0){
			$a->ikontrol==1;}
			test edilecek
			*/ 
			function bkontrol($str){
				$msg = "";
				$pars=explode(" ",$str);
				for($i=0;$i<count($pars);$i++){
					$veri[$i]=explode("|",$pars[$i]);
					@$res[$veri[$i][0]] = $_REQUEST[$veri[$i][0]];
				}
					
					
				foreach($res as $no=>$eleman) {
						if(empty($eleman)){
							$msg.= $no.' Kısmını Boş bıraktınız\n';
							$this->ikontrol = 1;
						}
				}
				
				if($this->ikontrol==1){
					echo hfk::alert1("{$msg}");
				}else{
					$this->ikontrol = 0;
				}
			}
			
			function yerbilgi(){
				require_once('geoplugin.class.php');
				$geoplugin = new geoPlugin();
				$geoplugin->locate();
				/*echo "Geolocation results for {$geoplugin->ip}: <br />\n".
				"City: {$geoplugin->city} <br />\n".
				"Region: {$geoplugin->region} <br />\n".
				"Area Code: {$geoplugin->areaCode} <br />\n".
				"DMA Code: {$geoplugin->dmaCode} <br />\n".
				"Country Name: {$geoplugin->countryName} <br />\n".
				"Country Code: {$geoplugin->countryCode} <br />\n".
				"Longitude: {$geoplugin->longitude} <br />\n".
				"Latitude: {$geoplugin->latitude} <br />\n".
				"Currency Code: {$geoplugin->currencyCode} <br />\n".
				"Currency Symbol: {$geoplugin->currencySymbol} <br />\n".
				"Exchange Rate: {$geoplugin->currencyConverter} <br />\n";
				$bilgi = array($geoplugin->city,$geoplugin->region);
				$nearby = $geoplugin->nearby();*/
				$bilgi = array($geoplugin->ip,$geoplugin->city,$geoplugin->region,$geoplugin->countryName);
				return $bilgi;
			}
			
			//rastgele sayı ve harf üretir sunucuda ve localde test
			 function rastharf($uzunluk){
				$key = "";
			    $karakterler = "1234567890abcdefghijklmnopqrstuvwxyz";
			   for($i=0;$i<$uzunluk;$i++){
				 $key .= $karakterler{rand(0,35)};
			   }
			   return $key;
			 }
			
			//rastgelesayi üretir sunucuda ve localde test
			function rastcift($b,$f){return rand($b,$f);}
			function rastbenzersiz($s){return substr(md5(uniqid(time())),0,$s);} 
			
			
}
class hfk{
			
			
			public static $resim;
			public static $host;
			public static $username;
			public static $pass;
			public static $port;
			public static $btip;
			private static $veri;
			
			public static function veridurum($durum){
				self::$veri = $durum;
			}
			
			public static function verisonuc(){
				return self::$veri;
			}
			
			
			public static function resimboyut($b){
				self::$resim = $b;
			}
			
			
			public static function host($b){
				self::$host = $b;
			}
			
			public static function username($b){
				self::$username = $b;
			}
			
			public static function pass($b){
				self::$pass = $b;
			}
			
			public static function port($b){
				self::$port = $b;
			}
			
			public static function btip($b){
				self::$btip = $b;
			}
		
			static function ob_endflush(){
				while (@ob_end_flush());
			}
			
			//smtp mail fonksiyonu 
			static function mailgonder($kimden,$kime,$konu,$mesaj,$mailisim){
				$mail = new PHPMailer();   
				$mail->IsSMTP();
				$mail->SetFrom($kimden,$mailisim);
				$mail->From     = $kimden;
				$mail->Sender   = $kimden;  
				$mail->FromName = $kimden;  
				$mail->Host     = hfk::$host; //smtp nin kullanacağı mail sunucusu
				$mail->SMTPAuth = true;  
				$mail->Username = hfk::$username;  //mail hesabı kullanıcı adı
				$mail->Password = hfk::$pass;  //mail hesabına ait şifre
				$mail->Port = hfk::$port;
				$mail->CharSet = "utf-8";
				$mail->WordWrap = 50;  
				$mail->IsHTML(true); 
				$mail->Subject  = $konu; 
				$body = $mesaj; 
				$textBody = strip_tags($mesaj);
				$mail->Body = $body;  
				$mail->AltBody = $textBody;  
				$mail->AddAddress($kime);
				return ($mail->Send())?true:false;      
				$mail->ClearAddresses();  
				$mail->ClearAttachments();
			}
			
			
			//Returnsuz coklu
			static function mail2($kimden,$kime,$konu,$mesaj,$mailisim){
				$mail = new PHPMailer();
				$mail->IsSMTP();// send via SMTP
				$mail->SMTPDebug = 1;
				$mail->Host     = hfk::$host; //smtp nin kullanacağı mail sunucusu
				$mail->SMTPAuth = true;  
				$mail->Username = hfk::$username;  //mail hesabı kullanıcı adı
				$mail->Password = hfk::$pass;  //mail hesabına ait şifre
				$mail->Port = hfk::$port; //465
				$mail->CharSet = "utf-8";
		        $mail->IsHTML(true);
				$mail->SetFrom($kimden,$mailisim);
				$mail->From     = $kimden; // smtp kullanıcı adınız ile aynı olmalı
				$mail->Sender   = $kimden;  
				$mail->Fromname = $kimden;
				$mail->AddAddress ($kime);
				$mail->Subject  =  "test";
				$textBody = strip_tags($mesaj);
				$mail->Body     =  $mesaj;
				if(!$mail->Send())
				{
				   echo "Mesaj Gönderilemedi <p>";
				   echo "Mailer Error: " . $mail->ErrorInfo;
				   exit;
				}else{
					echo "Mesaj Gönderildi";
				}
			}
			
			//normal mail gönderme
			static function phpmail($al,$konu1,$mesaj1,$kimden){
				$kime      = $al;
				$konu      = $konu1;
				$ileti     = $mesaj1;
				$başlıklar = 'From:'.$kimden.'' . "\r\n" .
				'Reply-To: '.$kimden.''. "\r\n" .
				'Content-type: text/html; charset=utf-8'."\r\n".
				'X-Mailer: PHP/' . phpversion();
				$msg = mail($kime, $konu, $ileti, $başlıklar);	
				return $msg;
			}	
			
		
			
			//md5 sifrele
			static function sifrele($par){
				return md5(md5(md5(trim($par))));
			}	
			
			//uyari yönlendirme
			static function alert($deger,$link=''){$a = '<script>alert("'.$deger.'");window.location="'.$link.'";</script>';return $a;}
				
			//uyari 
			static function alert1($mesaj){return $b = '<script>alert("'.$mesaj.'");</script>';}
				
			//istenilen sayfa yönlendirme
			static function go($url,$dk=0){
					$b = header("refresh:{$dk};url={$url}");
					return $b;
			}
			
			//direk url yönlendirme
			static function direct_url($url){
				echo '<meta http-equiv="refresh" content="0;url='.$url.'">';
			}
			
			//direk url yönlendirme zamanlı
			static function direct_url_dk($url,$dk){
				echo '<meta http-equiv="refresh" content="'.$dk.';url='.$url.'">';
			}
			
			static function kontrol($deger, $tip, $tanimliDeger = "", $tanimsizDeger = ""){
				  // degerleri kontrol et temizle
				  $deger=trim($deger);
				  $deger = (!get_magic_quotes_gpc()) ? addslashes($deger) : $deger;
				  switch ($tip) {
					case "blob": case "string": case "text":
					  $deger = ($deger != "") ? "'" . $deger . "'" : "NULL";
					  break;
					case "long": case "int":
					  $deger = ($deger != "") ? intval($deger) : "NULL";
					  break;
					case "double":
					  $deger = ($deger != "") ? "'" . doubleval($deger) . "'" : "NULL";
					  break;
					case "date":
					case "datetime":
					  $deger = ($deger != "") ? "'" . $deger . "'" : "NULL";
					  break;
					case "defined":
					  $deger = ($deger != "") ? $tanimliDeger : $tanimsizDeger;
					  break;
				  }
				  return $deger;
			}
			
			//toplu verialımı
			static function verial($str,$tur="text"){
				$pars=explode(" ",$str);
				if(count($pars)==1)
				{
					if(!isset($_REQUEST[$str])) return "";
					return hfk::kontrol($_REQUEST[$str],"$tur");
				}
				
			
				$res=array();
					foreach($pars as $par){
						if(!isset($_REQUEST[$par])) continue;
						if($_REQUEST[$par]){
						$res[$par]=hfk::kontrol($_REQUEST[$par],"$tur");
						}
					}
					return $res;
			}	
			
			
			// Toplu veri akım ad|text soyad|text sayi|int
			 static function verial1($str){
				$pars=explode(" ",$str);
				for($i=0;$i<count($pars);$i++){
					$veri[$i]=explode("|",$pars[$i]);
						$res[$veri[$i][0]]=hfk::kontrol($_REQUEST[$veri[$i][0]],$veri[$i][1]);
				}
				return $res;
			}
			
			//seo
			static function seo($baslik){
				$TR=array('ç','Ç','ı','İ','ş','Ş','ğ','Ğ','ö','Ö','ü','Ü');
				$EN=array('c','c','i','i','s','s','g','g','o','o','u','u');
				$baslik= str_replace($TR,$EN,$baslik);
				$baslik=mb_strtolower($baslik,'UTF-8');
				$baslik=preg_replace('#[^-a-zA-Z0-9_, ]#','',$baslik);
				$baslik=trim($baslik);
				$baslik= preg_replace('#[-_ ]+#','-',$baslik);
				return $baslik;
			}
			
			//resim yükle
			static function resimyukle($resim,$prefix,$dhedef){
				$yer = $resim['tmp_name'];
				$tip = $resim['type'];
				$boyut = $resim['size'];  
				$max_boyut=1997899;
						$uzanti =	strtolower(substr($resim["name"], strrpos($resim["name"],".")));
						$izinverilen=array(".jpg",".png",".jpeg",".bmp",".gif");
						if(!in_array($uzanti, $izinverilen)){
							return array("hata",hfk::g("Fotoğrafın türü tanınamadı, geçerli türler: .jpg .png .jpeg .bmp .gif Yükleyebilirsiniz !"));
						}else{
							$isim= $prefix;
							$yeniad = $isim.$uzanti;
							$hedef = $dhedef.'/'.$yeniad;
							if(self::$resim==1){
									//boyutlu
									if($boyut>$max_boyut || $boyut==0){
										return array("hata",hfk::g("Yüklenilen Resim Boyutu büyüktür Lütfen 2 MB Fazla büyük resim yüklemeyin ! "));
										return false;
									}else{
										if (@move_uploaded_file($yer, $hedef)){ return array("tamam",$yeniad);}
										else{ return array("hata",hfk::g("yeni Resim yüklenemedi Resim Yolu hatası 1 ! ").$hedef); }
									}
							}
							if(self::$resim==0){
								//boyutsuz
								if (@move_uploaded_file($yer, $hedef)){ return array("tamam",$yeniad);
								}else{return array("hata",hfk::g("yeni Resim yazılamadı: ").$hedef);}
							}
					   }
				}
			
			
				//dosya ekle
				static function dosyaekle($resim,$prefix,$dhedef){
					$yer = $resim['tmp_name'];
					$tip = $resim['type'];
					$boyut = $resim['size'];  
					$max_boyut=1997899;
					$uzanti =	strtolower(substr($resim["name"], strrpos($resim["name"], ".")));
					$izinverilen=array(".doc", ".docx", ".xlsx", ".xls", ".pdf", ".txt", ".pdf",".rar");
					if(!in_array($uzanti, $izinverilen)){
						return array("hata",hfk::g("Dosyanın türü tanımsızdır , geçerli yükleme türleri : ").implode(" ", $izinverilen));
					}else{
							$isim= $prefix."_";
							$yeniad = "".$isim.$uzanti."";
							$hedef = $dhedef.'/'.$yeniad;
							if(self::$resim==1){
										//boyutlu
										if($boyut>$max_boyut || $boyut==0){
											return array("hata",hfk::g("Yüklenilen Dosya Boyutu büyüktür 2 MB BÜYÜK DOSYA YÜKLEMEYİN ! "));
											return false;
										}else{
											if (@move_uploaded_file($yer, $hedef)){ return array("tamam",$yeniad);}
											else{ return array("hata",hfk::g("yeni dosya yazılamadı Dosya yolu hatası ! : ").$hedef); }
										}
							}else{
								//boyutsuz
								if(@move_uploaded_file($yer, $hedef)){ return array("tamam",$yeniad);
								}else{return array("hata",hfk::g("yeni dosya yazılamadı: ").$hedef); }
							}
					}
				}
				
				static function g($a){return $a;}
}
?>