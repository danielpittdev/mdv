// FORMULARIOS COMPLETOS
document.getElementById('modal').showModal();
// En formulario: action:nombre.ruta - method:post - id:id_formulario
const formulario = document.querySelector('#formulario');
if (formulario) {
	formulario.addEventListener('submit', (event) => {
		event.preventDefault();
		senderAjax(formulario)
			.then(data => {
				window.location.reload()
			})
	});
}

// PARA PETICIONES SUELTAS
document.addEventListener('DOMContentLoaded', () => {
	$(document).on('click', '.pet_abrir', function () {
		let id = $(this).attr('target');

		$.ajax({
			type: "get",
			url: `/api/v1/anotacion/${id}`,
			dataType: "json",
			success: function (response) {
				let url_post = `/api/v1/anotacion/${response.anotacion.uuid}`;
				$('#formulario').attr('action', url_post);
				let img = response.anotacion.icono;
				let url_img = `{{ Storage::url('${img}') }}`

				document.getElementById('modal_editar_anotacion').showModal();
				$('#editar_icono').prop('src', url_img);
				$('#editar_titulo').val(response.anotacion.titulo);
				$('#editar_anotacion').val(response.anotacion.anotacion);
				$('#anotacion_id_editar[name=anotacion_id]').val(response.anotacion.uuid);
			}
		});
	})
})