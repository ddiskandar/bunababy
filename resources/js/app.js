require('./bootstrap');

import Alpine from 'alpinejs';
import mask from '@alpinejs/mask';
import focus from '@alpinejs/focus';
import intersect from '@alpinejs/intersect';
import collapse from '@alpinejs/collapse';
import AlpineFloatingUI from '@awcodes/alpine-floating-ui';
import NotificationsAlpinePlugin from '../../vendor/filament/notifications/dist/module.esm';

Alpine.plugin(mask);
Alpine.plugin(focus);
Alpine.plugin(intersect);
Alpine.plugin(collapse);
Alpine.plugin(AlpineFloatingUI)
Alpine.plugin(NotificationsAlpinePlugin)

window.Alpine = Alpine;

Alpine.start();
