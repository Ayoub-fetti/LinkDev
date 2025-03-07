import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


window.Pusher = Pusher;

window.Echo = new Echo({ broadcaster: 'pusher', key: import.meta.env.VITE_PUSHER_APP_KEY, cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER, forceTLS: true });