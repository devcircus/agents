import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import UIkit from "franken-ui/js/core.iife";
window.UIkit = UIkit;
// UIkit.tooltip(element, options);
import 'franken-ui/js/icon.iife';

import '../css/app.css';
