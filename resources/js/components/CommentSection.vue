<template>
    <div class="comments-card">

        <div class="comments-title">
            <svg viewBox="0 0 24 24">
                <path d="M21 6.5C21 5.12 19.88 4 18.5 4h-13C4.12 4 3 5.12 3 6.5v8C3 15.88 4.12 17 5.5 17H8l3 3 3-3h4.5c1.38 0 2.5-1.12 2.5-2.5v-8z"/>
            </svg>

            Komentar

            <span class="comment-count">
                {{ comments.length }}
            </span>
        </div>

        <!-- COMMENTS -->
        <div
            v-for="comment in comments"
            :key="comment.id"
            class="comment-item"
        >
            <div class="comment-avatar">
                {{ comment.user.name.substring(0,2).toUpperCase() }}
            </div>

            <div>
                <span class="comment-author">
                    {{ comment.user.name }}
                </span>

                <span class="comment-date">
                    {{ formatDate(comment.created_at) }}
                </span>

                <p class="comment-text">
                    {{ comment.comment }}
                </p>
            </div>
        </div>

        <div
            v-if="comments.length === 0"
            style="font-size:0.85rem; color:var(--text-light); text-align:center; padding:1rem 0;"
        >
            Belum ada komentar.
        </div>

        <!-- FORM -->
        <div class="comment-form">

            <input
                v-model="newComment"
                type="text"
                class="form-control"
                placeholder="Tulis komentar..."
                maxlength="500"
            >

            <button
                @click="submitComment"
                class="btn btn-primary btn-sm"
                :disabled="loading"
            >
                {{ loading ? 'Mengirim...' : 'Kirim' }}
            </button>

        </div>

    </div>
</template>

<script>
import axios from 'axios';

export default {

    props: {
        itemId: Number,
        initialComments: Array,
    },

    data() {
        return {
            comments: this.initialComments || [],
            newComment: '',
            loading: false,
        };
    },

    methods: {

        async submitComment() {

            if (!this.newComment.trim()) return;

            this.loading = true;

            try {

                await axios.post(
                    `/items/${this.itemId}/comments`,
                    {
                        comment: this.newComment
                    }
                );

                this.comments.unshift({
                    id: Date.now(),
                    comment: this.newComment,
                    created_at: new Date().toISOString(),
                    user: {
                        name: window.authUserName || 'User',
                    },
                });

                this.newComment = '';

            } catch (error) {

                console.error(error);

                alert('Gagal mengirim komentar');

            } finally {

                this.loading = false;

            }

        },

        formatDate(date) {

            return new Date(date).toLocaleString('id-ID');

        }

    }

}
</script>