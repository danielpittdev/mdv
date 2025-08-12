import $ from 'jquery';
window.$ = window.jQuery = $;

import './bootstrap';
import "cally";

function setCookie(name, value, days) {
	let expires = "";
	if (days) {
		const date = new Date();
		date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
		expires = "; expires=" + date.toUTCString();
	}
	document.cookie = name + "=" + (value || "") + expires + "; path=/; SameSite=Lax";
}

// Función principal que se ejecuta al hacer clic en el botón
function toggleSidebar() {
	// 1. Alterna la clase en el body. El CSS y Tailwind se encargan del resto.
	document.body.classList.toggle('sidebar-plegado');

	// 2. Comprueba el estado actual y guarda la cookie.
	if (document.body.classList.contains('sidebar-plegado')) {
		setCookie('sidebar_estado', 'plegado', 365);
	} else {
		setCookie('sidebar_estado', 'expandido', 365);
	}
}

// Función principal que se ejecuta al hacer clic en el botón
function setTheme() {
	const colorValue = getComputedStyle(document.documentElement).getPropertyValue('--color-base-100').trim();
	const themeColorMeta = document.getElementById('theme-color-meta-v2');

	themeColorMeta.setAttribute('content', colorValue);
	setCookie('theme', colorValue, 365);
}

setTheme();

function updateThemeColor() {
	const themeColorMeta = document.getElementById('theme-color-meta-v2');
	if (!themeColorMeta) {
		return;
	}

	// Ahora, cuando este código se ejecute, --b1 ya existirá.
	const colorValue = getComputedStyle(document.documentElement).getPropertyValue('--color-base-100').trim();

	if (colorValue) {
		const finalColor = colorValue;
		themeColorMeta.setAttribute('content', finalColor);
	}
}

// El observador para cambios de tema sigue igual
const observer = new MutationObserver((mutationsList) => {
	for (const mutation of mutationsList) {
		if (mutation.type === 'attributes' && mutation.attributeName === 'data-theme') {
			updateThemeColor();
		}
	}
});

observer.observe(document.documentElement, {
	attributes: true
});

// Ejecutamos la función una vez para establecer el color inicial
updateThemeColor();

// Sender de peticiones
function senderAjax(formElement) {
	const url = formElement.action;
	const method = formElement.method;
	const formulario = new FormData(formElement);
	const alertaElement = formElement.querySelector('.alerta');
	const submitButton = formElement.querySelector('button[type="submit"]');

	// ❌ const token = localStorage.getItem('token'); // <-- Ya no es necesario

	return new Promise((resolve, reject) => {
		if (alertaElement) {
			alertaElement.classList.add('opacity-0', 'hidden');
		}

		if (submitButton) {
			submitButton.disabled = true;
			submitButton.style.opacity = '0.7';
		}

		fetch(url, {
			method: method,
			body: formulario,
			headers: {
				'Accept': 'application/json',
				'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
			}
		})
			.then(response => response.json().then(data => ({ ok: response.ok, data })))
			.then(({ ok, data }) => {
				if (!ok) {
					handleAlertError(alertaElement, data);
					reject(data);
				} else {
					resolve(data);
				}
			})
			.catch(error => {
				const errorData = { message: 'Error de conexión o respuesta inválida.' };
				handleAlertError(alertaElement, errorData);
				reject(errorData);
			})
			.finally(() => {
				// Se reactiva el botón al finalizar
				if (submitButton) {
					submitButton.disabled = false;
					submitButton.style.opacity = '1';
				}
			});
	});
}

// La función de ayuda 'handleAlertError' no necesita cambios
function handleAlertError(alertaElement, errorData) {
	if (!alertaElement || !errorData) return;

	const errorMessageElement = alertaElement.querySelector('.error_mensaje');
	const errorListElement = alertaElement.querySelector('.error_lista');

	if (errorMessageElement && errorData.message) {
		errorMessageElement.textContent = errorData.message;
	}

	if (errorListElement && errorData.errors) {
		errorListElement.innerHTML = '';
		Object.values(errorData.errors).forEach(errorArray => {
			const li = document.createElement('li');
			li.textContent = errorArray[0];
			errorListElement.appendChild(li);
		});
	}

	alertaElement.classList.remove('hidden');
	setTimeout(() => alertaElement.classList.remove('opacity-0'), 50);
}

