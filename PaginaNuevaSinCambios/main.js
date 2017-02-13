function toggleLoginForm(element) {
	$('form#loginform').slideToggle('slow','');
	if (element.innerText == "Entrar") {
		element.innerHTML = "Cerrar";
	} else {
		element.innerHTML = "Entrar";
	}
}

function submitForm(action, formid, returnid) {
	$.ajax({type:'POST', url: action, data: $('#'+formid).serialize(), success:
				function(response) {
					$('#'+returnid).html(response);
				}
			});
}

function deleteRow(model, id) {
	if (confirm("Esta seguro que desea eliminar esta entrada?")) {
		$.ajax({type:'POST', url: '../../../'+model+'/destroy.php', data: "id="+id, success:
				function(response) {
					$('#main').html(response);
				}
			});
	}
}

function deleteRowSpecial(model, id, params) {
	if (confirm("Esta seguro que desea eliminar esta entrada?")) {
		$.ajax({type:'POST', url: '../../../'+model+'/destroy.php', data: "id="+id+"&"+params, success:
               function(response) {
               $('#main').html(response);
               }
               });
	}
}

function filter(search, model) {
	$.ajax({type:'POST', url: '../../../'+model+'/search.php', data: "search="+search, success:
		function(response) {
			$('tbody#'+model+'-content').html(response);
		}
	});
}

function filterSpecial(search, model, params) {
	$.ajax({type:'POST', url: '../../../'+model+'/search.php', data: "search="+search+"&"+params, success:
           function(response) {
           $('tbody#'+model+'-content').html(response);
           }
           });
}

function search(search, model) {
	$.ajax({type:'POST', url: '../../../'+model+'/resource_search.php', data: "search="+search, success:
		function(response) {
			$('#'+model+'-content').html(response);
		}
	});
}

function returnLoan(model, id) {
	if (confirm("Esta seguro que desea marcar como entregado?")) {
		$.ajax({type:'POST', url: '../../../'+model+'/return.php', data: "id="+id, success:
				function(response) {
					$('#main').html(response);
				}
			});
	}
}