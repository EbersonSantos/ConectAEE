<script type="text/javascript">

// function fonte(e) {
//
// 	var elemento = $(".acessibilidade");
// 	var fonte = parseInt(elemento.css('font-size'));
//
// 	var body = $("body");
// 	const fonteNormal = parseInt(body.css('font-size'));
//
// 	if (e == 'a') {
// 		fonte++;
// 	}else if (e == 'd'){
// 		fonte--;
// 	}
//
// 	elemento.css("fontSize", fonte);
//
// }

function showEspecializacao(val){
  especializacao = document.getElementById('div-especializacao');
  especializacao_text = document.getElementById('especializacao');
  if(val.value == "Profissional Externo"){
    especializacao.style.display = 'block';
  }else{
    especializacao.style.display = 'none';
    especializacao_text.value = '';
  }
}

function showResponsavel(val){
  responsavel = document.getElementById('div-responsavel');
  login = document.getElementById('login');
  if(val.value == '2'){
    responsavel.style.display = 'block';
  }else{
    responsavel.style.display = 'none';
    login.value = '';
  }
}

function contraste(){
  if (getCookie('highcontrast') == 1) {
    setCookie("highcontrast", 0);
    window.location.reload()
  }else {
    setCookie("highcontrast", 1);
    window.location.reload()
  }
}

if (getCookie('highcontrast') == 0) {
  $('body').removeClass('contrast');
}else{
  $('body').addClass('contrast');
}

// Cookie Functions
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires + "; path=/";
}

function getCookie(c_name) {
    if (document.cookie.length > 0) {
        c_start = document.cookie.indexOf(c_name + "=");
        if (c_start != -1) {
            c_start = c_start + c_name.length + 1;
            c_end = document.cookie.indexOf(";", c_start);
            if (c_end == -1) {
                c_end = document.cookie.length;
            }
            return unescape(document.cookie.substring(c_start, c_end));
        }
    }
    return "";
}

</script>
