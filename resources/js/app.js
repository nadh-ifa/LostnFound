import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import { createApp } from 'vue';

import ItemSearch from './components/ItemSearch.vue';
import CommentSection from './components/CommentSection.vue';

if (document.getElementById('item-search-app')) {
    const itemSearchApp = createApp({});

    itemSearchApp.component('item-search', ItemSearch);

    itemSearchApp.mount('#item-search-app');
}

if (document.getElementById('comment-app')) {
    const commentApp = createApp({});

    commentApp.component('comment-section', CommentSection);

    commentApp.mount('#comment-app');
}