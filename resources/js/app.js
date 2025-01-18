import './bootstrap';

import Alpine from 'alpinejs';
import 'preline';
import _ from 'lodash';
import Dropzone from 'dropzone';

window.Alpine = Alpine;

// Expose Lodash and Dropzone to the global window object
window._ = _;
window.Dropzone = Dropzone;

Alpine.start();
