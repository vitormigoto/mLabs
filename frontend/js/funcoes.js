	
	
//******************* Função de Funcionamento da Data e Hora	
	function MostraData(){
			var DateTime = new Date();
			var dia = DateTime.getDay();
			var mes = DateTime.getMonth();
			var ano = DateTime.getFullYear();
			var h = DateTime.getHours();
			var m = DateTime.getMinutes();
			var s = DateTime.getSeconds();
			if(dia<10)
				dia="0"+dia;
			if(mes<10)
				mes="0"+mes;
			if(h<10)
				h="0"+h;
			if(m<10)
				m="0"+m;
			if(s<10)
				s="0"+s;
			document.getElementById("DataHora").innerHTML= ""+dia+"/"+mes+"/"+ano+" "+h+":"+m+":"+s+"";	
		}
		setInterval(MostraData, 1000);	
	

//************* Inicializações Globais
	var nome = [];
	var url = [];
	var picture = [];
	var channel_key = [];
	var cod = [];
	var channel_escolhido ="";
	var muda_div="";
	var cor_fundo,cor_fundo_titulo,icone="";
	
// Função de Armazenamento dos dados importados em Arrays globais	
	function armazena(c,n,u,pic,channel){
		cod[c] = c;
		nome[c]= n; 
		url[c]= u; 
		picture[c]= pic; 
		channel_key[c]=channel;	
	}
	
//********************* Script de Pesquisa das Arrays
	function monta_paginas(rede){
		var paginas="";
		document.getElementById("pages").innerHTML="";
		for(var x=1;x<=cod.length;x++){		
			if(channel_key[x]==rede)
			{			
				if(picture[x]=="")
					picture[x]="images/nophoto.png";
				paginas = "<div class='row bg-light text-middle align-items-center p-2'><div class='col-2' ><img src='"+picture[x]+"' class='img-thumbnail' style='width:75px;height:75px;'></div><div class='col-8'><h5>"+nome[x]+"</h5>"+url[x]+"</div><div class='col-2 text-center'><div class='custom-control custom-radio' style='height:10px;'><input type='radio' class='custom-control-input' id='defaultUnchecked"+cod[x]+"' name='radio' onclick='monta_quadro("+cod[x]+");'><label class='custom-control-label' for='defaultUnchecked"+cod[x]+"'></label></div></div></div>";
				document.getElementById("pages").innerHTML += paginas;				
				channel_escolhido = rede;
			}			
		}
		if(paginas=="")
		{
			document.getElementById("pages").innerHTML="<div class='row bg-light text-middle align-items-center p-2'><div class='col text-center'>Você não possui páginas para selecionar.</div></div>";
		}
	}	
	
//********************* Script para Adicionar Perfil

	function monta_quadro(cod){		
		if(channel_escolhido=='facebook')
		{
			icone = "fab fa-facebook-f";
			cor_fundo_titulo = "#344f8b";
			cor_fundo = "#39589b";
		}
		if(channel_escolhido=='twitter')
		{
			icone = "fab fa-twitter";
			cor_fundo_titulo = "#287bbb";
			cor_fundo = "#50abf1";
		}
		if(channel_escolhido=='instagram')
		{
			icone = "fab fa-instagram";
			cor_fundo_titulo = "#c73786";
			cor_fundo = "#ee685d";
		}
		if(channel_escolhido=='google_mybussines')
		{
			icone = "fas fa-home";
			cor_fundo_titulo = "#2c76ef";
			cor_fundo = "#4c8cf5";
		}
		if(channel_escolhido=='pinterest')
		{
			icone = "fab fa-pinterest-p";
			cor_fundo_titulo = "#a23434";
			cor_fundo = "#cf0000";
		}
		if(channel_escolhido=='linkedin')
		{
			icone = "fab fa-linkedin-in";
			cor_fundo_titulo = "#1a70ab";
			cor_fundo = "#3279aa";
		}
		if(channel_escolhido=='youtube')
		{
			icone = "fab fa-youtube";
			cor_fundo_titulo = "#8c3334";
			cor_fundo = "#ee1216";
		}
		if(channel_escolhido=='whatsapp')
		{
			icone = "fab fa-whatsapp";
			cor_fundo_titulo = "#0dab2b";
			cor_fundo = "#22d344";
		}
		if(channel_escolhido=='google_analytics')
		{
			icone = "fas fa-chart-area";
			cor_fundo_titulo = "#e07103";
			cor_fundo = "#f27902";
		}
		muda_div="<p class='text-left p-2' style='background-color:"+cor_fundo_titulo+"; color:white;'>"+nome[cod]+"</p><div class='col text-left p-4 '><span class='"+icone+" fa-4x' style='color:white;'></span></div>";
		
	}	
	
	function aplica_quadro(){
		document.getElementById(channel_escolhido).innerHTML="";		
		document.getElementById(channel_escolhido).className="col-sm social p-0 ";
		document.getElementById(channel_escolhido).style.backgroundColor=""+cor_fundo+"";
		document.getElementById(channel_escolhido).innerHTML=muda_div;
	}
	
// ****************** Script de Leitura Json do documento de entrada de dados
	
	var xmlhttp = new XMLHttpRequest();	
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var myObj = JSON.parse(this.responseText);
			var i,id="";
			for(i in myObj.data){			
				armazena(myObj.data[i].id,myObj.data[i].name,myObj.data[i].url,myObj.data[i].picture,myObj.data[i].channel_key);
			}			
		}
	};
	xmlhttp.open("GET", "https://demo2697181.mockable.io/pages", true);
	xmlhttp.send();	