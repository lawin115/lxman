import axios from 'axios';

axios.defaults.baseURL = import.meta.env.VITE_APP_URL || window.location.origin;
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