// Para Vite, exponemos la función a window
window.senderAjax = senderAjax;

// AJAX QUERY
function senderPeticion(url, metodo, datos) {
	return new Promise(function (resolve, reject) {
		$.ajax({
			type: metodo,
			url: url,
			data: datos,
			processData: false,
			contentType: false,
			dataType: "json",
			success: function (response) {
				resolve(response); // <- devuelve datos con éxito
			},
			error: function (xhr) {
				reject(xhr); // <- devuelve error si falla
			}
		});
	});
}

window.senderPeticion = senderPeticion;

// Asigna el evento cuando el DOM esté listo.
document.addEventListener('DOMContentLoaded', () => {
	const toggleButton = document.getElementById('sidebar-toggle-btn');
	if (toggleButton) {
		toggleButton.addEventListener('click', toggleSidebar);
	}
});

document.addEventListener('DOMContentLoaded', function () {
	// 1. Seleccionar los elementos del DOM
	const mobileMenuContainer = document.getElementById('mobile-menu-container');
	const mobileMenuBackdrop = document.getElementById('mobile-menu-backdrop');
	const mobileMenuPanel = document.getElementById('mobile-menu-panel');
	const closeMobileMenuButton = document.getElementById('close-mobile-menu');

	// Asumimos que tienes un botón para abrir el menú, por ejemplo, en tu header
	// Si no lo tienes, deberás añadir uno en tu HTML:
	// <button id="open-mobile-menu" type="button" class="lg:hidden p-2.5 text-gray-700">
	//   <span class="sr-only">Open sidebar</span>
	//   <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
	//     <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
	//   </svg>
	// </button>
	const openMobileMenuButton = document.getElementById('open-mobile-menu');


	// 2. Función para abrir el menú
	function openMobileMenu() {
		mobileMenuContainer.classList.remove('hidden'); // Hace visible el contenedor
		// Forzar un "reflow" para que las transiciones funcionen correctamente
		mobileMenuContainer.offsetWidth; // Truco para asegurar que el navegador recalcule el diseño antes de añadir las clases de transición.

		// Añadir clases para la transición de apertura
		mobileMenuBackdrop.classList.remove('opacity-0');
		mobileMenuBackdrop.classList.add('opacity-100');

		mobileMenuPanel.classList.remove('-translate-x-full');
		mobileMenuPanel.classList.add('translate-x-0');

		// Para accesibilidad (ARIA)
		mobileMenuContainer.setAttribute('aria-modal', 'true');
		mobileMenuContainer.setAttribute('role', 'dialog');
	}

	// 3. Función para cerrar el menú
	function closeMobileMenu() {
		// Añadir clases para la transición de cierre
		mobileMenuBackdrop.classList.remove('opacity-100');
		mobileMenuBackdrop.classList.add('opacity-0');

		mobileMenuPanel.classList.remove('translate-x-0');
		mobileMenuPanel.classList.add('-translate-x-full');

		// Para accesibilidad (ARIA)
		mobileMenuContainer.setAttribute('aria-modal', 'false');
		mobileMenuContainer.setAttribute('role', ''); // O quitar el atributo

		// Esperar a que la transición termine antes de ocultar el contenedor
		// La transición de tu panel es 'duration-300' (300ms)
		setTimeout(() => {
			mobileMenuContainer.classList.add('hidden');
		}, 300); // Coincide con la duración de la transición CSS
	}

	// 4. Asignar los Event Listeners
	if (openMobileMenuButton) {
		openMobileMenuButton.addEventListener('click', openMobileMenu);
	}

	if (closeMobileMenuButton) {
		closeMobileMenuButton.addEventListener('click', closeMobileMenu);
	}

	// Opcional: Cerrar el menú haciendo clic en el telón de fondo
	if (mobileMenuBackdrop) {
		mobileMenuBackdrop.addEventListener('click', closeMobileMenu);
	}
});

document.addEventListener('DOMContentLoaded', () => {
	$('input[type="file"].hidden').on('change', function () {
		const file = this.files[0];
		let element = $(this).parents()[0];
		let icono = $(element).find('.preview');

		if (file) {
			const reader = new FileReader();

			reader.onload = function (e) {
				$(icono).attr('src', e.target.result);
			}

			// Leemos el archivo como una URL de datos (Base64).
			reader.readAsDataURL(file);
		}
	})
});