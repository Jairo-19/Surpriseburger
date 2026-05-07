// Carga la librería lodash y la expone globalmente como window._
window._ = require('lodash');

/**
 * Carga la librería axios para realizar peticiones HTTP al backend de Laravel.
 * Configura automáticamente la cabecera CSRF a partir de la cookie "XSRF-TOKEN".
 */

window.axios = require('axios');

// Cabecera requerida por Laravel para identificar peticiones AJAX
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Laravel Echo permite suscribirse a canales y escuchar eventos de broadcasting
 * en tiempo real. Se deja comentado ya que esta aplicación no usa WebSockets.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });
