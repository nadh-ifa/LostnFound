<template>
    <div>
        <!-- FILTER -->
        <div class="filter-bar">
            <div class="filter-form">
                <div class="filter-field filter-field-search">
                    <span class="filter-label">Cari</span>

                    <div class="search-wrap">
                        <input
                            v-model="tempSearch"
                            type="text"
                            class="form-control"
                            placeholder="Nama barang, lokasi..."
                        >
                    </div>
                </div>

                <div class="filter-field filter-field-select">
                    <span class="filter-label">Tipe</span>

                    <select v-model="tempType" class="form-control">
                        <option value="">Semua Tipe</option>
                        <option value="hilang">Hilang</option>
                        <option value="ditemukan">Ditemukan</option>
                    </select>
                </div>

                <div class="filter-field filter-field-select">
                    <span class="filter-label">Status</span>

                    <select v-model="tempStatus" class="form-control">
                        <option value="">Semua Status</option>
                        <option value="dilaporkan">Dilaporkan</option>
                        <option value="ada_di_resepsionis">Di Resepsionis</option>
                        <option value="sudah_diambil">Sudah Diambil</option>
                        <option value="ditutup">Ditutup</option>
                    </select>
                </div>

                <div class="filter-actions">
                    <button
                        type="button"
                        @click="applyFilter"
                        class="btn btn-primary"
                    >
                        Cari
                    </button>

                    <button
                        type="button"
                        @click="resetFilter"
                        class="btn btn-secondary"
                    >
                        Reset
                    </button>
                </div>
            </div>
        </div>

        <!-- LOADING -->
        <div v-if="loading" class="empty-state">
            <h3>Loading...</h3>
        </div>

        <!-- GRID -->
        <div v-else class="items-grid">
            <div
                v-for="item in filteredItems"
                :key="item.id"
                class="item-card"
            >
                <img
                    v-if="item.image"
                    :src="'/storage/' + item.image"
                    class="item-card-img"
                >

                <div v-else class="item-card-img-placeholder">
                    Tidak ada gambar
                </div>

                <div class="item-card-body">
                    <div class="item-card-meta">
                        <span
                            class="type-badge"
                            :class="item.type === 'hilang'
                                ? 'type-hilang'
                                : 'type-ditemukan'"
                        >
                            {{ item.type === 'hilang' ? 'Hilang' : 'Ditemukan' }}
                        </span>

                        <span class="badge">
                            {{ formatStatus(item.status) }}
                        </span>
                    </div>

                    <div class="item-card-title">
                        {{ item.title }}
                    </div>

                    <div class="item-card-desc">
                        {{ item.description }}
                    </div>
                </div>

                <div class="item-card-footer">
                    <span class="item-location">
                        {{ item.location }}
                    </span>

                    <a
                        :href="'/items/' + item.id"
                        class="item-detail-link"
                    >
                        Detail
                    </a>
                </div>
            </div>

            <div
                v-if="filteredItems.length === 0"
                class="empty-state"
            >
                <h3>Tidak ada laporan</h3>
                <p>Tidak ditemukan data.</p>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            items: [],

            search: '',
            type: '',
            status: '',

            tempSearch: '',
            tempType: '',
            tempStatus: '',

            loading: true,
        };
    },

    computed: {
        filteredItems() {
            return this.items.filter((item) => {
                const keyword = this.search.toLowerCase();

                const matchSearch =
                    item.title?.toLowerCase().includes(keyword) ||
                    item.description?.toLowerCase().includes(keyword) ||
                    item.location?.toLowerCase().includes(keyword);

                const matchType =
                    !this.type || item.type === this.type;

                const matchStatus =
                    !this.status || item.status === this.status;

                return matchSearch && matchType && matchStatus;
            });
        },
    },

    methods: {
        applyFilter() {
            this.search = this.tempSearch;
            this.type = this.tempType;
            this.status = this.tempStatus;
        },

        resetFilter() {
            this.tempSearch = '';
            this.tempType = '';
            this.tempStatus = '';

            this.search = '';
            this.type = '';
            this.status = '';
        },

        formatStatus(status) {
            if (!status) return '';

            return status
                .replaceAll('_', ' ')
                .replace(/\b\w/g, char => char.toUpperCase());
        },
    },

    async mounted() {
        try {
            const response = await axios.get('/api/items');
            
            this.items = response.data.data || response.data;
        } catch (error) {
            console.error(error);
        } finally {
            this.loading = false;
        }
    },
};
</script>