jQuery(document).ready(function($) {

	var formularioPronto;
	$(document).on('click', '#submit', function(e) {
		formularioPronto = true;
		e.preventDefault();
		$(".form-control").each(function(index, el) {
			if ( !$(this).val() ) {
				verificaCampo($(this), 'Não pode ser vazio');
			}
		});

		if (!verificaEmail($("input[name=email]").val())) {
			$(this).val('');
			verificaCampo($("input[name=email]"), 'E-mail inválido');
		}

		var telefone = $("input[name=telefone]");
		var tamanhoTelefone = telefone.val().length;
		if ( tamanhoTelefone < 14 || tamanhoTelefone > 15 ) {
			telefone.val('');
			verificaCampo($("input[name=telefone]"), '(00) 00000-0000');
		}

		if (false !== formularioPronto) {
			executaRequisicao();
		}
		else {
			console.log("Não pode enviar");
		}

		function verificaCampo (campo, placeholder) {
			formularioPronto = false;
			if (!campo.data('placeholder')) {
				campo.attr('data-placeholder', campo.attr('placeholder'));
			}
			campo.attr('placeholder', placeholder);
			campo.css({ "color": "#721c24", "background-color": "#f8d7da", "border": "2px solid #f5c6cb" });
		}

		function verificaEmail(email) {
			var expRegular = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			return expRegular.test(email);
		}
	});

	$(document).on('change', '.form-control', function(e) {
		if ($(this).attr('style')) {
			$(this).removeAttr('style');
			$(this).attr('placeholder', $(this).data('placeholder'));
		}
	});

	function executaRequisicao () {
		var dados = {};
		$(".form-control").each(function(index, el) {
			dados[$(this).attr('name')] = $(this).val();
		});

		$.post('index.php', dados, function(callback, textStatus, xhr) {
			alert(callback);
		});
	}

	function mascaraTelefone (v){
		v=v.replace(/\D/g,"");
		v=v.replace(/^(\d{2})(\d)/g,"($1) $2");
		v=v.replace(/(\d)(\d{4})$/,"$1-$2");
		return v;
	}

	$("input[name=telefone]").on('change', function(e) {
		var v = $(this).val();
		v = v.replace(/\D/g,"");
		v = v.replace(/^(\d{2})(\d)/g,"($1) $2");
		v = v.replace(/(\d)(\d{4})$/,"$1-$2");
		$(this).val(v);
	});
});
