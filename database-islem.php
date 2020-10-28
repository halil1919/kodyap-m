<?php
defined ('_ERISIM') or die ('Erisim Engellendi');
class mainx extends database{
	public $Cyol;
	public $cachedurum;
	
		//0 -> Cache yok 1 -> var 
		function select($err,$tip,$dosyaad,$sutunlar,$tablolar,$sartlar='',$sirala='',$limit=''){
			$this->_init_charset();
			if($tip==1){
						$dosyaAdı = $dosyaad.".html";
						$cache = "dosya/".$dosyaAdı;
						$sure = 25; //saniye cinsindendir
						$this->Cyol = $cache;
					if(time() - $sure < @filemtime($cache)){
						readfile($cache);
						$this->cachedurum = 0;
					}else{
						$this->cachedurum = 1;
						@unlink($cache);
						ob_start();
						$this->sql="SELECT $sutunlar FROM $tablolar";
						if($sartlar){$this->sql="SELECT $sutunlar FROM $tablolar WHERE $sartlar"; }
						if($sirala){$this->sql="SELECT $sutunlar FROM $tablolar WHERE $sartlar ORDER BY $sirala"; }
						if($sartlar== '' and $sirala){$this->sql="SELECT $sutunlar FROM $tablolar  ORDER BY $sirala"; }
						if($sartlar== '' and $sirala =='' and $limit){$this->sql="SELECT $sutunlar FROM $tablolar  LIMIT $limit"; }
						if($limit){$this->sql="SELECT $sutunlar FROM $tablolar WHERE $sartlar ORDER BY $sirala LIMIT $limit"; }
						if($this->dbtip==2){
							$smpt = $this->vt->prepare($this->sql);
							if(!$smpt){
								if($err==1){
									echo parent::sql();
								}
							}else{
								$smpt = $this->vt->prepare($this->sql);
								$smpt->execute();
								$this->sor = $smpt->get_result();
								$this->say = $this->sor->num_rows;
								if($err==1){
									echo parent::sql();
								}
							}
						}else{
							$this->sor=mysql_query($this->sql);
							$this->say=mysql_num_rows($this->sor);
							if($err==1){
									echo parent::sql();
							}
						}
				}
			}else{
				$this->sql="SELECT $sutunlar FROM $tablolar";
				if($sartlar){$this->sql="SELECT $sutunlar FROM $tablolar WHERE $sartlar"; }
				if($sirala){$this->sql="SELECT $sutunlar FROM $tablolar WHERE $sartlar ORDER BY $sirala"; }
				if($sartlar== '' and $sirala){$this->sql="SELECT $sutunlar FROM $tablolar  ORDER BY $sirala"; }
				if($sartlar== '' and $sirala =='' and $limit){$this->sql="SELECT $sutunlar FROM $tablolar  LIMIT $limit"; }
				if($limit){$this->sql="SELECT $sutunlar FROM $tablolar WHERE $sartlar ORDER BY $sirala LIMIT $limit"; }
				
				if($this->dbtip==2){
					$smpt = $this->vt->prepare($this->sql);
					if(!$smpt){
						if($err==1){
							echo parent::sql()."<br>".$this->vt->error;
						}
					}else{
						$smpt->execute();
						$this->sor = $smpt->get_result();
						$this->say = $this->sor->num_rows;
						if($err==1){
							echo parent::sql()."<br>";
						}
					}
				}else{
					if(!strstr($this->sunucutipveri,"mysqli")){ 
						$this->sor=mysql_query($this->sql);
						@$this->say=mysql_num_rows($this->sor);
						if($err==1){
								echo parent::sql()."<br>";
						}
						//BAKILACAK
						return $this->sor;
					}
				}
			}
		}
		
		//Düz sql sorgusu yazma
		public function squery($sql){
			$this->sql = $sql;
			if($this->dbtip==2){
				$smpt = $this->vt->prepare($this->sql);
				if($smpt){
					$smpt->execute();
					return $this->vt->affected_rows;
				}
			}else{
				$this->sor=mysql_query($this->sql);
				return $this->sor;
			}
		}
		
		function fopenc(){
			if($this->cachedurum==1){
				$ac = fopen($this->Cyol,"w+");
				fwrite($ac, ob_get_contents());
				fclose($ac);
				ob_end_flush();
			}
		}
		
		//if sadece doğruysa
		function ekle($err,$tablo,$g,$sifre=''){
			if(is_array($g)){//gelen veriler dizimi diye bakar
				list($fields,$values)= parent::array_insert($g);
				$this->sql="INSERT INTO $tablo ($fields) VALUES ($values)";
				if($sifre){$this->sql="INSERT INTO $tablo ($fields,sifre) VALUES ($values,'$sifre')";}
					if($this->dbtip==2){
						$smtp = $this->vt->prepare($this->sql);
						if(!$smtp){
							echo '<script>alert("Veri Ekleme Hatası & Sorgu kodu hatası");</script>';
							if($err==1){
								echo parent::sql();
							}
						}else{
							$this->sor = $smtp->execute();
							$this->sonid = $this->vt->insert_id;
							if($this->sonid < 1){
								echo '<script>alert("Tablo Ekleme Hatası");</script>';
								if($err==1){
									echo parent::sql();
								}
							}else{
								return true;
							}
						}
					}else{
						$this->sor=mysql_query($this->sql);
						$this->sonid = mysql_insert_id();
						if($this->sonid < 1){
							echo '<script>alert("Tablo Ekleme Hatası");</script>';
							if($err==1){
								echo parent::sql();
							}
						}else{
							return true;
						}
					}
			}else{
				echo '<script>alert("Gelen veri değişken adı yanlış ve dizi değildir");</script>';
			}
			
		}
		
