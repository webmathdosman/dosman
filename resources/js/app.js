import './bootstrap';

import Alpine from 'alpinejs';
import { registerDisplayPrefs } from './display-prefs';

window.Alpine = Alpine;

registerDisplayPrefs(Alpine);

Alpine.start();