		//$value= array('','20',$ürün->baslik,$fiyat,'2'); tüm satırlar girilmesi gerekir
		//return 1 
		public function insert_first($table,$value,$row=null){
			$insert= " INSERT INTO ".$table;
			if($row!=null){
				$insert.=" (". $row." ) ";
			}
			for($i=0; $i<count($value); $i++){
				if(is_string($value[$i])){
					$value[$i]= '"'. $value[$i] . '"';
				}
			}
			$value=implode(',',$value);
			$insert.=' VALUES ('.$value.')';
			
			$this->sql = $insert;
			
			if($this->dbtip==2){
				$smtp = mysqli_multi_query($this->vt,$insert);
				return $smtp;
			}else{
				$this->sor=mysql_query($insert);
				return $this->sor;
			}
		}
		
		//if sadece doğruysa
		function guncelle($err,$tablo,$g,$sart){
			$veri= $this->array_update($g);
			$this->sql="UPDATE $tablo SET $veri WHERE $sart";
			if($this->dbtip==2){
				
					$smpt = $this->vt->prepare($this->sql);
					if(!$smpt){
						echo '<script>alert("Birim Hatası");</script>';
						if($err==1){
							echo parent::sql();
						}
					}else{
							$this->sor = $smpt->execute();
							preg_match_all('/(\S[^:]+): (\d+)/', $this->vt->info, $matches); 
							$infoArr = array_combine ($matches[1], $matches[2]);
							if($infoArr['Rows matched']==0){
									echo '<script>alert("Birim Hatası");</script>';
								if($err==1){
									echo parent::sql();
								}
								
							}else{
								return $this->sor;
							}
					}
			}else{
				//bakılacak
				$this->sor=mysql_query($this->sql);
				if($err==1){
							echo parent::sql();
				}
				return $this->sor;
			}
		}
		
		
		//if else
		function deletex($err,$tablo,$sartlar){
			$this->sql="DELETE FROM  $tablo  WHERE $sartlar";
			if($this->dbtip==2){
				$smpt = $this->vt->prepare($this->sql);
				if(!$smpt){
					echo '<script>alert("Birim Hatası delete Sql");</script>';
					if($err==1){
						echo parent::sql();
					}
				}else{
					$this->sor = $smpt->execute();
					if($err==1){
						echo parent::sql();
					}
					return $this->vt->affected_rows;
				}
			}else{
				$this->sor=mysql_query($this->sql);
				if($err==1){
						echo parent::sql();
				}
				return mysql_affected_rows();
			}
		}	
		
		
		function cokluresim($resim,$kayitip,$dhedef,$tabloyakayıt,$tablo,$tabload,$kid,$islem=''){
								//resim resim[]
								//Kayitip 1 ise database ekler
								//hedef "../"
								//oid 0 ise sadece tabloya kayıt 1 ise kid li kayitip
								//tablo 
								//tabload
								//kid
								$toplam = count($resim["name"]);
								
								for ($i = 0; $i < $toplam; $i++){
									
										$isim = rand(0,999999);
										$uzanti = substr($resim["name"][$i],-4,4);
										$dizin = $dhedef.$isim."_".$uzanti;
										$yeniad =$isim.$uzanti;
										
										 if (@move_uploaded_file($resim["tmp_name"][$i], $dizin)){
											//echo '<img src="'.$dizin.'" alt="" class="resim" />';
											 if($kayitip==1){
												//database kaydededer
												if($tabloyakayıt==1){
													//tabloya kayıt kidsiz
													$sql = "INSERT INTO {$tablo} SET uploads_resim='$yeniad'";
													if($this->dbtip==2){
														$keko = mysqli_query($this->vt,$sql);									
														if(!$keko){
															echo $sql;
															//echo '<script>alert("Birim Hatası delete Sql");</script>';
														}else{
															$_SESSION['ckresim'] = true;
														}
													}else{
														$this->sor=mysql_query($sql);
														$_SESSION['ckresim'] = true;
													}
												}elseif($tabloyakayıt==2){
													//tabloya kayıt kidli
													$sql = "INSERT INTO {$tablo} SET uploads_resim='$yeniad',kid=$kid";
													if($this->dbtip==2){
														$keko = mysqli_query($this->vt,$sql);									
														if(!$keko){
															echo $sql;
															//echo '<script>alert("Birim Hatası delete Sql");</script>';
														}else{
															$_SESSION['ckresim'] = true;
														}
													}else{
														$this->sor=mysql_query($sql);
														$_SESSION['ckresim'] = true;
													}
												}
											 }else{
												$_SESSION['ckresim'] = true;
											 }
									    }else{
											$_SESSION['ckresim'] = false;
										}
									
						 }//for bitiş
		}//class bitiş
}
?>